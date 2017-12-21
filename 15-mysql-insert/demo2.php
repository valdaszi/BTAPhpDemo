<!DOCTYPE html>
<html>
    <head>
        <title>Demo 2</title>
        <meta charset="UTF-8">
    </head>
<body>
<?php 

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

$data = '2017-07-18 15:17:25';
$numeris = '777';
$kelias = 5000;
$laikas = 99;

$insert = "INSERT INTO radars(`date`, `number`, `distance`, `time`) VALUES(?, ?, ?, ?)"; 
if (!($stmt = $conn->prepare($insert))) {
    die("Error: " . $conn->error);
}

if (!$stmt->bind_param("ssdd", $data, $numeris, $kelias, $laikas)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

//TODO!!!
if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;    
}

// išvedame automobilius
$sql = "SELECT `number`, `distance`/`time`*3.6 as `speed`, `date` FROM radars WHERE `date` > '2017-03-01 09:15:24' ORDER BY `number`, `date` DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    ?>
    <table>
        <tr>
            <th>Numeris</th>
            <th>Data</th>
            <th>Greitis (km/h)</th>
        </tr>
    
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['number'] ?></td>
                <td><?= $row['date'] ?></td>
                <td><?= round($row['speed'], 1) ?></td>
            </tr>
        <?php endwhile; ?>

    </table>

    <?php
} else {
    echo 'nėra duomenų';
}
$conn->close();

?>
</body>
</html>