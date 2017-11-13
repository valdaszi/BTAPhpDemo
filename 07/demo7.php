<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <?php
            $a = array(10, 20, 30, 40, 50);
            var_dump($a);
            for ($i = 0; $i < count($a); $i++) {
                $a[$i] = $a[count($a)-$i];
            }
            var_dump($a);
        ?>
    </body>
</html>