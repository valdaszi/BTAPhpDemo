<?php
var_dump($_GET);
if ($_GET['user'] == 'jonas' && $_GET['pass'] == '123') {
    include 'welcome.php';
} else {
    include 'login.php';
}
?>