<?php

require_once $dir . '/models/automobiliai.php';

$id = $_REQUEST['id'];
$a = Automobilis::get($id);
var_dump($a);
