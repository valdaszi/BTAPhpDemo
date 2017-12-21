<!DOCTYPE html>
<html>
    <head>
        <title>Demo 1</title>
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

$data = '2017-07-18 15:07:30';
$numeris = 'A666';
$kelias = 5000;
$laikas = 144;

$insert = "INSERT INTO radars(date, number, distance, time) VALUES('$data', '$numeris', $kelias, $laikas)"; 

if (!$conn->query($insert)) {
     echo "Klaida: ". $conn->error;
}

// išvedame automobilius
$sql = 'SELECT `number`, `distance`/`time`*3.6 as `speed`, `date` FROM radars ORDER BY `date` DESC, `number`';

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
            <td><?php echo $row['number']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo round($row['speed']); ?></td>
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