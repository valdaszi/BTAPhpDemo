<?php

require_once $dir . '/models/radars.php';

$id = $_REQUEST['id'];

Radar::remove($id);

include $dir . '/views/radars/list.php';
