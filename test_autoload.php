<?php

require __DIR__ . '/vendor/autoload.php';

use Akali\EpkAppPhp\Interfaces\PontszamKalkulatorInterface;

if (!interface_exists(PontszamKalkulatorInterface::class)) {
    echo "❌ Hiba: Az osztály nem létezik!";
} else {
    echo "✅ Az osztály betöltődött!";
}

