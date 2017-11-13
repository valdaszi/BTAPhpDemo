<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <h1>unset</h1>
        <?php
            $a = array('Palanga', 'Babtai', 'Suvalkai');
            var_dump($a);
            
            echo 'unset($a[1])';
            
            unset($a[1]);
            var_dump($a);
        ?>
    </body>
</html>