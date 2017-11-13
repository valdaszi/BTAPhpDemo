<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
    </head>
<body>
<?php
// kad galima būtų įvesti naujus įrašus apie automobilių greitį,
//  taisyti jau suvestą informaciją, o taip pat trinti įrašus.

require_once 'nRDB.php';    // Duomenu baze
$conn = connDB();

if (isset($_GET['delete'])) 
{
    $sql = "DELETE FROM radars WHERE id = " . intval($_GET['delete']);
    $conn->query($sql);
}

$row = [];
if (isset($_GET['edit'])) 
{
    $sql = "SELECT * FROM radars WHERE id = " . intval($_GET['edit']);
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}

if (isset($_POST['save'])) {
    if (intval($_POST['id']) > 0) {
        echo "update";
    } else {
        echo "insert";
    }
}

// $stmt = $conn->prepare("UPDATE radars SET number = ?, distance = ?, time = ? WHERE id = ?")
//  $stmt->bind_param("ssss", $numeris, $kelias, $laikas, $id);
//   $stmt->execute()

// $stmt = $conn->prepare("INSERT INTO radars('date', 'number', 'distance', 'time'') VALUES(?, ?, ?, ?)") 
//  $stmt->bind_param("ssss", $data, $numeris, $kelias, $laikas);
//   $stmt->execute()

// UPDATE `Radars` SET `date` = '2017-05-16 12:00:00',
//  `number` = 'HUH556', `distance` = '4100',
//   `time` = '75' WHERE `Radars`.`id` = 2;
?>

<form action='<?= $_SERVER['SCRIPT_NAME']?>' method='post'>
    <input type='hidden' name='id' required value="<?= $row['id'] ?>"><br>
    Data: <input type='text' name='date' required value="<?= $row['date'] ?>"><br>
    Reg. Nr.: <input type='text' name='number' required value="<?= $row['number']?>"><br>
    Atstumas: <input type='text' name='distance' required value="<?= $row['distance'] ?>"><br>
    Laikas: <input type='text' name='time' required value="<?= $row['time'] ?>"><br>
    <button name="save" value="<?= $row['id']?>" type="submit">Išsaugoti</button>
</form><hr>

<?php
require_once 'nRLentele.php';   // Lentele su duomenim
lentele($conn);

?>

</body>
</html>