<?php

namespace Akali\EpkAppPhp\Models;

use Akali\EpkAppPhp\Enum\FelsooktatasiVegzettsegEnum;
use Akali\EpkAppPhp\Interfaces\FelsooktatasiVegzettsegInterface;

class FelsooktatasiVegzettsegModel implements FelsooktatasiVegzettsegInterface
{
    private FelsooktatasiVegzettsegEnum $tipus;
    private int $eredmeny;

    public function __construct(FelsooktatasiVegzettsegEnum $tipus, int $eredmeny)
    {
        $this->tipus = $tipus;
        $this->eredmeny = $eredmeny;
    }

    public function getTipus(): FelsooktatasiVegzettsegEnum
    {
        return $this->tipus;
    }

    public function getEredmeny(): int
    {
        return $this->eredmeny;
    }
}