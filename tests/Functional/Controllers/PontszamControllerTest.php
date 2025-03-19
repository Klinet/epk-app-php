<?php

namespace Tests\Controllers;

use PHPUnit\Framework\TestCase;
use Akali\EpkAppPhp\Controllers\PontszamController;
use Akali\EpkAppPhp\Services\PontszamKalkulatorService;
use Akali\EpkAppPhp\Models\HallgatoModel;
use Akali\EpkAppPhp\Models\SzakModel;
use Akali\EpkAppPhp\Models\EredmenyModel;
use Akali\EpkAppPhp\Models\TobbletpontModel;

class PontszamControllerTest extends TestCase
{
    private PontszamController $pontszamController;
    private PontszamKalkulatorService $kalkulatorService;

    protected function setUp(): void
    {
        // Pontszám kalkulátor szerviz példányosítása
        $this->kalkulatorService = new PontszamKalkulatorService();

        // Pontszám controller létrehozása a kalkulátor szervizzel
        $this->pontszamController = new PontszamController($this->kalkulatorService);
    }

    #[Test] public function testLetrejonAPontszamController()
    {
        // Ellenőrzi, hogy a PontszamController példányosítható
        $this->assertInstanceOf(PontszamController::class, $this->pontszamController);
    }

    #[Test] public function testFeldolgozasHallgatok()
    {
        // Tesztadatok létrehozása egy hallgatóhoz
        $hallgatoData = [
            'azonositok' => [
                'Oktatási azonosító' => '123456789',
                'OM kód' => '987654'
            ],
            'valasztott-szak' => [
                'egyetem' => 'ELTE',
                'kar' => 'IK',
                'szak' => 'Programtervező informatikus'
            ],
            'erettsegi-eredmenyek' => [
                ['nev' => 'magyar nyelv és irodalom', 'tipus' => 'közép', 'eredmeny' => '80%'],
                ['nev' => 'történelem', 'tipus' => 'közép', 'eredmeny' => '85%'],
                ['nev' => 'matematika', 'tipus' => 'emelt', 'eredmeny' => '90%'],
                ['nev' => 'angol nyelv', 'tipus' => 'közép', 'eredmeny' => '95%']
            ],
            'tobbletpontok' => [
                ['kategoria' => 'Nyelvvizsga', 'tipus' => 'B2', 'nyelv' => 'angol'],
                ['kategoria' => 'Nyelvvizsga', 'tipus' => 'C1', 'nyelv' => 'német']
            ]
        ];

        // Hallgatók feldolgozása
        $eredmenyek = $this->pontszamController->feldolgozasHallgatok([$hallgatoData]);

        // Ellenőrzés, hogy az eredmények megfelelően visszatértek
        $this->assertNotEmpty($eredmenyek);
        $this->assertEquals('Programtervező informatikus', $eredmenyek[0]['nev']);
        $this->assertEquals('ELTE', $eredmenyek[0]['egyetem']);
        $this->assertEquals('IK', $eredmenyek[0]['kar']);
        $this->assertArrayHasKey('alappontok', $eredmenyek[0]);
        $this->assertArrayHasKey('tobbletpontok', $eredmenyek[0]);
        $this->assertArrayHasKey('vegsoPontszam', $eredmenyek[0]);
    }

    #[Test] public function testSaveResults()
    {
        // Minta tesztadatok
        $eredmenyek = [
            [
                'azonositok' => [
                    'Oktatási azonosító' => '123456789',
                    'OM kód' => '987654'
                ],
                'nev' => 'Programtervező informatikus',
                'egyetem' => 'ELTE',
                'kar' => 'IK',
                'alappontok' => 370,
                'tobbletpontok' => 100,
                'vegsoPontszam' => 470
            ]
        ];

        // Az eredmények mentése JSON fájlba
        $this->pontszamController->saveResults($eredmenyek);

        // Ellenőrzés, hogy a fájl valóban létrejött
        $this->assertFileExists('eredmenyek.json');

        // Fájl tartalmának ellenőrzése
        $mentettAdatok = json_decode(file_get_contents('eredmenyek.json'), true);
        $this->assertEquals($eredmenyek, $mentettAdatok);

        // Takarítás: tesztfájl törlése
        unlink('eredmenyek.json');
    }
}
