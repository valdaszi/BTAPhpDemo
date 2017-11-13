<table>
    <tr>
        <th>Nr</th>
        <th>Numeris</th>
        <th>Data</th>
        <th>Greitis (km/h)</th>
        <th></th>
    </tr>

<?php
// output data of each row
$nr = 1;
foreach($radars as $a): ?>
    <tr>
        <td><?= $nr++ ?></td>
        <td><?= $a->number ?></td>
        <td><?= $a->date ?></td>
        <td><?= $a->speed ?></td>
        <td>
            <a href="<?= $base ?>radars/edit?id=<?= $a->id ?>">Redaguoti</a> 
            <a href="<?= $base ?>radars/delete?id=<?= $a->id ?>">Trinti</a> 
        </td>
    </tr>
<?php endforeach; ?>
</table>
