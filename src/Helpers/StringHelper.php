<?php

namespace Akali\EpkAppPhp\Helpers;

/**
 * Magyar karakterek angol megfeleltetése
 */
function convertHungarianToEnglish(string $text): string {
    $search = ['á', 'é', 'í', 'ó', 'ö', 'ő', 'ú', 'ü', 'ű', ' ', 'Á', 'É', 'Í', 'Ó', 'Ö', 'Ő', 'Ú', 'Ü', 'Ű'];
    $replace = ['a', 'e', 'i', 'o', 'o', 'o', 'u', 'u', 'u', '', 'A', 'E', 'I', 'O', 'O', 'O', 'U', 'U', 'U'];
    return str_replace($search, $replace, $text);
}