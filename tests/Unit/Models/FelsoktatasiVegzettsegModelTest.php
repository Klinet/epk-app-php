<?php

namespace Unit\Models;

use Akali\EpkAppPhp\Enum\FelsooktatasiVegzettsegEnum;
use Akali\EpkAppPhp\Models\FelsooktatasiVegzettsegModel;
use Akali\EpkAppPhp\Models\SzakModel;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class FelsoktatasiVegzettsegModelTest extends TestCase
{
    protected function setUp(): void
    {
        // Tesztadatok előkészítése
        $this->felsooktatasiVegzettseg = new FelsooktatasiVegzettsegModel(FelsooktatasiVegzettsegEnum::OKJ, '70');
    }

    #[Test] public function testLetrejonASzakModel()
    {
        // Ellenőrzi, hogy a FelsooktatasiVegzettsegModel példány sikeresen létrejött
        $this->assertInstanceOf(FelsooktatasiVegzettsegModel::class, $this->felsooktatasiVegzettseg);
    }

    #[Test] public function testVisszaadjaAzEgyetemet()
    {
        // Ellenőrzi, hogy a getTipus() megfelelően működik
        $this->assertEquals(FelsooktatasiVegzettsegEnum::OKJ, $this->felsooktatasiVegzettseg->getTipus());
    }

    #[Test] public function testVisszaadjaAKart()
    {
        // Ellenőrzi, hogy a getEredmeny() megfelelően működik
        $this->assertEquals('70', $this->felsooktatasiVegzettseg->getEredmeny());
    }
}