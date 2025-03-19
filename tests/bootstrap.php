<?php

require_once __DIR__ . '/../vendor/autoload.php';

if (file_exists(__DIR__ . '/logs/app.log')) {
    unlink(__DIR__ . '/logs/app.log');
}