<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <?php
            $a = array(
                '49001010123' => array(
                    'vardas' => 'Jonas',
                    'pavarde' => 'Jonaitis',
                    'gdata' => '1990-01-01'
                    ),
                '37502055584' => array(
                    'vardas' => 'Petras',
                    'pavarde' => 'Petraitis',
                    'gdata' => '1985-02-05'
                    ),
            );
            var_dump($a);
            var_dump($a['37502055584']);
            var_dump($a['37502055584']['gdata']);
        ?>
    </body>
</html>