<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <?php
            //date_default_timezone_set('Europe/Vilnius');
            date_default_timezone_set('GMT');

            $naujimetai = new DateTime('2017-01-01');
            $dabar = date_create(); 
            echo date_format($naujimetai,"Y-m-d"), '<br>';
            echo $dabar->format("Y-m-d H:i:s");
        ?>
    </body>
</html>