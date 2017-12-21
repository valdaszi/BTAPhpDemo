<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <h1>unset</h1>
        <pre>
        <?php
            $a = array('Palanga', 'Babtai', 'Suvalkai');
            var_dump($a);
            
            echo "unset($a[1])\n";
            
            unset($a[1]);
            var_dump($a);
        ?>
        </pre>
    </body>
</html>