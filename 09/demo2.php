<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <?php
            class Zmogus
            {
                public $vardas;
                public $pavarde;
                
                function __construct($vardas, $pavarde) {
                    $this->vardas = $vardas;
                    $this->pavarde = $pavarde;
                }
                
                function pilnasVardas() {
                    return $this->vardas . ' ' . $this->pavarde;
                }
            }

            class Mokinys extends Zmogus 
            {
                public $lygis;      // pvz 6a ar 9b
                public $dalykai;    // masyvas mokinio dalykų
            }


            $mokinys1 = new Mokinys('Jonas', 'Jonaitis');
            echo $mokinys1->pilnasVardas();

            var_dump($mokinys1);
        ?>
    </body>
</html>