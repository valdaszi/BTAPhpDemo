<!DOCTYPE html>
<html>
    <head>
        <title>Šablonas</title>
        <meta charset="UTF-8">
    </head>
<body>
<?php 


$servername = 'localhost';
$dbname = 'Auto';
$username = 'Auto';
$password = 'LabaiSlaptas123';

//$pageSize = 2;
if (isset($_GET['pageSize'])) {
    $pageSize = $_GET['pageSize'];
    if ($pageSize < 2) $pageSize = 2;
} else {
    $pageSize = 2;
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Nepavyko prisjungti: ' . $conn->connect_error);
}

if (isset($_GET['offset'])) {
    $offset = $_GET['offset'];
    if ($offset < 0) $offset = 0;
} else {
    $offset = 0;
}

$sql = 'SELECT `number`, `distance`/`time` as `speed`, `date` FROM radars ORDER BY `number`, `date` DESC LIMIT '.$pageSize.' OFFSET '.$offset;

$result = $conn->query($sql);

if ($offset > 0) { ?>
    <form action="1.php" method="get">
        <input type="hidden" name="offset" value="<?= $offset < $pageSize ? 0 : $offset - $pageSize ?>">
        <input type="hidden" name="pageSize" value="<?= $pageSize ?>">
        <button type="submit">Atgal</button>
    </form>

<?php }

if ($result->num_rows > 0) {
    ?>

    <?php if ($result->num_rows == $pageSize): ?>
        <form action="1.php" method="get">
            <input type="hidden" name="offset" value="<?= $offset + $pageSize ?>">
            <input type="hidden" name="pageSize" value="<?= $pageSize ?>">
            <button type="submit">Pirmyn</button>
        </form>
    <?php endif; ?>

    <table>
        <tr>
            <th>Numeris</th>
            <th>Data</th>
            <th>Greitis</th>
        </tr>
    
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['number'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= $row['speed'] ?></td>
        </tr>
    <?php endwhile ?>
    
    </table>

    <?php
} else {
    echo 'nėra duomenų';
}
$conn->close();
?>

</body>
</html>