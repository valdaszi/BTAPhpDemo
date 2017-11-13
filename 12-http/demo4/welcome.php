<?php
    //if ($_COOKIE['token'] != 'kazkoks-uzkoduotas-raktas') {
    // if (!isset($_COOKIE['token']) || unserialize($_COOKIE['token'])['raktas'] != 'kazkoks-uzkoduotas-raktas') {
    //     include 'login.php';
    //     return;
    // }
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Super duper svetainė</title>
    </head>
    <body>
        <h1>Sveikas, <?php echo $_SESSION['user_name']['name']; ?></h1>
        <?php 
            for ($i = 2; $i <= 9; $i++) {
                for ($j = 2; $j <= 9; $j++) {
                    echo "$i x $j = ".$i * $j.'<br>';
                }
                echo '<br>';
            }
        ?>
        <a href="index.php">Refresh</a>
        <a href="logout.php">Logout</a>
    </body>
</html>