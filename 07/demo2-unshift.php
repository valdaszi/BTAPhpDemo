<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <h1>array_unshift</h1>
        <pre>
        <?php
            $a = array('Palanga');
            var_dump($a);
            
            echo "array_unshift($a, 'Babtai', 'Suvalkai')\n";
            
            array_unshift($a, 'Babtai', 'Suvalkai');
            var_dump($a);
        ?>
        </pre>
    </body>
</html>