<?php

namespace Akali\EpkAppPhp\Interfaces;

use Akali\EpkAppPhp\Models\HallgatoModel;

interface PontszamKalkulatorInterface
{
    public function szamolAlappontok(HallgatoModel $hallgato): int;

    public function szamolTobbletpontok(HallgatoModel $hallgato): int;

    public function szamolVegsoPontszam(HallgatoModel $hallgato): int;
}

