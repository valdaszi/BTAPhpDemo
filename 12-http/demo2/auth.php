<?php
// echo "GET:";
// var_dump($_GET);
// echo "POST:";
// var_dump($_POST);
// echo 'REQUEST: ';
// var_dump($_REQUEST);
if ($_POST['user'] == 'jonas' && $_POST['pass'] == '123') {
    include 'welcome.php';
} else {
    include 'login.php';
}
?>