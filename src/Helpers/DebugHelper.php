<?php

namespace Akali\EpkAppPhp\Helpers;

function pretty_var_export(mixed $value): string {
    echo "=== START OF pretty_var_export ===\n";
    print_r(debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT));

//    $output = "<?php\n\nreturn " . var_export($value, true) . ";\n";
//    echo $output;

    die("=== END OF pretty_var_export ===\n");
}

