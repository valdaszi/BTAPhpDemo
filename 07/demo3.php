<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <?php
            $a = array(
                'Petras' => 84,
                'Jonas' => 95,
                'Maytė' => array(45, 48, 55)
            );
            echo $a['Petras'].'<br>'; 
            echo $a['Maytė'][2].'<br>';
        ?>
        <pre>
            <?php var_dump($a); ?>
        </pre>
    </body>
</html>