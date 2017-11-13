<?php
if ($_POST['user'] == 'jonas' && $_POST['pass'] == '123') {
    session_start();
    $_SESSION['user_name'] = array(
        name => 'Jonas Jonaitis',
        address => array(
            city => 'Kaunas', 
            address => 'Laisvės al. 13'
            )
        );
    
    //setcookie('token', 'kazkoks-uzkoduotas-raktas');
    //setcookie('token', serialize(array(raktas => 'kazkoks-uzkoduotas-raktas')));
    include 'welcome.php';
} else {
    include 'login.php';
}
?>