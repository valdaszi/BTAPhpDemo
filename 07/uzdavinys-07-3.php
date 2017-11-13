<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <?php
            $a = array('A' => array(2, 3, 4), 'B' => array(2, 5, 7, 8));

            $maxstulpeliai = 0;
            foreach ($a as $value) {
                $ilgis = count($value);
                if ($ilgis > $maxstulpeliai) {
                    $maxstulpeliai = $ilgis;
                }
            }

            $sumos = array();
            for ($i = 0; $i < $maxstulpeliai; $i++) {
                $suma = 0;
                foreach ($a as $eilute) {
                    $suma += $eilute[$i];
                }
                $sumos[] = $suma;
            } 
            $maxsuma = max($sumos);

            echo $maxsuma;
        ?>
    </body>
</html>