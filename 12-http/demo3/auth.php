<?php
if ($_POST['user'] == 'jonas' && $_POST['pass'] == '123') {
    setcookie('token', 'kazkoks-uzkoduotas-raktas');
    include 'welcome.php';
} else {
    include 'login.php';
}
?>