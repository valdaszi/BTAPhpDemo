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
                
                function __construct($vardas, $pavarde = '') {
                    $this->vardas = $vardas;
                    $this->pavarde = $pavarde;
                }

                function pilnasVardas() {
                    return $this->vardas . ' ' . $this->pavarde;
                }
            }

            $zmogus1 = new Zmogus('Adomas');
            echo $zmogus1->pilnasVardas();
            var_dump($zmogus1);

            echo '<br>';
            $zmogus2 = new Zmogus('Ieva');
            echo $zmogus2->pilnasVardas();
            var_dump($zmogus2);


            $a = array(new Zmogus("Vycka"), new Zmogus("Ecka"), new Zmogus("Petras", "Petraitis"));
            var_dump($a);

        ?>
    </body>
</html>