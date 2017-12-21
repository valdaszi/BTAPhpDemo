<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <?php
            $a = [10, 12, ['Jonas', 'Petras', true], 'Palanga'];
            if ($a[0] < 20) {
                echo "A";
            } else {
                echo "b";
            }
            echo '<pre>';
            print_r($a);
            echo '</pre>';
            echo '<pre>';
            var_dump($a);
            echo '</pre>';
        ?>
    </body>
</html>