<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <?php
            function dalikliai($n) {
                $ats = array();
                for ($i = 1; $i <= $n / 2; $i++) {
                    if ($n % $i == 0) {
                      array_push($ats, $i);  
                    }
                }
                return $ats;
            }

            function arTobulas($n, $a) {
                $suma = 0;
                for ($i = 0; $i < count($a); $i++) {
                    $suma += $a[$i];
                }
                return $n == $suma;
            }

            for ($i = 2; $i <= 1000; $i++) {
                $d = dalikliai($i);
                if (arTobulas($i, $d)) {
                    echo $i." = ";
                    for ($j = 0; $j < count($d); $j++) {
                        if ($j > 0) {
                            echo ' + ';
                        }
                        echo $d[$j];
                    }    
                    echo '<br>';
                }
            }
        ?>
    </body>
</html>