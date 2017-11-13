<?php

function connDB()
{
    $servername = 'localhost';
    $username = 'Auto';
    $password = 'LabaiSlaptas123';
    $dbname = 'Auto';

// Sukuriamas prisijungimas 
    $conn = new mysqli($servername, $username, $password, $dbname); //<- BŪTINAI TOKIA TVARKA!

// Prisijungimo tikrinimas
    if ($conn->connect_error)
    {
        die ('Prisijungti nepavyko: ' . $conn->connect_error);
    }
    return $conn;
}

?>