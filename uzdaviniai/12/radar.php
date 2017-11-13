<?php

class Radar
{

    public $date;
    public $number;
    public $distance;
    public $time;

    function __construct($date, $number, $distance, $time)
    {
            $this->date = $date;
            $this->number = $number;
            $this->distance = $distance;
            $this->time = $time;
    }

    function speed()
    {
        $distByKm = $this->distance/1000;
        $timHour = $this->time/3600;

        return round($distByKm/$timHour, 1); 
    }
}