<?php

require_once $dir . '/models/radars.php';

$id = $_REQUEST['id'];
$a = Radar::get($id);

echo 'Cia reikia prideti htnl formos rodyma, kad koreguoti '.$id.' irasa';
var_dump($a);
