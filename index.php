<?php

require_once __DIR__ . '/vendor/autoload.php';

use Akali\EpkAppPhp\Controllers\PontszamController;
use Akali\EpkAppPhp\Services\PontszamKalkulatorService;

// Beolvassuk a hallgatói adatokat
$file = __DIR__ . '/src/data/homework_input.php';

if (!file_exists($file)) {
    echo "Hiba: Nem található a homework_input.php fájl." . PHP_EOL;
    exit(1);
}

$hallgatokData = require $file;

// Inicializáljuk a pontszámkalkulátor szolgáltatást
$kalkulatorService = new PontszamKalkulatorService();

// Inicializáljuk a controllert
$controller = new PontszamController($kalkulatorService);

// Feldolgozzuk az összes hallgatót
$eredmenyek = [];

foreach ($hallgatokData as $hallgato) {
    $eredmenyek[] = $controller->processHallgatok([$hallgato]);
}

// Kiírjuk az eredményeket
print_r($eredmenyek);

// Elmentjük az eredményeket JSON fájlba
$controller->saveResults($eredmenyek);

echo "Pontszámítás befejezve. Az eredmények elmentve az eredmenyek.json fájlba." . PHP_EOL;
