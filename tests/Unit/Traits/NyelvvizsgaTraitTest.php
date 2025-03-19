<?php

namespace Tests\Traits;

use PHPUnit\Framework\TestCase;
use Akali\EpkAppPhp\Models\TobbletpontModel;

class NyelvvizsgaTraitTest extends TestCase
{
    private TobbletpontModel $tobbletpont;

    protected function setUp(): void
    {
        // Új TobbletpontModel létrehozása minden teszt előtt
        $this->tobbletpont = new TobbletpontModel("Nyelvvizsga", "B2", "angol");
    }

    #[Test] public function testSetEsGetNyelv()
    {
        // Ellenőrzi, hogy a nyelv helyesen beállítható és lekérhető
        $this->tobbletpont->setNyelv("német");
        $this->assertEquals("német", $this->tobbletpont->getNyelv());
    }

    #[Test] public function testSetEsGetTipus()
    {
        // Ellenőrzi, hogy a típus helyesen beállítható és lekérhető
        $this->tobbletpont->setTipus("C1");
        $this->assertEquals("C1", $this->tobbletpont->getTipus());
    }

    #[Test] public function testPontszamNyelvvizsga()
    {
        // Ellenőrzi, hogy a pontszám helyesen számolódik
        $this->assertEquals(28, $this->tobbletpont->pontszamNyelvvizsga());

        $this->tobbletpont->setTipus("C1");
        $this->assertEquals(40, $this->tobbletpont->pontszamNyelvvizsga());
    }

    #[Test] public function testPontszamNyelvvizsgaIsmeretlenTipus()
    {
        // Ellenőrzi, hogy ha a típus ismeretlen, akkor 0 pontot adjon vissza
        $this->tobbletpont->setTipus("D1");
        $this->assertEquals(0, $this->tobbletpont->pontszamNyelvvizsga());
    }
}
