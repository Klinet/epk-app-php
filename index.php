<?php

require_once __DIR__ . '/vendor/autoload.php';

$file = __DIR__ . '/src/data/homework_input.php';

if (!file_exists($file)) {
    echo "Hiba: Nem található a homework_input.php fájl." . PHP_EOL;
    exit(1);
}

$data = require $file;
print_r($data);

