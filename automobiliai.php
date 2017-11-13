<?php

$sql = 'SELECT number, COUNT(*) AS kiekis,
        MAX(`distance`/`time`*3.6) AS MaxGreitis 
        FROM radars 
        GROUP BY number
        ORDER BY number 
        LIMIT 10 OFFSET ' . $offset;
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    ?>
    <table border="1">
        <tr>
            <th>Numeris</th>
            <th>Kiekis</th>
            <th>Greitis</th>
        </tr>
    
    <?php
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['number']; ?></td>
            <td><?php echo $row['kiekis']; ?></td>
            <td><?php echo $row['MaxGreitis']; ?></td>
        </tr>
        <?php
    }
    echo '</table>';
} else {
    echo 'nėra duomenų';
}