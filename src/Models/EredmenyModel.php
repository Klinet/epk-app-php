<?php

namespace Akali\EpkAppPhp\Models;

use Akali\EpkAppPhp\Interfaces\EredmenyInterface;

/**
 * Az érettségi eredményt tároló osztály.
 */
class EredmenyModel implements EredmenyInterface
{
    private string $targyNeve; // A tantárgy neve
    private string $erettsegiTipus; // Az érettségi típusa (közép/emelt)
    private int $eredmenySzazalek; // Az érettségi eredmény százalékos formában

    /**
     * Az EredmenyModel konstruktor, amely létrehozza az érettségi eredményt tároló objektumot.
     *
     * @param string $targyNeve A tantárgy neve
     * @param string $erettsegiTipus Az érettségi típusa (pl. közép, emelt)
     * @param int $eredmenySzazalek A vizsga százalékos eredménye
     */
    public function __construct(string $targyNeve, string $erettsegiTipus, int $eredmenySzazalek)
    {
        $this->targyNeve = $targyNeve;
        $this->erettsegiTipus = $erettsegiTipus;
        $this->eredmenySzazalek = $eredmenySzazalek;
    }

    /**
     * Visszaadja a tantárgy nevét.
     *
     * @return string
     */
    public function getTargyNeve(): string
    {
        return $this->targyNeve;
    }

    /**
     * Visszaadja az érettségi típusát (közép vagy emelt).
     *
     * @return string
     */
    public function getErettsegiTipus(): string
    {
        return $this->erettsegiTipus;
    }

    /**
     * Visszaadja az érettségi eredményt százalékos formában.
     *
     * @return int
     */
    public function getEredmenySzazalek(): int
    {
        return $this->eredmenySzazalek;
    }
}
