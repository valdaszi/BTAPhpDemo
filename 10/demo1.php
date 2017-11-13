<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <?php
            function nr() {
                static $nr = 0;
                echo ++$nr . '<br>';
            }
            
            nr();
            nr();
            nr();

            echo '$nr = '. $nr;
        ?>
    </body>
</html>