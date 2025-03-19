<?php

namespace Akali\EpkAppPhp\Models;

use Akali\EpkAppPhp\Interfaces\TobbletpontInterface;
use Akali\EpkAppPhp\Traits\NyelvvizsgaTrait;

/**
 * A többletpontokat reprezentáló osztály.
 * - Nyelvvizsgák és egyéb többletpontok tárolására szolgál.
 */
class TobbletpontModel implements TobbletpontInterface
{
    use NyelvvizsgaTrait;

    // Nyelvvizsga kezelésére szolgáló trait

    private string $kategoria; // A többletpont kategóriája (pl. "Nyelvvizsga", "Emelt szintű érettségi")

    /**
     * Konstruktor: Létrehozza a többletpont objektumot.
     *
     * @param string $kategoria A többletpont típusa (pl. "Nyelvvizsga", "Verseny")
     * @param string $tipus A többletpont részletes típusa (pl. "B2", "C1", "Emelt szintű")
     * @param string|null $nyelv A nyelvvizsgához kapcsolódó nyelv (csak nyelvvizsgánál használatos)
     */
    public function __construct(string $kategoria, string $tipus, ?string $nyelv = null)
    {
        $this->kategoria = $kategoria;
        $this->setTipus($tipus); // Nyelvvizsga típus beállítása a trait-ből
        $this->setNyelv($nyelv); // Nyelvvizsga nyelv beállítása a trait-ből
    }

    /**
     * Visszaadja a többletpont kategóriáját.
     *
     * @return string
     */
    public function getKategoria(): string
    {
        return $this->kategoria;
    }
}
