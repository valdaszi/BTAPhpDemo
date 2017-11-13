<table>
    <tr>
        <th>id</th>
        <th>Numeris</th>
        <th>Data</th>
        <th>Greitis (km/h)</th>
        <th></th>
    </tr>

<?php
// output data of each row
foreach($automobiliai as $auto): ?>
    <tr>
        <td><?php echo $auto->id; ?></td>
        <td><?php echo $auto->numeris; ?></td>
        <td><?php echo $auto->data; ?></td>
        <td><?php echo $auto->greitis; ?></td>
        <td>
            <a href="auto/edit?id=<?php echo $auto->id; ?>">Redaguoti</a> 
        </td>
    </tr>
<?php endforeach; ?>
</table>
