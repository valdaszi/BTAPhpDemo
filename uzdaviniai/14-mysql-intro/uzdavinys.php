<!DOCTYPE html>
<html>
    <head>
        <title>Demo 2</title>
        <meta charset="UTF-8">
    </head>
<body>
<?php 
var_dump($_GET);

$servername = 'localhost';
$dbname = 'Auto';
$username = 'Auto';
$password = 'LabaiSlaptas123';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$offset = 0;
if (isset($_GET['offset'])) {
    $offset = $_GET['offset'];
}
if (isset($_GET['eiti'])) {
    if ($_GET['eiti'] == 'Pirmyn') {
        //echo 'paspaustas mygtukas Pirmyn <br>';
        $offset += 2;
    } else if ($_GET['eiti'] == 'Atgal') {
        //echo 'paspaustas mygtukas Atgal <br>';
        $offset -= 2;
        if ($offset < 0) $offset = 0;
    }
}

if (isset($_GET['count'])) {
    $count = $_GET['count'];
} else {
    $sql = 'SELECT count(*) FROM radars';
    $result = $conn->query($sql);
    $row = $result->fetch_row();
    $count = $row[0];
}

$sql = 'SELECT `number`, `distance`/`time` as speed, `date` FROM radars ORDER BY `number`, `date` DESC'.
    ' LIMIT 2 OFFSET '. $offset;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    ?>
    <form action="uzdavinys.php" method="get">
        <input type="hidden" value="<?php echo $offset; ?>" name="offset">
        <input type="hidden" value="<?php echo $count; ?>" name="count">
        <?php if ($offset > 0) { ?>
            <input type="submit" value="Atgal" name="eiti">
        <?php } ?>
        <?php if ($offset < $count - 2) { ?>
            <input type="submit" value="Pirmyn" name="eiti">
        <?php } ?>
    </form>
    <table>
        <tr>
            <th>Numeris</th>
            <th>Greitis</th>
            <th>Data</th>
        </tr>
    
    <?php
    // output data of each row
    while($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['number']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['speed']; ?></td>
        </tr>
        <?php
    }
    echo '</table>';

} else {
    echo 'nėra duomenų';
}
$conn->close();

?>
</body>
</html>