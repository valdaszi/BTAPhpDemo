<!DOCTYPE HTML>
<html>
    <head>
    <title>Uždavinys</title>
    <meta charset="UTF-8">
    <style>
            h2, th, td, table, tr {
            text-align: center;
            border: 1px solid black;
        }
        </style>
    </head>
        <body>
<?php

$servername = 'localhost';
$dbname = 'Auto';
$username = 'Auto';
$password = 'LabaiSlaptas123';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Nepavyko prisjungti: ' . $conn->connect_error);
}

$row = [];

if (isset($_GET['edit'])){
    $sql = "SELECT * FROM radars WHERE id =".$_GET['edit'];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}

if (isset($_POST['save'])) {
    if ($_POST['id'] > 0) {
        $sql = "UPDATE radars SET `number` = ?, `date` = ?, `distance` = ?, `time` = ? WHERE id = ?"; 
        $stmts = $conn->prepare($sql);
        $stmts->bind_param("ssddi", $_POST['number'], $_POST['date'], $_POST['distance'], $_POST['time'], $_POST['id']);
        $stmts->execute(); 
    } else {
        $insert = "INSERT INTO radars(`number`, `date`, `distance`, `time`) VALUES(?, ?, ?, ?)"; 
        $stmt = $conn->prepare($insert);
        $stmt->bind_param("ssdd", $_POST['number'], $_POST['date'], $_POST['distance'], $_POST['time']);
        $stmt->execute();
    }
}

if (isset ($_GET['delete'])) {
    $sql = "DELETE FROM radars WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET['delete']);
    $stmt->execute();
}

if (isset($_GET['pageSize'])) {
    $pageSize = $_GET['pageSize'];
    if ($pageSize < 8) $pageSize = 8;
} else {
    $pageSize = 8;
}

if (isset($_GET['offset'])) {
    $offset = $_GET['offset'];
    if ($offset < 0) $offset = 0;
} else {
    $offset = 0;
}

$sql = 'SELECT `id`, `number`, `distance`/`time`*3.6 as `speed`, `date` FROM radars ORDER BY `id`, `date` DESC LIMIT ' .$pageSize. ' OFFSET '.$offset;
$result = $conn->query($sql);

?>      
        <form action="uzdavinukas.php" method="POST">
            Automobilio numeris: <input name="number" type="text" value="<?= $row['number'] ?>"required><br>
            Važiavimo data: <input name="date" type="text" value="<?= $row['date'] ?>"required><br>
            Nuvažiuotas kelias: <input name="distance" type="text" value="<?= $row['distance'] ?>"required><br>
            Laikas: <input name="time" type="text" value="<?= $row['time'] ?>"required><br>
            ID: <input name="id" type="hidden" value="<?= $row['id'] ?>"required><br>
            <input type="submit" name="save" value="Issaugoti"><br>
        </form>
        <br>
        <br>

<?php   if ($offset > 0) { ?>
    <form action="uzdavinukas.php" method="get">
        <input type="hidden" name="offset" value="<?= $offset < $pageSize ? 0 : $offset - $pageSize ?>">
        <input type="hidden" name="pageSize" value="<?= $pageSize ?>">
        <button type="submit">Atgal</button>
    </form>
<?php } if ($result->num_rows > 0) { ?>
    <?php if ($result->num_rows == $pageSize): ?>
        <form action="uzdavinukas.php" method="get">
            <input type="hidden" name="offset" value="<?= $offset + $pageSize ?>">
            <input type="hidden" name="pageSize" value="<?= $pageSize ?>">
            <button type="submit">Pirmyn</button>
        </form>
    <?php endif; ?>

        <form action="uzdavinukas.php" method="get">
<table>
        <br>
        <tr>
            <th><h3>Nr.</h3></th>
            <th><h3>ID</h3></th>       
            <th><h3>Numeris</h3></th>
            <th><h3>Data</h3></th>
            <th><h3>Greitis km/h</h3></th>
        </tr>
    <?php $nr = 1; ?>
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $offset + $nr++ ?></td>
            <td><?= $row['id'] ?></td>
            <td><?= $row['number'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= round($row['speed'], 1) ?></td>
            <td>
                    <button name="delete" type="submit" value="<?= $row['id'] ?>">Ištrinti</button>
                    <button name="edit" type="submit" value="<?= $row['id'] ?>">Pakeisti</button>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
</form>
    <?php
} else {
    echo 'nėra duomenų';
}
$conn->close();
?>
</body>
</html>