<?php

require_once __DIR__ . '/vendor/autoload.php';

use Akali\EpkAppPhp\Controllers\PontszamController;
use Akali\EpkAppPhp\Services\PontszamKalkulatorService;
use function Akali\EpkAppPhp\Helpers\pretty_var_export;

// Beolvassuk a hallgatói adatokat
$file = __DIR__ . '/src/data/homework_input.php';

if (!file_exists($file)) {
    echo "Hiba: Nem található a homework_input.php fájl." . PHP_EOL;
    exit(1);
}

$hallgatokData = require $file;

$a = array (
    'foo' => 'bar',
    'baz' =>
        array (
            0 => 1,
            1 => 2,
            2 => 3,
        ),
);


$data = ['key' => 'value'];
pretty_var_export($data);

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
