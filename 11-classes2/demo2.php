<?php
namespace planeta\kalnai;

require_once 'zmogus.php';

$a = new \planeta\gyvybe\Zmogus('Adomas');
var_dump($a);

//use planeta\gyvybe\Zmogus;
// use planeta\gyvybe\Zmogus as Zmogus;
//$a = new Zmogus('Ieva');

use planeta\gyvybe\Zmogus as Homo;
$a = new Homo('Ieva');

var_dump($a);
