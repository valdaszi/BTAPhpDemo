<?php
namespace planeta\gyvybe;

class Zmogus
{
    public static $rusis = 'Homo sapiens';
    private static $kiekis = 0;
    
    public $vardas;
    
    function __construct($vardas) {
        self::$kiekis++;
        $this->vardas = $vardas;
    }
    
    public static function zmones() {
        return self::$kiekis;
    }
}
