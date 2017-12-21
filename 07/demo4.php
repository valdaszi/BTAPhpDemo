<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <pre>
        <?php
            $a = array(
                1, 
                2, 
                4,
                5 => 32,
                10 => 1024, 
                
                2048,

                -2 => 42, 
                1, 
                'aš' => 2048, 
                -10 => 1000,
                2 => 16,
                13,
                0 => 99
                );

            var_dump($a);

            //array_splice($a, 0, 1);
            //unset($a[0]);
            //var_dump($a);
        ?>
        </pre>
    </body>
</html>