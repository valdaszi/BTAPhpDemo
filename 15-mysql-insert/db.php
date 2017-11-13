<?php

function connectDB() {
    $servername = 'localhost';
    $dbname = 'Auto';
    $username = 'Auto';
    $password = 'LabaiSlaptas123';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die('Nepavyko prisjungti: ' . $conn->connect_error);
    }
    return $conn;
}

?>