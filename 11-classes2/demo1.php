<?php
class Zmogus
{
    private static $rusis = 'Homo sapiens';
    private static $kiekis = 0;
    
    public $vardas;
    
    function __construct($vardas) {
        self::$kiekis++;
        $this->vardas = $vardas;
    }
    
    public static function zmones() {
        return self::$kiekis;
    }

    public static function rusis() {
        return self::$rusis;
    }

    protected function karta() {
        return 1;
    }
}

class Mokinys extends Zmogus
{
    private $lygis;

    function __construct($vardas, $lygis = "a") {
        parent::__construct($vardas);
        $this->lygis = $lygis;
    }

    public function karta() {
        return parent::karta() + 1;
    }
}

class Studentas extends Mokinys
{
    public function karta() {
        return parent::karta() + 1;
    }
}

$m = new Studentas('Petras', 'sks10/3');
echo 'Studentas: ' . $m->vardas . ' - karta: '.$m->karta(). '<br>';

$a = new Mokinys("Jurgis");
echo 'Mokinys: ' . $a->vardas . ' - karta: '.$a->karta(). '<br>';

// echo 'Viso žmonių pradžioje: '.Zmogus::zmones(). '<br>';
// echo 'Žmogaus rūšis: '.Zmogus::rusis(). '<br>';

// Zmogus::$kiekis = 100;
// echo 'Viso žmonių pradžioje: '.Zmogus::$kiekis. '<br>';

// $adomas = new Zmogus("Adomas");
// $ieva = new Zmogus("Ieva");

// echo 'Adomas yra: '.$adomas::rusis(). '<br>';
// echo 'Ieva yra: '.$ieva::rusis(). '<br>';

// echo 'Viso žmonių: '.Zmogus::zmones(). '<br>';
