<?php

namespace Tests\Models;

use Akali\EpkAppPhp\Models\TobbletpontModel;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TobbletpontModelTest extends TestCase
{
    private TobbletpontModel $tobbletpont;

    protected function setUp(): void
    {
        // Tesztadatok előkészítése
        $this->tobbletpont = new TobbletpontModel('Nyelvvizsga', 'C1', 'angol');
    }

    #[Test] public function testLetrejonATobbletpontModel()
    {
        // Ellenőrzi, hogy a TobbletpontModel példány sikeresen létrejött
        $this->assertInstanceOf(TobbletpontModel::class, $this->tobbletpont);
    }

    #[Test] public function testVisszaadjaAKategoriat()
    {
        // Ellenőrzi, hogy a getKategoria() megfelelően működik
        $this->assertEquals('Nyelvvizsga', $this->tobbletpont->getKategoria());
    }

    #[Test] public function testVisszaadjaATipust()
    {
        // Ellenőrzi, hogy a getTipus() megfelelően működik
        $this->assertEquals('C1', $this->tobbletpont->getTipus());
    }

    #[Test] public function testVisszaadjaANyelvet()
    {
        // Ellenőrzi, hogy a getNyelv() megfelelően működik
        $this->assertEquals('angol', $this->tobbletpont->getNyelv());
    }

    #[Test] public function testHelyesenSzamoljaANyelvvizsgaPontszamot()
    {
        // Ellenőrzi, hogy a nyelvvizsgapontok megfelelően számolódnak
        $this->assertEquals(40, $this->tobbletpont->pontszamNyelvvizsga());
    }
}
