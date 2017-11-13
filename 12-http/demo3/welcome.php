<!DOCTYPE html>
<html>
    <head>
        <title>Super duper svetainė</title>
    </head>
    <body>
        <?php 
            for ($i = 2; $i <= 9; $i++) {
                for ($j = 2; $j <= 9; $j++) {
                    echo "$i x $j = ".$i * $j.'<br>';
                }
                echo '<br>';
            }
        ?>
    </body>
</html>