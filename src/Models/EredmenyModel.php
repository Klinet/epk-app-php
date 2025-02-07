<?php

namespace Akali\EpkAppPhp\Models;

use Akali\EpkAppPhp\Interfaces\EredmenyInterface;

class EredmenyModel implements EredmenyInterface
{
    private string $targyNeve;
    private string $erettsegiTipus;
    private int $eredmenySzazalek;

    public function __construct(string $targyNeve, string $erettsegiTipus, int $eredmenySzazalek)
    {
        $this->targyNeve = $targyNeve;
        $this->erettsegiTipus = $erettsegiTipus;
        $this->eredmenySzazalek = $eredmenySzazalek;
    }

    public function getTargyNeve(): string
    {
        return $this->targyNeve;
    }

    public function getErettsegiTipus(): string
    {
        return $this->erettsegiTipus;
    }

    public function getEredmenySzazalek(): int
    {
        return $this->eredmenySzazalek;
    }
}
