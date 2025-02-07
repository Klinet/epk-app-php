<?php

namespace Akali\EpkAppPhp\Models;

class PontszamKalkulatorModel
{

    public function szamolAlappontok(HallgatoModel $hallgato): int
    {
        $erettsegiEredmenyek = $hallgato->getExamResults();
        $alappontok = 0;

        foreach ($erettsegiEredmenyek as $eredmeny) {
            if ($eredmeny instanceof EredmenyModel) {
                $alappontok += intval($eredmeny->getPercentage() * 2);
            }
        }

        return $alappontok;
    }

    public function szamolTobbletpontok(HallgatoModel $hallgato): int
    {
        $tobbletpontok = $hallgato->getExtraPoints();
        $osszesTobbletpont = 0;

        foreach ($tobbletpontok as $pont) {
            if ($pont instanceof TobbletpontModel) {
                if ($pont->getCategory() === "Nyelvvizsga") {
                    if ($pont->getType() === "B2") {
                        $osszesTobbletpont += 28;
                    } elseif ($pont->getType() === "C1") {
                        $osszesTobbletpont += 40;
                    }
                }
            }
        }

        return min($osszesTobbletpont, 100); // Maximum 100 többletpont adható
    }

    public function szamolVegsoPontszam(HallgatoModel $hallgato): int
    {
        return $this->szamolAlappontok($hallgato) + $this->szamolTobbletpontok($hallgato);
    }
}
