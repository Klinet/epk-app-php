<?php

namespace Tests\Helpers;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function Akali\EpkAppPhp\Helpers\formatPercentage;

class PontszamFormatHelperTest extends TestCase
{
    #[Test] public function testFormatPercentageRemovesPercentageSign() {
        // Ellenőrzi, hogy a százalékjel eltávolításra kerül
        $this->assertEquals(50, formatPercentage('50%'));
    }

    #[Test] public function testFormatPercentageWithOnlyNumbers() {
        // Ellenőrzi, hogy ha nincs százalékjel, az érték változatlan marad
        $this->assertEquals(80, formatPercentage('80'));
    }

    #[Test] public function testFormatPercentageWithLeadingWhitespace() {
        // Ellenőrzi, hogy a szóközök nem befolyásolják az eredményt
        $this->assertEquals(30, formatPercentage('  30% '));
    }

    #[Test] public function testFormatPercentageWithNonNumericString() {
        // Ellenőrzi, hogy ha nem szám kerül megadásra, az eredmény 0 lesz
        $this->assertEquals(0, formatPercentage('nem_szam%'));
    }
}
