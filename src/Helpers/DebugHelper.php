<?php

namespace Akali\EpkAppPhp\Helpers;

function pretty_var_export(mixed $value) {
    echo "<?php\n\nreturn " . var_export($value, true) . ";\n"; die();
}
