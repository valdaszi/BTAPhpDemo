<?php

require_once $dir . '/models/radars.php';

$radars = Radar::all(100, 0);

include $dir . '/views/radars/list.php';