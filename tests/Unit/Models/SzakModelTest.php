<?php

namespace Tests\Models;

use Akali\EpkAppPhp\Models\SzakModel;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class SzakModelTest extends TestCase
{
    private SzakModel $szak;

    protected function setUp(): void
    {
        // Tesztadatok előkészítése
        $this->szak = new SzakModel('ELTE', 'IK', 'Programtervező informatikus');
    }

    #[Test] public function testLetrejonASzakModel()
    {
        // Ellenőrzi, hogy a SzakModel példány sikeresen létrejött
        $this->assertInstanceOf(SzakModel::class, $this->szak);
    }

    #[Test] public function testVisszaadjaAzEgyetemet()
    {
        // Ellenőrzi, hogy a getEgyetem() megfelelően működik
        $this->assertEquals('ELTE', $this->szak->getEgyetem());
    }

    #[Test] public function testVisszaadjaAKart()
    {
        // Ellenőrzi, hogy a getKar() megfelelően működik
        $this->assertEquals('IK', $this->szak->getKar());
    }

    #[Test] public function testVisszaadjaASzakot()
    {
        // Ellenőrzi, hogy a getSzak() megfelelően működik
        $this->assertEquals('Programtervező informatikus', $this->szak->getSzak());
    }
}