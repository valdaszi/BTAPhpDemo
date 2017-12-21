<!DOCTYPE html>
<html>
    <head>
        <title>Demo 3</title>
        <meta charset="UTF-8">
    </head>
<body>
<?php 

require_once 'db.php';
require_once 'lentele.php';

$conn = connectDB();
lentele($conn);

$id = 7;
$kelias = 4900;
$laikas = 100;

$sql = "UPDATE radars SET distance = ?, `time` = ? WHERE id = ?"; 
$stmt = $conn->prepare($sql);

$stmt->bind_param("ddi", $kelias, $laikas, $id);

$stmt->execute();


lentele($conn);

$conn->close();

?>
</body>
</html>