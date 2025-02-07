<?php

namespace Akali\EpkAppPhp\Interfaces;

use App\Models\SzakModel;

interface HallgatoInterface
{
    public function getSelectedProgram(): SzakModel;

    public function getExamResults(): array;

    public function getExtraPoints(): array;
}