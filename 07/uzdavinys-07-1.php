<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <?php
            $a = array('Jonas', 'Petras', 'Antanas', 'Povilas');

            $b = array();
            for ($i = 0; $i < count($a)-1; $i++) {
                for ($j = $i + 1; $j < count($a); $j++) {
                    $b[] = array($a[$i], $a[$j]);
                }
            }

            foreach($b as $pora) {
                echo "$pora[0] - $pora[1]".'<br>';
            }

        ?>
    </body>
</html>