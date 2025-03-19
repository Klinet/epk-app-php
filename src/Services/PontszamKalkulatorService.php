<?php

namespace Akali\EpkAppPhp\Services;

use Akali\EpkAppPhp\Enum\FelsooktatasiVegzettsegEnum;
use Akali\EpkAppPhp\Models\HallgatoModel;
use Akali\EpkAppPhp\Models\TobbletpontModel;
use Akali\EpkAppPhp\Traits\LoggerTrait;

class PontszamKalkulatorService
{
    use LoggerTrait;

    /**
     * Alappontok kiszámítása
     * - Kiválasztja a legjobb kötelező tantárgyat
     * - Kiválasztja a legjobb választható tantárgyat
     * - Ha egy tárgy eredménye 20% alatt van, hibát ad vissza
     * - Ha valamely kötelező tárgy hiányzik, hibát ad vissza
     * - Az alappontok a legjobb kötelező és a legjobb választható tárgyak pontszámának összege * 2
     */
    public function szamolAlappontok(HallgatoModel $hallgato): array {
        // Kötelező és választható tantárgyak lekérése
        $mandatorySubjects = $hallgato->getKotelezoTantargyak();
        $optionalSubjects = $hallgato->getValaszthatoTantargyak();
        $mandatoryPoints = 0;
        $bestOptionalPoints = 0;
        $hasMandatoryExam = array_fill_keys($mandatorySubjects, false);
        $examResults = [];

        $bestMandatorySubject = null;
        $bestOptionalSubject = null;

        // Log üzenet létrehozása és mentése
        $logMessage = "--------------------------------------------------\n";
        $logMessage .= "-- A számítás megkezdődött az alábbi tanulónak:\n";
        $logMessage .= "-- Oktatási azonosító: " . $hallgato->getOktatasiAzonosito() . "\n";
        $logMessage .= "-- OM kód: " . $hallgato->getOmKod() . "\n";
        $logMessage .= "--------------------------------------------------\n";

        echo $logMessage;
        $this->log($logMessage);

        foreach ($hallgato->getErettsegiEredmenyek() as $eredmeny) {
            $subjectName = $eredmeny->getTargyNeve();
            $points = intval(str_replace('%', '', $eredmeny->getEredmenySzazalek()));

            // Ha egy tárgy eredménye 20% alatt van, hibát ad vissza
            if ($points < 20) {
                $hibaUzenet = "HIBA: Nem lehetséges a pontszámítás! Sikertelen érettségi ($subjectName: $points%)";
                echo $hibaUzenet . PHP_EOL;
                $this->logError($hibaUzenet);
                return [
                    'hiba' => $hibaUzenet,
                    'alappontok' => 0
                ];
            }

            // Eldönti, hogy a tárgy kötelező vagy választható
            if (in_array($subjectName, $mandatorySubjects, true)) {
                $type = 'K'; // Kötelező
                if ($points > $mandatoryPoints) {
                    $mandatoryPoints = $points;
                    $bestMandatorySubject = $subjectName;
                }
                $hasMandatoryExam[$subjectName] = true;
            } elseif (in_array($subjectName, $optionalSubjects, true)) {
                $type = 'V'; // Választható
                if ($points > $bestOptionalPoints) {
                    $bestOptionalPoints = $points;
                    $bestOptionalSubject = $subjectName;
                }
            } else {
                $type = '-'; // Nem ismert tantárgy
            }

            // Tantárgyi eredmény eltárolása
            $examResults[] = [
                'tantargy' => $subjectName,
                'pontszam' => $points,
                'szint' => ucfirst($eredmeny->getErettsegiTipus()), // Közép/Emelt
                'tipus' => $type
            ];
        }

        // Ellenőrzi, hogy minden kötelező tárgyból volt-e érettségi
        if (in_array(false, $hasMandatoryExam, true)) {
            $hibaUzenet = "HIBA: Nem tett érettségit minden kötelező tantárgyból!";
            echo $hibaUzenet . PHP_EOL;
            $this->logError($hibaUzenet);
            return [
                'hiba' => $hibaUzenet,
                'alappontok' => 0
            ];
        }

        // Megjelöli a legjobb kötelező és választható tárgyakat
        foreach ($examResults as &$result) {
            if ($result['tantargy'] === $bestMandatorySubject || $result['tantargy'] === $bestOptionalSubject) {
                $result['tipus'] .= '*';
            }
        }

        // Az alappontok kiszámítása
        $vegsoAlappontok = ($mandatoryPoints + $bestOptionalPoints) * 2;

        return [
            'exam_results' => $examResults,
            'alappontok' => $vegsoAlappontok
        ];
    }

    /**
     * Többletpontok kiszámítása
     * - Kiszámolja az emelt szintű érettségiért járó pontokat (50 pont vizsgánként)
     * - Kiszámolja a nyelvvizsgákért járó pontokat (B2 = 28 pont, C1 = 40 pont)
     * - Maximum 100 többletpontot lehet elérni
     */
    public function szamolTobbletpontok(HallgatoModel $hallgato): int {
        $tobbletpontok = $hallgato->getTobbletpontok();
        $osszesTobbletpont = 0;
        $nyelvvizsgaPontok = [];

        // Nyelvvizsgák feldolgozása (csak a legmagasabb szint számít egy adott nyelvből)
        foreach ($tobbletpontok as $pont) {
            if ($pont instanceof TobbletpontModel && $pont->getKategoria() === "Nyelvvizsga") {
                $nyelv = strtolower($pont->getNyelv() ?? '');

                if ($pont->getTipus() === "B2") {
                    $nyelvvizsgaPontok[$nyelv] = max($nyelvvizsgaPontok[$nyelv] ?? 0, 28);
                } elseif ($pont->getTipus() === "C1") {
                    $nyelvvizsgaPontok[$nyelv] = max($nyelvvizsgaPontok[$nyelv] ?? 0, 40);
                }
            }
        }

        // Nyelvvizsga pontok hozzáadása
        foreach ($nyelvvizsgaPontok as $pont) {
            $osszesTobbletpont += $pont;
        }

        // Emelt szintű érettségiért járó többletpontok
        foreach ($hallgato->getErettsegiEredmenyek() as $eredmeny) {
            if (strtolower($eredmeny->getErettsegiTipus()) === "emelt") {
                $osszesTobbletpont += 50;
            }
        }

        foreach ($hallgato->getFelsooktatasiVegzettsegek() as $vegzettseg) {
            switch ($vegzettseg->getTipus()) {
                case FelsooktatasiVegzettsegEnum::OKJ:
                    $osszesTobbletpont += 50;
                    break;
                case FelsooktatasiVegzettsegEnum::FOSZK:
                    $osszesTobbletpont += 70;
                    break;
                case FelsooktatasiVegzettsegEnum::BSC:
                    $osszesTobbletpont += 80;
                    break;
                case FelsooktatasiVegzettsegEnum::MSC:
                    $osszesTobbletpont += 90;
                    break;
            }
        }

        // A többletpontok maximuma 100 lehet
        return min($osszesTobbletpont, 100);
        //return min($osszesTobbletpont, 500);
    }
}
