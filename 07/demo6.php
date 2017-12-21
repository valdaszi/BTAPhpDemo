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
            $a = [
                'A' => [1, 'as' => 10, -10 => 9], 
                'B' => [3, 4], 
                'C' => [6, 9 => 4]];
            $suma = 0;
            foreach ($a as $key => $value) {
                if ($key != 'B') {
                    //$suma += $value[0];
                    foreach ($value as $elem) {
                        $suma += $elem;
                    }
                }
            }
            var_dump($a);
            echo $suma.'<br>';
        ?>
    </body>
</html>