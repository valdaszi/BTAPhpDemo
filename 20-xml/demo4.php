<?php

$json = file_get_contents("knygos.json");
var_dump($json);

$obj = json_decode($json, true);
var_dump($obj);

echo $obj[0]['autorius'];
echo '<br>';
echo $obj[0]['pavadinimas']['tekstas'];
echo '<br>';
echo $obj[0]['pavadinimas']['kalba'];
echo '<hr>';

$obj = json_decode($json);
var_dump($obj);
echo $obj[0]->autorius;
echo '<br>';
echo $obj[0]->pavadinimas->tekstas;
echo '<br>';
echo $obj[0]->pavadinimas->kalba;