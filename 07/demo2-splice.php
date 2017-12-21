<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <h1>array_splice</h1>
        <pre>
        <?php
            $a = array('Palanga', 'Babtai', 'Suvalkai');
            var_dump($a);
            
            echo "array_splice($a, 1)\n";
            
            array_splice($a, 1);
            var_dump($a);
        ?>
        <hr>
        <?php
            $a = array('Palanga', 'Babtai', 'Suvalkai');
            var_dump($a);

            echo "array_splice($a, 1, 1)\n";
            
            array_splice($a, 1, 1);
            var_dump($a);
        ?>
        <hr>
        <?php
            $a = array('Palanga', 'Babtai', 'Suvalkai');
            var_dump($a);    

            echo "array_splice($a, 1, 1, array('London', 'Paris'))\n";
            
            array_splice($a, 1, 1, array('London', 'Paris'));
            var_dump($a);
        ?>
        </pre>
    </body>
</html>