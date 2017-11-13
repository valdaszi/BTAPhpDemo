<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <?php
            $a = array(10, 12, array('Jonas', 'Petras', true), 'Palanga');
            if ($a[0] < 20) {
                echo "A";
            } else {
                echo "b";
            }
            echo '<pre>';
            print_r($a);
            echo '</pre>';
            var_dump($a);
        ?>
    </body>
</html>