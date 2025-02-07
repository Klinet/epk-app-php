<?php

namespace Akali\EpkAppPhp\Services;

use Akali\EpkAppPhp\Models\HallgatoModel;
use Akali\EpkAppPhp\Models\EredmenyModel;
use Akali\EpkAppPhp\Models\TobbletpontModel;
use Akali\EpkAppPhp\Helpers\PontszamFormatHelper;

class PontszamKalkulatorService
{

    public function szamolAlappontok(HallgatoModel $hallgato): int
    {
        $alappontok = 0;

        foreach ($hallgato->getExamResults() as $eredmeny) {
            if ($eredmeny instanceof EredmenyModel) {
                $szazalek = PontszamFormatHelper::formatPercentage($eredmeny->getPercentage());
                $alappontok += $szazalek * 2;
            }
        }

        return $alappontok;
    }

    public function szamolTobbletpontok(HallgatoModel $hallgato): int
    {
        $tobbletpontok = 0;

        foreach ($hallgato->getExtraPoints() as $pont) {
            if ($pont instanceof TobbletpontModel) {
                $tobbletpontok += $this->tobbletpontSzamitasa($pont);
            }
        }

        return min($tobbletpontok, 100); // Maximum 100 többletpont adható
    }

    private function tobbletpontSzamitasa(TobbletpontModel $pont): int
    {
        return match ($pont->getCategory()) {
            "Nyelvvizsga" => match ($pont->getType()) {
                "B2" => 28,
                "C1" => 40,
                default => 0,
            },
            default => 0,
        };
    }

    public function szamolVegsoPontszam(HallgatoModel $hallgato): int
    {
        return $this->szamolAlappontok($hallgato) + $this->szamolTobbletpontok($hallgato);
    }
}