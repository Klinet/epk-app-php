<?php

namespace Akali\EpkAppPhp\Controllers;

use Akali\EpkAppPhp\Services\PontszamKalkulatorService;
use Akali\EpkAppPhp\Models\HallgatoModel;
use Akali\EpkAppPhp\Models\SzakModel;
use Akali\EpkAppPhp\Models\EredmenyModel;
use Akali\EpkAppPhp\Models\TobbletpontModel;

class PontszamController
{
    private PontszamKalkulatorService $kalkulator;

    public function __construct(PontszamKalkulatorService $kalkulator)
    {
        $this->kalkulator = $kalkulator;
    }

    public function processHallgatok(array $hallgatokData): array
    {
        $eredmenyek = [];

        foreach ($hallgatokData as $hallgatoData) {
            $hallgato = $this->createHallgatoModel($hallgatoData);
            $vegsoPontszam = $this->kalkulator->szamolVegsoPontszam($hallgato);
            $eredmenyek[] = [
                'nev' => $hallgatoData['valasztott-szak']['szak'],
                'pontszam' => $vegsoPontszam
            ];
        }

        return $eredmenyek;
    }

    public function saveResults(array $eredmenyek): void
    {
        file_put_contents('eredmenyek.json', json_encode($eredmenyek, JSON_PRETTY_PRINT));
    }

    private function createHallgatoModel(array $data): HallgatoModel
    {
        $szak = new SzakModel(
            $data['valasztott-szak']['egyetem'],
            $data['valasztott-szak']['kar'],
            $data['valasztott-szak']['szak']
        );

        $erettsegiEredmenyek = array_map(fn($eredmeny) => new EredmenyModel($eredmeny['nev'], $eredmeny['tipus'], intval(str_replace('%', '', $eredmeny['eredmeny']))),
            $data['erettsegi-eredmenyek']
        );

        $tobbletpontok = array_map(fn($pont) => new TobbletpontModel($pont['kategoria'], $pont['tipus'], $pont['nyelv'] ?? null),
            $data['tobbletpontok']
        );

        return new HallgatoModel($szak, $erettsegiEredmenyek, $tobbletpontok);
    }
}
