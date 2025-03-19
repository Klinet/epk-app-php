<?php

namespace Akali\EpkAppPhp\Controllers;

use Akali\EpkAppPhp\Enum\FelsooktatasiVegzettsegEnum;
use Akali\EpkAppPhp\Models\FelsooktatasiVegzettsegModel;
use Akali\EpkAppPhp\Services\PontszamKalkulatorService;
use Akali\EpkAppPhp\Models\HallgatoModel;
use Akali\EpkAppPhp\Models\SzakModel;
use Akali\EpkAppPhp\Models\EredmenyModel;
use Akali\EpkAppPhp\Models\TobbletpontModel;
use function Akali\EpkAppPhp\Helpers\pretty_var_export;

class PontszamController
{
    private PontszamKalkulatorService $kalkulator;

    public function __construct(PontszamKalkulatorService $kalkulator)
    {
        $this->kalkulator = $kalkulator;
    }

    /**
     * Pontszámítás eredményeinek mentése JSON fájlba.
     */
    public function saveResults(array $eredmenyek): void
    {
        file_put_contents('eredmenyek.json', json_encode($eredmenyek, JSON_PRETTY_PRINT));
    }

    /**
     * Hallgatók adatainak feldolgozása és pontszámítás elvégzése.
     */
    public function feldolgozasHallgatok(array $hallgatokData): array
    {
        $eredmenyek = [];

        foreach ($hallgatokData as $hallgatoData) {
            // Hallgatói modell létrehozása
            //pretty_var_export($hallgatoData);
            $hallgato = $this->letrehozasHallgatoModel($hallgatoData);

            //pretty_var_export($hallgato);
            $azonositok = $hallgatoData['azonositok'] ?? [];
            $alappontokData = $this->kalkulator->szamolAlappontok($hallgato);
            $tobbletpontok = $this->kalkulator->szamolTobbletpontok($hallgato);
            $vegsoPontszam = $alappontokData['alappontok'] + $tobbletpontok;

            // Formázott eredmények kiírása konzolra
            $kimenet = "============================================================\n";
            $kimenet .= "                    PONTSZÁMÍTÁSI EREDMÉNYEK                \n";
            $kimenet .= "============================================================\n";
            $kimenet .= "Oktatási azonosító: " . ($azonositok['Oktatási azonosító'] ?? 'N/A') . "\n";
            $kimenet .= "OM kód: " . ($azonositok['OM kód'] ?? 'N/A') . "\n";
            $kimenet .= "------------------------------------------------------------\n";

            if (isset($alappontokData['hiba'])) {
                $kimenet .= "HIBA: " . $alappontokData['hiba'] . "\n";
            } else {
                $kimenet .= "| TANTÁRGY                   | PONTSZÁM | SZINT | TÍPUS |\n";
                $kimenet .= "------------------------------------------------------------\n";

                foreach ($alappontokData['exam_results'] as $result) {
                    // "magyar nyelv és irodalom" rövidítése
                    $tantargyNev = ($result['tantargy'] === "magyar nyelv és irodalom") ? "magyar nyelv" : $result['tantargy'];

                    // Szint rövidítése (K = Közép, E = Emelt)
                    $szintJeloles = ($result['szint'] === "Közép") ? "K" : "E";

                    $kimenet .= sprintf("| %-28s | %7d  | %-3s  | %-4s |\n",
                        $tantargyNev,
                        $result['pontszam'],
                        $szintJeloles,
                        $result['tipus']
                    );
                }

                $kimenet .= "------------------------------------------------------------\n";
                $kimenet .= sprintf("Alappontok:    %3d\n", $alappontokData['alappontok']);
                $kimenet .= sprintf("Többletpontok: %3d\n", $tobbletpontok);
                $kimenet .= sprintf("Végső pontszám: %3d\n", $vegsoPontszam);
            }

            $kimenet .= "============================================================\n\n";

            echo $kimenet;

            // Eredmény mentése a tömbbe
            $eredmenyek[] = [
                'azonositok' => $azonositok,
                'nev' => $hallgato->getValasztottSzak()->getSzak(),
                'egyetem' => $hallgato->getValasztottSzak()->getEgyetem(),
                'kar' => $hallgato->getValasztottSzak()->getKar(),
                'alappontok' => $alappontokData['alappontok'],
                'tobbletpontok' => $tobbletpontok,
                'vegsoPontszam' => $vegsoPontszam
            ];
        }

        return $eredmenyek;
    }

    /**
     * Létrehozza a hallgatói modellt az adatok alapján.
     */
    private function letrehozasHallgatoModel(array $data): HallgatoModel
    {
        $szak = new SzakModel(
            $data['valasztott-szak']['egyetem'],
            $data['valasztott-szak']['kar'],
            $data['valasztott-szak']['szak']
        );

        $erettsegiEredmenyek = array_map(fn($eredmeny) => new EredmenyModel(
            $eredmeny['nev'],
            $eredmeny['tipus'],
            intval(str_replace('%', '', $eredmeny['eredmeny']))
        ), $data['erettsegi-eredmenyek']);

        $tobbletpontok = array_map(fn($pont) => new TobbletpontModel(
            $pont['kategoria'],
            $pont['tipus'],
            $pont['nyelv'] ?? null
        ), $data['tobbletpontok'] ?? []);

// Ensure that $data['felsofoku_vegzettsegek'] is an array
        if (!isset($data['felsofoku_vegzettsegek']) || !is_array($data['felsofoku_vegzettsegek'])) {
            $felsooktatasiVegzettsegek = [];
        } else {
            $felsooktatasiVegzettsegek = array_map(
                fn($felsofoku_vegzettseg) => new FelsoOktatasiVegzettsegModel(
                    FelsoOktatasiVegzettsegEnum::from($felsofoku_vegzettseg['tipus']),
                    (int) filter_var($felsofoku_vegzettseg['eredmeny'], FILTER_SANITIZE_NUMBER_INT) // Convert "70%" to 70
                ),
                $data['felsofoku_vegzettsegek']
            );
        }

        //pretty_var_export($data['felsofoku_vegzettsegek']);

        $tantargyakConfig = require __DIR__ . '/../Config/SubjectsConfig.php';

        $szakNev = $szak->getSzak();
        if (!isset($tantargyakConfig[$szakNev])) {
            throw new \RuntimeException("Ismeretlen szak: $szakNev");
        }

        $kotelezoTantargyak = $tantargyakConfig[$szakNev]['kotelezo_tantargyak'] ?? [];
        $valaszthatoTantargyak = $tantargyakConfig[$szakNev]['valaszthato_tantargyak'] ?? [];

        return new HallgatoModel(
            $data['azonositok'],
            $szak,
            $erettsegiEredmenyek,
            $tobbletpontok,
            $kotelezoTantargyak,
            $valaszthatoTantargyak,
            $felsooktatasiVegzettsegek
        );
    }
}
