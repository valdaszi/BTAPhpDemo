<?php

// echo "_REQUEST:<br>";
// var_dump($_REQUEST);

// echo "_SERVER:<br>";
// var_dump($_SERVER);

$dir = __DIR__;
$base = $_SERVER['SCRIPT_NAME'];
$index = strpos($_SERVER['SCRIPT_NAME'], 'index.php');
if ($index !== FALSE) {
    $base = substr($_SERVER['SCRIPT_NAME'], 0, $index);
}

if ($_SERVER['REQUEST_URI'] == $base) {
    $ctrl = 'auto/list';
} else {
    $ctrl = substr($_SERVER['REQUEST_URI'], strlen($base));
    $index = strpos($ctrl, '?');
    if ($index !== FALSE) {
        $ctrl = substr($ctrl, 0, $index);
    }
    // if (strpos($ctrl, '/') !== FALSE) {
    //     $ctrl = 'automobiliai';
    // }
}

if (!file_exists('controllers/'.$ctrl.'.php')) {
    $ctrl = 'auto/list';
}

// var_dump("base = $base");
// var_dump("ctrl = $ctrl");
// var_dump("dir = $dir");

include 'views/header.php';

include 'views/menu.php';
include 'controllers/'.$ctrl.'.php';

include 'views/footer.php';
