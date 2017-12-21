<?php

function lentele($conn) {
    // išvedame
    $sql = 'SELECT *, `distance`/`time`*3.6 as `speed` FROM radars ORDER BY `number`, `date` DESC';

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        ?>
        <table>
            <tr>
                <th>Numeris</th>
                <th>Data</th>
                <th>Atstumas (m)</th>
                <th>Laikas (s)</th>
                <th>Greitis (km/h)</th>
                <th></th>
            </tr>
        
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['number']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['distance']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                    <td><?php echo round($row['speed'], 1); ?></td>
                    <td><a href="?taisyti=<?php echo $row['id']; ?>">Taisyti</a></td>
                </tr>
            <?php endwhile; ?>
        
        </table>

        <?php

    } else {
        echo 'nėra duomenų';
    }
}
