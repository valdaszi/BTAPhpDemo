<!DOCTYPE html>
<html>
    <head>
        <title>17 Uzduotis</title>
        <meta charset="UTF-8">
        <style>
            .curPage {
                font-size: 22px;
                color: blue;
            }
</style>
    </head>
<body>


<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
$conn = connect();
                 
$results_per_page = 10;                    
$values = [];
//Puslapiavimas
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start_from = ($page-1) * $results_per_page;
form2();
// Ar gauname id per GET komandą
if (array_key_exists('id', $_GET) && $_GET['id'] > 0) {
    $sql = "SELECT * FROM radars WHERE id = " . $_GET["id"];  
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $values = $result->fetch_assoc();
    } 
}
// Į formą įvestų naujų duomenų išsaugojimas Duomenų bazėje
if ((isset($_POST['id'])) && ($_POST['id']) === ""){
    $insert = insert($conn); 
 
    }else if ((isset($_POST['id'])) && $_POST['id'] > 0 ){
        $update = update($conn, $values); 
}
 
if ((isset($_POST['delete'])) && $_POST['delete'] > 0 ){
    $delete = delete($conn);
} 
if ((isset($_POST['home'])) && $_POST['home'] > 0 ){
    header("Location: " . $_SERVER['PHP_SELF']);        /* Redirect browser */
        exit();  
}  
if (isset($_POST['auto']) ){
     $auto = "SELECT DISTINCT 
                `number`, COUNT(*) AS `kiekis`, 
                ROUND(MAX(`distance`/`time`*3.6),2) AS `greitis` 
                FROM `radars` 
                GROUP BY `number` 
                ORDER By `greitis`"; 
    //$auto = "SELECT DISTINCT `number`, COUNT(*) AS `kiekis`, ROUND(MAX(`distance`/`time`*3.6),2) AS `greitis` FROM `radars` GROUP BY `number` ORDER By `greitis` DESC LIMIT .$start_from , $results_per_page"; 
    table2($conn, $auto);
} 
if (isset($_POST['year']) ){
     $year = "SELECT DISTINCT 
                YEAR(date) AS `metai`, 
                COUNT(*) AS `kiekis`, 
                ROUND(MAX(`distance`/`time`*3.6)) AS `maks_greitis`,
                ROUND(AVG(`distance`/`time`*3.6)) AS `vid_greitis`, 
                ROUND(MIN(`distance`/`time`*3.6)) AS `maz_greitis` 
                FROM `radars` 
                GROUP BY `metai` 
                ORDER By `metai`"; 
 
    table3($conn, $year);
} 
if (isset($_POST['month']) ){
     $month = "SELECT 
                    YEAR(date) AS `metai`, 
                    MONTH(date) AS `menuo`, 
                    COUNT(*) AS `kiekis`, 
                    ROUND(MAX(`distance`/`time`*3.6)) AS `maks_greitis`, 
                    ROUND(AVG(`distance`/`time`*3.6)) AS `vid_greitis`,
                    ROUND(MIN(`distance`/`time`*3.6)) AS `maz_greitis` 
                    FROM `radars` 
                    GROUP BY `metai`, `menuo` 
                    ORDER By `metai`"; 
    table4($conn, $month);
} 
form1($conn, $values);
table1($conn, $start_from, $results_per_page );
$sql = "SELECT COUNT(`id`) AS `total` FROM radars";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
echo "Puslapiai: ";  
for ($i=1; $i<=$total_pages; $i++) {                    // print links for all pages
            echo "<a href='?page=".$i."'";
            if ($i==$page)  echo " class='curPage'";
                echo ">" .$i ."</a> ... "; 
}; 
function connect(){
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
    return $conn;
}
function insert($conn){
    $stmt = $conn->prepare("INSERT INTO radars(date, number, distance, time) VALUES(?, ?, ?, ?)");
    
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $number = mysqli_real_escape_string($conn,  $_POST['number']);
    $distance = mysqli_real_escape_string($conn, $_POST['distance']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $stmt->bind_param("ssdd", $date, $number, $distance, $time);
    $stmt->execute();
}
function update($conn, $values){
    $stmt = $conn->prepare("UPDATE radars SET date = ?, number = ?, distance = ?, time = ? WHERE id = ?");
    
    $id = mysqli_real_escape_string($conn,$_REQUEST['id']);
    $date = mysqli_real_escape_string($conn, $_REQUEST['date']);
    $number = mysqli_real_escape_string($conn,  $_REQUEST['number']);
    $distance = mysqli_real_escape_string($conn, $_REQUEST['distance']);
    $time = mysqli_real_escape_string($conn, $_REQUEST['time']);
    $stmt->bind_param("ssddi", $date, $number, $distance, $time, $id);
    $stmt->execute();
    header("Location: " . $_SERVER['PHP_SELF']);        /* Redirect browser */
        exit();    
}
function delete($conn){
    $id = $_POST['delete'];
    $sql = "DELETE FROM radars WHERE id = ?"; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();    
}
function form1($conn, $values){ 
?>
<!-- Duomenų įvedimo Forma -->
<h1>Įveskite duomenis:</h1>
<form action="" method="post">               
    Data: <br>
    <input type="text" name="date" value = "<?php if (isset($_GET['id'])): echo $values['date']; endif; ?>"><br> 
    Automobilio numeris: <br>
    <input type="text" name="number" value = "<?php if (isset($_GET['id'])): echo $values['number']; endif;  ?>"><br>
    Nuvažiuotas atstumas: <br>
    <input type="text" name="distance"value = "<?php if (isset($_GET['id'])): echo $values['distance']; endif;  ?>"><br>
    Kelionės trukmė: <br>
    <input type="text" name="time"value = "<?php if (isset($_GET['id'])): echo $values['time']; endif;  ?>"><br>
    <input type="hidden" name="id" value="<?php if (isset($_GET['id'])): echo $values['id']; endif;  ?>"><br>
    <input type="submit" name ="send" value="Patvirtinti"><br><br>
</form>

<?php } ?>

<?php function form2(){ ?>

<form action="" method="post">               
    <button type="submit"name="home" value="17_Uzduotis.php" >Pradžia</button>
    <input type="submit" name ="auto" value="Automobiliai"></t>
    <input type="submit" name ="year" value="Metai"></t>
    <input type="submit" name ="month" value="Mėnuo">
</form>

<?php } ?>

<?php 
function table1($conn, $start_from, $results_per_page ){
    $sql = "SELECT *, `distance`/`time`*3.6 as `speed` FROM radars ORDER BY `id`, `number` DESC LIMIT $start_from , $results_per_page" ;
    $result = $conn->query($sql);
    if ($result->num_rows > 0): ?>
        <h3>Rūšiuojama pagal id, didėjimo tvarka: </h3>
        <table border="1">
            <tr>
                <th bgcolor="#CCCCCC">#</th>
                <th bgcolor="#CCCCCC">ID</th>
                <th bgcolor="#CCCCCC">Date</th>
                <th bgcolor="#CCCCCC">Number</th>
                <th bgcolor="#CCCCCC">Distance,m</th>
                <th bgcolor="#CCCCCC">Time,s</th>
                <th bgcolor="#CCCCCC">Speed, km/h</th>
                <th bgcolor="#CCCCCC"></th>
                <th bgcolor="#CCCCCC"></th>
            </tr>
            <?php while($row = $result->fetch_assoc()) :    // output data of each row?>
                <tr>
                    <td><?php echo ++$start_from; ?></td>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['number']; ?></td>
                    <td><?php echo $row['distance']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                    <td align="right"><?php echo round($row['speed'], 2); ?></td>
                    <td><a href = "?id=<?php echo $row['id']; ?>">Update</a></td>
                    <td><form action="" method="post"><button name="delete" value="<?= $row['id'] ?>" type="submit">Delete</button></form></td>
                </tr>  
            <?php endwhile; ?>     
        </table>
    <?php else: 
      echo "Nėra duomenų.";
    endif;
}
function table2($conn, $auto){
    $sql = $auto;
    $result = $conn->query($sql);
    $n=1;
    if ($result->num_rows > 0): ?>
        <h3>“Automobiliai”: </h3>
        <table border="1">
            <tr>
                <th bgcolor="#CCCCCC">Nr.</th>
                <th bgcolor="#CCCCCC">Numeris</th>
                <th bgcolor="#CCCCCC">Įrašų Kiekis</th>
                <th bgcolor="#CCCCCC">Maksimalus Greitis</th>
            </tr>
            <?php while($row = $result->fetch_assoc()) :    // output data of each row?>
                <tr>
                    <td align="center"><?php echo $n++; ?></td>
                    <td align="center"><?php echo $row['number']; ?></td>
                    <td align="center"><?php echo $row['kiekis']; ?></td>
                    <td align="center"><?php echo $row['greitis']; ?></td>                    
                </tr>  
            <?php endwhile; ?>     
        </table>
    <?php else: 
      echo "Nėra duomenų.";
    endif;
}
function table3($conn, $year){
    $sql = $year;
    $n=1;
    $result = $conn->query($sql);
    if ($result->num_rows > 0): ?>
        <h3>Metai: </h3>
        <table border="1">
            <tr>
                <th bgcolor="#CCCCCC">Nr.</th>
                <th bgcolor="#CCCCCC">Metai</th>
                <th bgcolor="#CCCCCC">Įrašų Kiekis</th>
                <th bgcolor="#CCCCCC">Maksimalus Greitis</th>
                <th bgcolor="#CCCCCC">Vidutinis Greitis</th>
                <th bgcolor="#CCCCCC">Mažiausias Greitis</th>
            </tr>
            <?php while($row = $result->fetch_assoc()) :    // output data of each row?>
                <tr>
                    <td align="center"><?php echo $n++; ?></td>
                    <td align="center"><?php echo $row['metai']; ?></td>
                    <td align="center"><?php echo $row['kiekis']; ?></td>
                    <td align="center"><?php echo $row['maks_greitis']; ?></td>  
                    <td align="center"><?php echo $row['vid_greitis']; ?></td> 
                    <td align="center"><?php echo $row['maz_greitis']; ?></td>                   
                </tr>  
            <?php endwhile; ?>     
        </table>
    <?php else: 
      echo "Nėra duomenų.";
    endif;
}
function table4($conn, $month){
    $sql = $month;
    $n=1;
    $result = $conn->query($sql);
    if ($result->num_rows > 0): ?>
        <h3>Metai: </h3>
        <table border="1">
            <tr>
                <th bgcolor="#CCCCCC">Nr.</th>
                <th bgcolor="#CCCCCC">Metai</th>
                <th bgcolor="#CCCCCC">Mėnuo</th>
                <th bgcolor="#CCCCCC">Įrašų Kiekis</th>
                <th bgcolor="#CCCCCC">Maksimalus Greitis</th>
                <th bgcolor="#CCCCCC">Vidutinis Greitis</th>
                <th bgcolor="#CCCCCC">Mažiausias Greitis</th>
            </tr>
            <?php while($row = $result->fetch_assoc()) :    // output data of each row?>
                <tr>
                    <td align="center"><?php echo $n++; ?></td>
                    <td align="center"><?php echo $row['metai']; ?></td>
                    <td align="center"><?php echo $row['menuo']; ?></td>
                    <td align="center"><?php echo $row['kiekis']; ?></td>
                    <td align="center"><?php echo $row['maks_greitis']; ?></td>  
                    <td align="center"><?php echo $row['vid_greitis']; ?></td> 
                    <td align="center"><?php echo $row['maz_greitis']; ?></td>                   
                </tr>  
            <?php endwhile; ?>     
        </table>
    <?php else: 
      echo "Nėra duomenų.";
    endif;
}
$conn->close(); 
?>
</body>
</html>