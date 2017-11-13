<form> 
    <div>
        <label for="date">Data:</label>
        <input id="date" name="date" value="<?= $date ?>"require>
    </div>
    <div>
        <label for="number">Numeris:</label>
        <input id="number" name="number" value="<?= $number ?>" require>
    </div>
    <div>
        <label for="distance">Nuvažiuotas atstumas metrais:</label>
        <input type="number" id="distance" name="distance" value="<?= $distance ?>" require>
    </div>
    <div>
        <label for="time">Laikas:</label>
        <input type="number" id="time" name="time" value="<?= $time ?>" require>
    </div>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button name="action" type="submit" >Išsaugoti</button>
</form>
<br> 

<?php

//visi
$sql = 'SELECT `id`, `number`, `distance`/`time` as `speed`, `date`, name
    FROM radars 
    LEFT JOIN drivers ON drivers.driverId = radars.driverId
    ORDER BY `date` DESC 
    LIMIT 10 OFFSET ' . $offset; 

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    ?>
    <table border="1">
        <tr>
            <th>Data</th>
            <th>Numeris</th>
            <th>Greitis</th>
            <th>Vairuotojas</th>
            <th>Koregavimas</th>
        </tr>
    
    <?php
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['number']; ?></td>
            <td><?php echo $row['speed']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td> 
            <form> 
                <button name="taisyti" value="<?php echo $row['id']; ?>">Koreguoti</button>
                <button name="delete" value="<?php echo $row['id']; ?>">Ištrinti</button>
                <button name="assign" value="<?php echo $row['id']; ?>">Priskirti</button>
            </form>
                
            </td>
        </tr>
        <?php
    }
    echo '</table>';
} else {
    echo 'nėra duomenų';
} 
