<!DOCTYPE html>
<html>
    <head>
        <title>Demo 06</title>
    </head>
    <body>
        <?php
            function skyrius($a, $b) {
                echo '<hr>';
                echo '<h1>'. $a. ' <i>'. $b. '</i></h1>';
                echo '<br>';
            }
            
            skyrius(1, 'skyrius - Masyvai');
            skyrius(2, 'priedas - Funkcijos');

            skyrius(3, 'max2');

            function max2($a, $b) {
                if ($a > $b) {
                    return $a;
                } elseif ($a < $b) {
                    return $b;
                } else {
                    return 0;
                }
            }
            
            echo max2(10, 20).'<br>';
            echo max2(30, 20).'<br>';
            echo max2(20, 20).'<br>';

            skyrius(4, 'faktorialas');

            function faktorialas($a) {
                if ($a == 1) {
                    return $a;
                } else {
                    return $a * faktorialas($a - 1);
                }
            }
            
            echo '3! = '. faktorialas(3) . '<br>';
            echo '10! = '. faktorialas(10) . '<br>';

            skyrius(4, 'skaitmenys');

            function skaitmenys($a) {
                $ats = array();
                while ($a > 0) {
                    array_unshift($ats, $a % 10);
                    $a = ($a - $a % 10) / 10;
                }
                return $ats;
            }
            $s = skaitmenys(142);
            echo '142: ' . $s[0] . '-' . $s[1] . '-' . $s[2];

            skyrius('', 'pabaiga');
        ?>
    </body>
</html>
