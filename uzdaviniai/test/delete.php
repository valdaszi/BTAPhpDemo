<!DOCTYPE html>
<html>
    <head>
        <title>delete</title>
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
    if ($pageSize < 5) $pageSize = 5;
} else {
    $pageSize = 5;
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Nepavyko prisjungti: ' . $conn->connect_error);
}

//Delete
if (isset($_GET['delete'])) {
    $sql = "DELETE FROM radars WHERE id = ". intval($_GET['delete']);
    $conn->query($sql);
}

//Edit
$row = [];
if (isset($_GET['edit'])) {
    $sql = "SELECT * FROM radars WHERE id = ". intval($_GET['edit']);
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();   
    }
}




if (isset($_POST['save'])) {
    if (intval($_POST['id']) > 0) {
        $id = $_POST['id'];
        $data = $_POST['date'];
        $numeris = $_POST['number'];
        $kelias = $_POST['distance'];
        $laikas = $_POST['time'];

        $sql = "UPDATE radars SET date = ?, number = ?, distance = ?, `time` = ? WHERE id = ?"; 
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ssddi", $data, $numeris, $kelias, $laikas, $id);
        $stmt->execute();

    } else {
        $insert = "INSERT INTO radars(date, number, distance, time) VALUES('".$_POST['date']."', '".$_POST['number']."', '".$_POST['distance']."', '".$_POST['time']."')";
        $result = $conn->query($insert);
    }
}


if (isset($_GET['offset'])) {
    $offset = $_GET['offset'];
    if ($offset < 0) $offset = 0;
} else {
    $offset = 0;
}

$sql = 'SELECT *, distance/time*3.6 as `speed` FROM radars ORDER BY `number`, `date` DESC LIMIT '.$pageSize.' OFFSET '.$offset;

$result = $conn->query($sql);

?>

<form action="<?= $_SERVER['SCRIPT_NAME'] ?>" method="post">

<input type='hidden' name='id' required value="<?= $row['id'] ?>">

            Vaziavimo data: <input type="text" name="date" required value="<?= $row['date'] ?>"><br>
            Atomobilio numeris: <input type="text" name="number" required value="<?= $row['number'] ?>"><br>
            Nuvaziuotas atstumas: <input type="number" name="distance" required value="<?= $row['distance'] ?>"><br>
            Vaziavimo laikas: <input type="number" name="time" required value="<?= $row['time'] ?>"><br>
            <button name="save" type="submit">Išsaugoti</button>
</form>
<hr>

    <?php if ($result->num_rows == $pageSize): ?>
        <form action="delete.php" method="get">
            <input type="hidden" name="offset" value="<?= $offset + $pageSize ?>">
            <input type="hidden" name="pageSize" value="<?= $pageSize ?>">
            <button type="submit">Pirmyn</button>
        </form>
    <?php endif; ?>

<?php if ($offset > 0) { ?>
    <form action="delete.php" method="get">
        <input type="hidden" name="offset" value="<?= $offset < $pageSize ? 0 : $offset - $pageSize ?>">
        <input type="hidden" name="pageSize" value="<?= $pageSize ?>">
        <button type="submit">Atgal</button>
    </form>

<?php }

if ($result->num_rows > 0) {
    ?>

    <form action="delete.php" method="get">
    <table>
        <tr>
            <th>Numeris</th>
            <th>Data</th>
            <th>Greitis</th>
            <th>Taisyti</th>
            <th>Trinti</th>
        </tr>
    
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['number'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= round ($row['speed'], 2) ?></td>
            <td><button type="submit" name="edit" value="<?= $row['id'] ?>" >Taisyti</button></td>
            <td><button type="submit" name="delete" value="<?= $row['id'] ?>" >Trinti</button></td>
        </tr>
    <?php endwhile ?>
    
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