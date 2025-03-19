<?php

namespace Akali\EpkAppPhp\Models;

use Akali\EpkAppPhp\Interfaces\SzakInterface;

/**
 * A hallgató által választott szakot reprezentáló osztály.
 */
class SzakModel implements SzakInterface
{
    private string $egyetem; // Az egyetem neve
    private string $kar; // A kar neve
    private string $szak; // A szak neve

    /**
     * A SzakModel konstruktor, amely létrehozza a szak adatait tároló objektumot.
     *
     * @param string $egyetem Az egyetem neve
     * @param string $kar A kar neve
     * @param string $szak A szak neve
     */
    public function __construct(string $egyetem, string $kar, string $szak)
    {
        $this->egyetem = $egyetem;
        $this->kar = $kar;
        $this->szak = $szak;
    }

    /**
     * Visszaadja az egyetem nevét.
     *
     * @return string
     */
    public function getEgyetem(): string
    {
        return $this->egyetem;
    }

    /**
     * Visszaadja a kar nevét.
     *
     * @return string
     */
    public function getKar(): string
    {
        return $this->kar;
    }

    /**
     * Visszaadja a szak nevét.
     *
     * @return string
     */
    public function getSzak(): string
    {
        return $this->szak;
    }
}
