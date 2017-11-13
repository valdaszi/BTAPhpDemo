<!DOCTYPE html>
<html>
    <head>
        <title>Demo 1</title>
        <meta charset="UTF-8">
    </head>
<body>
<?php 

require_once 'db.php';
$conn = connectDB();

require_once 'lentele.php';

$page = 10;
$offset = 0;

lentele($conn, $page, $offset);

echo '<hr>';

$id = $_GET['id'];

// nesaugu!!!
//$sql = "DELETE FROM radars WHERE id = $id";
//$conn->query($sql);

// gerai :)
$sql = "DELETE FROM radars WHERE id = ?"; 
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();


lentele($conn, $page, $offset);

$conn->close();

?>
</body>
</html>