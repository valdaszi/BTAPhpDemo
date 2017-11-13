<?php

function lentele($conn)
{
    $sql = 'SELECT *, `distance`/`time`*3.6 as `speed` FROM radars ORDER BY number, date DESC';

    $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
?>      
        <form action="<?= $_SERVER['SCRIPT_NAME'] ?>" method="get">
        <table>
            <tr>
                <th>Eil.Nr.</th>
                <th>ID</th>
                <th>Reg.Nr.</th>
                <th>Data</th>
                <th>Atstumas </th>
                <th>Laikas </th>
                <th>Greitis </th>
                <th>Veiksmai </th>
            </tr>
<?php
    $nr = 1;
    while ($row = $result->fetch_assoc())
    {
?>
            <tr>
                <td><?= $nr++ ?></td>
                <td><?= $row['id'] ?></td>
                <td><?= $row['number'] ?></td>
                <td><?= $row['date'] ?></td>
                <td><?= $row['distance'] ?></td>
                <td><?= $row['time'] ?></td>
                <td><?= $row['speed'] ?></td>
                <td>
                    <button name="delete" value="<?= $row['id'] ?>" type="submit">Ištrinti</button>
                    <button name="edit" value="<?= $row['id']?>" type="submit">Redaguoti</button>
                    
                </td>
            </tr>
<?php } ?>
        </table>
        </form>
<?php }
} ?>