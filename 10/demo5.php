<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <?php
            date_default_timezone_set('EET');

            $naujimetai = new DateTime('2017-01-01'); //date_create('2017-01-01');
            $dabar = new DateTime(); //date_create(); 
            
            $skirtumas = date_diff($dabar, $naujimetai);
            var_dump($skirtumas);

            // $skirtumas = $dabar->diff($naujimetai);
            // var_dump($skirtumas);

            // echo 'Nuo metų pradžios praėjo '.$skirtumas->days.' d.';
            // echo ' ir '.($skirtumas->days * 24 * 60 * 60 + 
            //     $skirtumas->h * 60 * 60 + $skirtumas->i * 60 +
            //     $skirtumas->s).' s';

        ?>
    </body>
</html>