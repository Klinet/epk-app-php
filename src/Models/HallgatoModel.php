<?php

namespace Akali\EpkAppPhp\Models;

use Akali\EpkAppPhp\Interfaces\HallgatoInterface;

class HallgatoModel implements HallgatoInterface
{
    private SzakModel $valasztottSzak;
    private array $erettsegiEredmenyek;
    private array $tobbletpontok;

    public function __construct(SzakModel $szak, array $erettsegiEredmenyek, array $tobbletpontok)
    {
        $this->valasztottSzak = $szak;
        $this->erettsegiEredmenyek = $erettsegiEredmenyek;
        $this->tobbletpontok = $tobbletpontok;
    }

    public function getSelectedProgram(): SzakModel
    {
        return $this->valasztottSzak;
    }

    public function getExamResults(): array
    {
        return $this->erettsegiEredmenyek;
    }

    public function getExtraPoints(): array
    {
        return $this->tobbletpontok;
    }
}