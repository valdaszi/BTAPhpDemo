<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <?php
            $a = array('Jonas', 'Petras', 'Antanas', 'Povilas');

            $b = array();
            for ($i = 0; $i < count($a); $i++) {
                for ($j = 0; $j < count($a); $j++) {
                    if ($i != $j) {
                        $b[] = array($a[$i], $a[$j]);
                        //array_push($b, array($a[$i], $a[$j]));
                    }
                }
            }

            foreach($b as $pora) {
                echo "$pora[0] - $pora[1]".'<br>';
            }

        ?>
    </body>
</html>