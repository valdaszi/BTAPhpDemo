<?php 
    require_once 'radar.php';

    session_start();
    if (isset($_SESSION['radars'])) {
        $radars = $_SESSION['radars'];    
    } else {
        $radars = array(); 
            //new Radar('2016-12-31 23:59:59', 'A 6', 5000, 120)
    }

    if (isset($_POST['date'])) { // && isset($_POST['number']) ...
        $naujas = new Radar($_POST['date'], $_POST['number'], $_POST['distance'], $_POST['time']);
        $radars[] = $naujas;
        $_SESSION['radars'] = $radars;

        header("Location: index.php"); // po refresh nuolat pasipildydavo buvusiu $_POST reiksme 
    }
?> 
<!DOCTYPE html>
<html>
    <head>
        <title>Super duper svetainė</title>
    </head>
    <body>            
        <form action="index.php" method="post">
            Vaziavimo data: <input type="text" name="date" required><br>
            Atomobilio numeris: <input type="text" name="number" required><br>
            Nuvaziuotas atstumas: <input type="number" name="distance" required><br>
            Vaziavimo laikas: <input type="number" name="time" required><br>
            <button type="submit">Prideti</button>
        </form>
        
        <hr>

        <table>
            <caption>Radars</caption>
            <tr>
                <td>Važiavimo data</td>
                <td>Automobilio nr.</td>
                <td>Nuvažiuotas kelias m.</td>
                <td>Važiavimo laikas s.</td>
                <td>Greitis km/h</td>
            </tr>
            <?php foreach ($radars as $radar): ?>
                <tr>
                    <td><?php echo $radar->date; ?></td>
                    <td><?php echo $radar->number; ?></td>
                    <td><?php echo $radar->distance; ?></td>
                    <td><?php echo $radar->time; ?></td>
                    <td><?php echo $radar->speed(); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>