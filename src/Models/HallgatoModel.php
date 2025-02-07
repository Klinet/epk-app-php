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

    public function szamolAlappontok(): int
    {
        // TODO: Alappontok számítása
        return 0;
    }

    public function szamolTobbletpontok(): int
    {
        // TODO: Többletpontok számítása
        return 0;
    }

    public function szamolVegsoPontszam(): int
    {
        return $this->szamolAlappontok() + $this->szamolTobbletpontok();
    }
}
