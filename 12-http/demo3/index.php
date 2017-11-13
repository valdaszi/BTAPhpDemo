<?php 
    if ($_COOKIE['token'] == 'kazkoks-uzkoduotas-raktas') {
        include 'welcome.php';
    } else {
        include 'login.php';
    }
?>