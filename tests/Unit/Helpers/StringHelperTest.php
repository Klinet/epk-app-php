<?php

namespace Tests\Helpers;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function Akali\EpkAppPhp\Helpers\convertHungarianToEnglish;

class StringHelperTest extends TestCase
{

    #[Test] public function testConvertHungarianToEnglish()
    {
        $this->assertEquals('hElloesooesuu', convertHungarianToEnglish('hÉllóésőöésűú'));
    }
}
