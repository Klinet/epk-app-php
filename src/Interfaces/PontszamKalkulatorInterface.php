<?php

namespace Akali\EpkAppPhp\Interfaces;

use App\Models\HallgatoInterface;

interface PontszamKalkulatorInterface
{
    public function calculateBasePoints(HallgatoInterface $hallgato): int;

    public function calculateExtraPoints(HallgatoInterface $hallgato): int;

    public function calculateTotalPoints(HallgatoInterface $hallgato): int;
}
