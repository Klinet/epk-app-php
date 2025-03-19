<?php

require_once __DIR__ . '/vendor/autoload.php';

use Akali\EpkAppPhp\Controllers\PontszamController;
use Akali\EpkAppPhp\Services\PontszamKalkulatorService;

// Hallgatói adatok állományának elérési útja
//$file = __DIR__ . '/src/data/homework_input.php';
$file = __DIR__ . '/src/data/homework_input_enhanced.php';

// Ellenőrzi, hogy létezik-e a fájl, ha nem, hibát jelez és leállítja a programot
if (!file_exists($file)) {
    echo "Hiba: Nem található a homework_input.php fájl." . PHP_EOL;
    exit(1);
}

// Beolvassa a hallgatói adatokat tartalmazó fájlt és egy tömbbe tölti azokat
$hallgatoiAdatTombbok = require $file;

// Létrehozza a pontszámkalkulációért felelős szolgáltatás példányát
$kalkulatorService = new PontszamKalkulatorService();
// Létrehozza a kontroller példányát a kalkulátor szolgáltatás átadásával
$pontszamController = new PontszamController($kalkulatorService);

// Az eredmények tárolására szolgáló tömb
$eredmenyek = [];

// Végigmegy a hallgatói adatok tömbjén, és minden hallgatóhoz meghívja a feldolgozási metódust
foreach ($hallgatoiAdatTombbok as $hallgato) {
    $eredmenyek[] = $pontszamController->feldolgozasHallgatok([$hallgato]);
}

// !Kiírja a konzolra a feldolgozott eredményeket -- a szervízben írom ki a ciklusban
//print_r($eredmenyek);

// Elmenti az eredményeket JSON fájlba
$pontszamController->saveResults($eredmenyek);

echo "Pontszámítás befejezve. Az eredmények elmentve az eredmenyek.json fájlba." . PHP_EOL;
