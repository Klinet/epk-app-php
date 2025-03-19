<?php

namespace Tests\Models;

use Akali\EpkAppPhp\Models\EredmenyModel;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class EredmenyModelTest extends TestCase
{
    private EredmenyModel $eredmeny;

    protected function setUp(): void
    {
        // Tesztadatok előkészítése
        $this->eredmeny = new EredmenyModel('matematika', 'emelt', 90);
    }

    #[Test] public function testLetrejonAEredmenyModel()
    {
        // Ellenőrzi, hogy az EredmenyModel példány sikeresen létrejött
        $this->assertInstanceOf(EredmenyModel::class, $this->eredmeny);
    }

    #[Test] public function testVisszaadjaATargyNevet()
    {
        // Ellenőrzi, hogy a getTargyNeve() megfelelően működik
        $this->assertEquals('matematika', $this->eredmeny->getTargyNeve());
    }

    #[Test] public function testVisszaadjaAErettsegiTipust()
    {
        // Ellenőrzi, hogy a getErettsegiTipus() megfelelően működik
        $this->assertEquals('emelt', $this->eredmeny->getErettsegiTipus());
    }

    #[Test] public function testVisszaadjaAEredmenySzazalekot()
    {
        // Ellenőrzi, hogy a getEredmenySzazalek() megfelelően működik
        $this->assertEquals(90, $this->eredmeny->getEredmenySzazalek());
    }
}
