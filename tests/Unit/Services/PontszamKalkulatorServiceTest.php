<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Akali\EpkAppPhp\Services\PontszamKalkulatorService;
use Akali\EpkAppPhp\Models\HallgatoModel;
use Akali\EpkAppPhp\Models\SzakModel;
use Akali\EpkAppPhp\Models\EredmenyModel;
use Akali\EpkAppPhp\Models\TobbletpontModel;

class PontszamKalkulatorServiceTest extends TestCase
{
    private PontszamKalkulatorService $kalkulator;
    private HallgatoModel $hallgato;

    protected function setUp(): void
    {
        parent::setUp();

        // Pontszám kalkulátor példány létrehozása
        $this->kalkulator = new PontszamKalkulatorService();

        // Teszt hallgató adatainak előkészítése
        $szak = new SzakModel("ELTE", "IK", "Programtervező informatikus");
        $erettsegiEredmenyek = [
            new EredmenyModel("magyar nyelv", "közép", 70),
            new EredmenyModel("történelem", "közép", 80),
            new EredmenyModel("matematika", "emelt", 90),
            new EredmenyModel("angol nyelv", "közép", 94),
            new EredmenyModel("informatika", "közép", 95)
        ];
        $tobbletpontok = [
            new TobbletpontModel("Nyelvvizsga", "B2", "angol"),
            new TobbletpontModel("Nyelvvizsga", "C1", "német")
        ];
        $kotelezoTantargyak = ['magyar nyelv', 'történelem', 'matematika'];
        $valaszthatoTantargyak = ['angol nyelv', 'informatika', 'biológia', 'fizika', 'kémia'];
        $azonositok = ['Oktatási azonosító' => '123456789', 'OM kód' => '987654'];

        // Hallgató modell létrehozása
        $this->hallgato = new HallgatoModel(
            $szak, $erettsegiEredmenyek, $tobbletpontok,
            $kotelezoTantargyak, $valaszthatoTantargyak, $azonositok
        );
    }

    #[Test] public function testSzamolAlappontok()
    {
        // Ellenőrzi, hogy az alappont számítás helyesen történik
        $eredmeny = $this->kalkulator->szamolAlappontok($this->hallgato);
        $this->assertEquals(370, $eredmeny['alappontok']);
    }

    #[Test] public function testSzamolTobbletpontok()
    {
        // Ellenőrzi, hogy a többletpont számítás helyesen történik
        $eredmeny = $this->kalkulator->szamolTobbletpontok($this->hallgato);
        $this->assertEquals(100, $eredmeny);
    }

    #[Test] public function testAlapTeszt()
    {
        // Ellenőrzi, hogy a tesztkörnyezet megfelelően működik
        $this->assertTrue(true);
    }
}
