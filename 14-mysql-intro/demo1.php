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

$page = 2;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
if ($page != 2) $page = 2;

if (isset($_GET['offset'])) {
    $offset = $_GET['offset'];
} else {
    $offset = 0;
}

$sql = 'SELECT `number`, `distance`/`time`*3.6 as `speed`, `date` FROM radars ORDER BY `number`, `date` DESC LIMIT ' . ($page + 1) . ' OFFSET ' . $offset;

if (!($result = $conn->query($sql))) {
    die("Error: " . $conn->error);
}

if ($result->num_rows > 0) { 
    ?>
    <?php if ($offset > 0): ?>
    <!-- <form>
        <input type="hidden" name="offset" value="<?= $offset >= $page ? $offset - $page : 0 ?>">
        <button>Atgal</button>    
    </form> -->
        <a href="<?= "?offset=".($offset >= $page ? $offset - $page : 0) ?>">Atgal</a>
    <?php endif; ?>

    <?php if ($result->num_rows == $page + 1): ?>
    <!-- <form>
        <input type="hidden" name="offset" value="<?= $offset + $page ?>">
        <button>Pirmyn</button>    
    </form> -->
        <a href="<?= "?offset=".($offset + $page) ?>">Pirmyn</a>
    <?php endif; ?>

    <table border=1>
        <tr>
            <th>Numeris</th>
            <th>Data</th>
            <th>Greitis</th>
        </tr>
    
    <?php
    // output data of each row
    //while($row = $result->fetch_assoc()) {
    for ($i = 0; $i < $page; $i++) {
        if (!($row = $result->fetch_assoc())) break;
        ?>
        <tr>
            <td><?php echo $row['number']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo round($row['speed']); ?></td>
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