<?php

namespace Akali\EpkAppPhp\Helpers;

function formatPercentage(string $value): int {
    return intval(str_replace('%', '', $value));
}
