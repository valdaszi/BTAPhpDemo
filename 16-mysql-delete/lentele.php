<?php

function lentele($conn, $page, $offset) {
    // išvedame automobilius
    $sql = 'SELECT id, date, number, distance, time, distance/time*3.6 as speed FROM radars ORDER BY number, date DESC LIMIT ? OFFSET ?';
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $page, $offset);
    $stmt->execute();

    /* bind result variables */
    $stmt->bind_result($id, $date, $number, $distance, $time, $speed);

    ?>
    <table>
        <tr>
            <th>Nr.</th>
            <th>id</th>
            <th>Numeris</th>
            <th>Data</th>
            <th>Atstumas (km)</th>
            <th>Laikas (h)</th>
            <th>Greitis (km/h)</th>
        </tr>
    
    <?php
    // output data of each row
    $nr = 1; ?>
    <?php  while($stmt->fetch()): ?> 
        <tr>
            <td><?= $nr++ ?></td>
            <td><?= $id ?></td>
            <td><?= $number ?></td>
            <td><?= $date ?></td>
            <td><?= $distance ?></td>
            <td><?= $time ?></td>
            <td><?= $speed ?></td>
        </tr>
    <?php endwhile; ?>
    
    </table>
    <?php
}

?>