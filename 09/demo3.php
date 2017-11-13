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

                function __construct($vardas, $pavarde, $lygis = null) {
                    parent::__construct($vardas, $pavarde);
                    $this->lygis = $lygis;
                }
            }

            $mokinys1 = new Mokinys('Jonas', 'Jonaitis', '3c');
            var_dump($mokinys1);

            $mokinys2 = new Mokinys('Petras', 'Petraitis');
            var_dump($mokinys2);
        ?>
    </body>
</html>