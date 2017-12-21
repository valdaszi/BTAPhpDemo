<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <?php
            $a = [
                [vardas => 'Jonas', ugis => 2.0],
                [vardas => 'Petras', ugis => 1.75],
                [vardas => 'Antanas', ugis => 1.8]
            ];
            
            var_dump($a);

            // p1, p2: array(vardas => 'Jonas', ugis => 2.0)
            // function lyginimas($p1, $p2) {
            //     if ($p1['ugis'] == $p2['ugis']) {
            //         return 0;
            //     } elseif ($p1['ugis'] < $p2['ugis']) {
            //         return -1;
            //     } else {
            //         return 1;
            //     }
            // }
            // usort($a, lyginimas);
            // var_dump($a);

            // $lyginimas = function($p1, $p2) {
            //     if ($p1['ugis'] == $p2['ugis']) {
            //         return 0;
            //     } elseif ($p1['ugis'] < $p2['ugis']) {
            //         return -1;
            //     } else {
            //         return 1;
            //     }
            // };
            // usort($a, $lyginimas);
            // var_dump($a);

            // $p1 = array(ugis => 2.2);
            // $p2 = array(ugis => 2.1);
            // echo lyginimas($p1, $p2);

            // function lyginimas($p1, $p2) {
            //     if ($p1['ugis'] == $p2['ugis']) return 0;
            //     elseif ($p1['ugis'] < $p2['ugis']) return -1;
            //     else return 1;
            // }
            // function lyginimas($p1, $p2) {
                // return $p1['ugis'] == $p2['ugis'] ? 0 :
                //     $p1['ugis'] < $p2['ugis'] ? -1 : 1; 
            // }
            // usort($a, lyginimas);
            // var_dump($a);

            usort($a, function($p1, $p2) {
                return $p1['ugis'] == $p2['ugis'] ? 0 :
                   $p1['ugis'] < $p2['ugis'] ? -1 : 1;
            });
            var_dump($a);
        ?>
    </body>
</html>