<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <h1>array_push</h1>
        <pre>
        <?php
            $a = array('Palanga');
            var_dump($a);
            
            echo '$a[] = \'Londonas\'';
            
            $a[] = 'Londonas';
            var_dump($a);

            echo 'array_push($a, \'Babtai\', \'Suvalkai\')';
            
            array_push($a, 'Babtai', 'Suvalkai');
            var_dump($a);
        ?>
        </pre>
    </body>
</html>