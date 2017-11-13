<?php

require_once $dir . '/models/automobiliai.php';
//require_once __DIR__ . '/../../views/auto/list.php';

$automobiliai = Automobilis::all(100, 0);
// automobiliaiLentele($automobiliai);

include $dir . '/views/auto/list.php';