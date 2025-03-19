<?php

namespace Akali\EpkAppPhp\Models;

use Akali\EpkAppPhp\Interfaces\HallgatoInterface;

class HallgatoModel implements HallgatoInterface
{
    private SzakModel $valasztottSzak; // A hallgató által választott szak adatai
    private array $erettsegiEredmenyek; // A hallgató érettségi eredményei
    private array $tobbletpontok; // A hallgató által szerzett többletpontok (pl. nyelvvizsga)
    private array $kotelezoTantargyak; // A hallgató által választott szakhoz tartozó kötelező tantárgyak
    private array $valaszthatoTantargyak; // A hallgató szakjához tartozó választható tantárgyak
    private array $azonositok; // A hallgató azonosítói (Oktatási azonosító és OM kód)
    private array $felsoOktatasiVegzettseg;

    /**
     * Hallgató objektum létrehozása a megadott adatokkal.
     */
    public function __construct(
        array     $azonositok,
        SzakModel $szak,
        array     $erettsegiEredmenyek,
        array     $tobbletpontok,
        array     $kotelezoTantargyak,
        array     $valaszthatoTantargyak,
        array     $felsoOktatasiVegzettseg = []
    )
    {
        $this->valasztottSzak = $szak;
        $this->erettsegiEredmenyek = $erettsegiEredmenyek;
        $this->tobbletpontok = $tobbletpontok;
        $this->kotelezoTantargyak = $kotelezoTantargyak;
        $this->valaszthatoTantargyak = $valaszthatoTantargyak;
        $this->azonositok = $azonositok;
        $this->felsoOktatasiVegzettseg = $felsoOktatasiVegzettseg;
    }

    /**
     * Visszaadja a hallgató érettségi eredményeit.
     */
    public function getErettsegiEredmenyek(): array
    {
        return $this->erettsegiEredmenyek;
    }

    /**
     * Visszaadja a hallgató többletpontjait.
     */
    public function getTobbletpontok(): array
    {
        return $this->tobbletpontok;
    }

    /**
     * Visszaadja a hallgató által választott szak adatait.
     */
    public function getValasztottSzak(): SzakModel
    {
        return $this->valasztottSzak;
    }

    /**
     * Visszaadja a hallgató szakjához tartozó kötelező tantárgyakat.
     */
    public function getKotelezoTantargyak(): array
    {
        return $this->kotelezoTantargyak;
    }

    /**
     * Visszaadja a hallgató szakjához tartozó választható tantárgyakat.
     */
    public function getValaszthatoTantargyak(): array
    {
        return $this->valaszthatoTantargyak;
    }

    /**
     * Visszaadja a hallgató Oktatási azonosítóját.
     * Ha nincs megadva, "N/A" értéket ad vissza.
     */
    public function getOktatasiAzonosito(): string
    {
        return $this->azonositok['Oktatási azonosító'] ?? 'N/A';
    }

    /**
     * Visszaadja a hallgató OM kódját.
     * Ha nincs megadva, "N/A" értéket ad vissza.
     */
    public function getOmKod(): string
    {
        return $this->azonositok['OM kód'] ?? 'N/A';
    }

    public function getFelsooktatasiVegzettsegek(): array {
        return $this->felsoOktatasiVegzettseg;
    }
}
