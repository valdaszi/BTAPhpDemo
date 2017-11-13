<?php 
    session_start();
    //if ($_COOKIE['token'] == 'kazkoks-uzkoduotas-raktas') {
    //if (isset($_COOKIE['token']) && unserialize($_COOKIE['token'])['raktas'] == 'kazkoks-uzkoduotas-raktas') {
    if (isset($_SESSION['user_name'])) {    
        include 'welcome.php';
    } else {
        include 'login.php';
    }
?>