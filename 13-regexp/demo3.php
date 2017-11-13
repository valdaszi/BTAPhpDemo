<?php

echo $a = "abrikosasss (698) 123-4567"."\n"."bananas ananasas: +42";
$result = [];

echo '<h3>1</h3>';
$i = preg_match_all('/.4/', $a, $result);
var_dump("'/.4/' = $i", $result);

echo '<h3>2</h3>';
$i = preg_match_all('/[a-c]/', $a, $result);
var_dump("'/[a-c]/' = $i");

echo '<h3>3</h3>';
$i = preg_match_all('/[bk29]/', $a, $result);
var_dump("'/[bk29]/' = $i", $result);

echo '<h3>4</h3>';
$i = preg_match_all('/[^abns\d]/', $a, $result);    // \n
var_dump("'/[^abns\d]/' = $i", $result);

echo '<h3>5</h3>';
$i = preg_match_all('/^ba/m', $a, $result);
var_dump("'/^ba/m' = $i", $result);

echo '<h3>6</h3>';
$i = preg_match_all('/\d\d$/m', $a, $result);
var_dump("'/\d\d$/m' = $i", $result);

// echo '<h3>7</h3>';
// $i = preg_match_all('/\w+/', $a, $result);
// var_dump("'/\d\d$/m' = $i", $result);
