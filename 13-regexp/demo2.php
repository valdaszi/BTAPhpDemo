<?php

echo $a = "abrikosasss (698) 123-4567"."\n"."bananas ananasas: +42";
$result = [];

echo '<h3>1</h3>';
$i = preg_match_all('/(asa)|(nana)/', $a, $result);
var_dump("'/(asa)|(nana)/' = $i");
var_dump($result);

echo '<h3>2</h3>';
$i = preg_match('/s{3}/', $a);
var_dump("'/s{3}/' = $i");

echo '<h3>3</h3>';
$i = preg_match('/\d{3}-\d{4}/', $a, $result);
var_dump("'/\d{3}-\d{4}/' = $i", $result);

echo '<h3>4</h3>';
$i = preg_match('/\d+/', $a, $result);
var_dump("'/\d+/' = $i", $result);
$i = preg_match_all('/\d{1,}/', $a, $result);
var_dump("'/\d{1,}/' = $i", $result);

echo '<h3>5</h3>';
$i = preg_match('/\d{3}\d*/', $a, $result);
var_dump("'/\d{3}\d*/' = $i", $result);
$i = preg_match_all('/\d{3}\d{0,}/', $a, $result);
var_dump("'/\d{3}\d{0,}/' = $i", $result);

echo '<h3>6</h3>';
$i = preg_match_all('/-?\d\d/', $a, $result);
var_dump("'/-?\d\d/' = $i", $result);
$i = preg_match_all('/-{0,1}\d\d/', $a, $result);
var_dump("'/-{0,1}\d\d/' = $i", $result);
