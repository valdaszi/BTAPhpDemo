<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <?php
            $a = array(10, 20, 30);
            $suma = 0;
            foreach ($a as $value) {
                $suma += $value;
            }
            var_dump($a);
            echo $suma.'<br>';
        ?>
        <hr>
        <?php
            $a = array('A' => array(1), 'B' => array(3, 4), 'C' => array(6, 5));
            $suma = 0;
            foreach ($a as $key => $value) {
                if ($key != 'B') {
                    $suma += $value[0];
                }
            }
            var_dump($a);
            echo $suma.'<br>';
        ?>
    </body>
</html>