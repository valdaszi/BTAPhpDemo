<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <?php
            $mokiniai = array(
                array(vardas => 'Jonas', pazymiai => array(
                    lietuviu => array(4, 8, 6, 7), 
                    anglu => array(6, 7, 8), 
                    matematika => array(3, 5, 4))),
                array(vardas => 'Ona', pazymiai => array(
                    lietuviu => array(10, 9, 10), 
                    anglu => array(9, 8, 10), 
                    matematika => array(10, 10, 9, 9)))
            );

            // $p = array(lietuviu => 7, anglu => 8)
            function vidurkis($p) {
                if (count($p) == 0) {
                    return 0;
                }
                $suma = 0;
                foreach ($p as $pazymys) {
                   $suma += $pazymys; 
                }
                return $suma / count($p); 
            }
            /* 
                $pazymiai = array(
                    lietuviu => array(4, 8, 6, 7), 
                    anglu => array(6, 7, 8))
                return: array(lietuviu => 7, anglu => 8)
            */
            function rezultatas($pazymiai) {
                $rezultatas = array();
                foreach ($pazymiai as $dalykas => $balai) {
                    $rezultatas[$dalykas] = trimestras($balai);
                }
                return $rezultatas;
            }

            // $balai = array(6, 7, 8)
            function trimestras($balai) {
                if (count($balai) == 0) {
                    return 0;
                }
                $suma = 0;
                foreach ($balai as $balas) {
                    $suma += $balas;
                }
                return round($suma / count($balai));
            }

            $trimestras = array(); 

            foreach ($mokiniai as $mokinys) {
                $trimestras[] = array(
                    vardas => $mokinys['vardas'], 
                    rezultatas => rezultatas($mokinys['pazymiai'])
                );
            }

            // array(vardas => "Jonas", rezultatas => array(lietuviu => 7, anglu => 8))
            $vardas = '';
            $vidurkis = 0;
            foreach ($trimestras as $m) {
                $v = vidurkis($m['rezultatas']);
                if ($v > $vidurkis) {
                    $vidurkis = $v;
                    $vardas = $m['vardas'];
                }
            }
            echo $vardas . ' su vidurkiu '.$vidurkis;

        ?>
    </body>
</html>