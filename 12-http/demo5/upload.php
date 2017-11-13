<?php

var_dump($_POST);
var_dump($_FILES);

$myfile = fopen($_FILES['failas']['tmp_name'], "r") or die("Nepavyko atidaryti failo!");
$turinys = fread($myfile, filesize($_FILES['failas']['tmp_name']));
fclose($myfile);

echo '<pre>';
echo htmlentities($turinys);
echo '</pre>';
?>