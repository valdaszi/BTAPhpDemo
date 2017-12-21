<?php
namespace planeta\kalnas;

use planeta\gyvybe\Zmogus;
use planeta\gyvybe\Ameba;

require_once 'zmogus.php';

$a = new \planeta\gyvybe\Zmogus('Adomas');
var_dump($a);

//use planeta\gyvybe\Zmogus as Zmogus;
//use planeta\gyvybe\Zmogus;
$a = new Zmogus('Ieva');

// use planeta\gyvybe\Zmogus as Homo;
// $a = new Homo('Ieva 2');

var_dump($a);
