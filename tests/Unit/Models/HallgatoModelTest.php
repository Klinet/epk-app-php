<?php

namespace Tests\Models;

use Akali\EpkAppPhp\Models\HallgatoModel;
use Akali\EpkAppPhp\Models\SzakModel;
use Akali\EpkAppPhp\Models\EredmenyModel;
use Akali\EpkAppPhp\Models\TobbletpontModel;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class HallgatoModelTest extends TestCase
{
    private HallgatoModel $hallgato;

    protected function setUp(): void
    {
        // Tesztadatok előkészítése
        $szak = new SzakModel('ELTE', 'IK', 'Programtervező informatikus');

        $erettsegiEredmenyek = [
            new EredmenyModel('magyar nyelv', 'közép', 70),
            new EredmenyModel('történelem', 'közép', 80),
            new EredmenyModel('matematika', 'emelt', 90),
        ];

        $tobbletpontok = [
            new TobbletpontModel('Nyelvvizsga', 'B2', 'angol'),
            new TobbletpontModel('Nyelvvizsga', 'C1', 'német'),
        ];

        $kotelezoTantargyak = ['magyar nyelv', 'történelem', 'matematika'];
        $valaszthatoTantargyak = ['angol nyelv', 'informatika', 'biológia', 'fizika', 'kémia'];

        $azonositok = [
            'Oktatási azonosító' => '12345678901',
            'OM kód' => '123456',
        ];

        // Hallgató objektum létrehozása
        $this->hallgato = new HallgatoModel(
            $szak,
            $erettsegiEredmenyek,
            $tobbletpontok,
            $kotelezoTantargyak,
            $valaszthatoTantargyak,
            $azonositok
        );
    }

    #[Test] public function testLetrejonAHallgatoModel()
    {
        // Ellenőrzi, hogy a HallgatoModel példány sikeresen létrejött
        $this->assertInstanceOf(HallgatoModel::class, $this->hallgato);
    }

    #[Test] public function testVisszaadjaAValasztottSzakot()
    {
        // Ellenőrzi, hogy a getValasztottSzak() megfelelően működik
        $this->assertEquals('Programtervező informatikus', $this->hallgato->getValasztottSzak()->getSzak());
    }

    #[Test] public function testVisszaadjaAzErettsegiEredmenyeket()
    {
        // Ellenőrzi, hogy az érettségi eredmények helyesen érhetők el
        $this->assertCount(3, $this->hallgato->getErettsegiEredmenyek());
    }

    #[Test] public function testVisszaadjaATobbletpontokat()
    {
        // Ellenőrzi, hogy a többletpontok helyesen érhetők el
        $this->assertCount(2, $this->hallgato->getTobbletpontok());
    }

    #[Test] public function testVisszaadjaAKotelezoTantargyakat()
    {
        // Ellenőrzi, hogy a kötelező tantárgyak megfelelően visszaadhatók
        $this->assertEquals(['magyar nyelv', 'történelem', 'matematika'], $this->hallgato->getKotelezoTantargyak());
    }

    #[Test] public function testVisszaadjaAValaszthatoTantargyakat()
    {
        // Ellenőrzi, hogy a választható tantárgyak megfelelően visszaadhatók
        $this->assertEquals(['angol nyelv', 'informatika', 'biológia', 'fizika', 'kémia'], $this->hallgato->getValaszthatoTantargyak());
    }

    #[Test] public function testVisszaadjaAzAzonositokat()
    {
        // Ellenőrzi, hogy az azonosítók megfelelően visszaadhatók
        $this->assertEquals('12345678901', $this->hallgato->getOktatasiAzonosito());
        $this->assertEquals('123456', $this->hallgato->getOmKod());
    }
}
