<?php

namespace Akali\EpkAppPhp\Interfaces;

use Akali\EpkAppPhp\Models\SzakModel;

interface HallgatoInterface
{
    public function getErettsegiEredmenyek(): array;

    public function getTobbletpontok(): array;

    public function getValasztottSzak(): SzakModel;

    public function getKotelezoTantargyak(): array;

    public function getValaszthatoTantargyak(): array;
}
