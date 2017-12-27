<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'email' => 'b@a.lt',
            'name' => 'Ona Adminė',
            'password' => bcrypt('456')
        ]);

        \App\User::create([
            'email' => 'a@a.lt',
            'name' => 'Petras Adminas',
            'password' => bcrypt('123')
        ]);

        \App\Driver::create([
            'name' => 'Jonas',
            'city' => 'Babtai'
        ]);
        \App\Driver::create([
            'name' => 'Ona',
            'city' => 'Kaunas'
        ]);
        \App\Driver::create([
            'name' => 'Petras',
            'city' => 'Palanga'
        ]);


        $radarsDistance = [5000, 4500, 5100];
        
        $raide = 'ABCDEFGHIJKLMNOPRSTUVZ';
        $sk = strlen($raide) - 1;

        $timeFrom = Carbon::create(2017, 1, 1, 0, 0, 0)->timestamp;
        $timeTo = Carbon::now()->timestamp;

        for ($i = 0; $i < 1000; $i++) {
            
            $distance = $radarsDistance[ rand(0, 2)];
            $speed = rand(120, 190);
            $time = round($distance / ($speed / 3.6));  

            $timestamp = rand($timeFrom, $timeTo);

            $number = $raide[rand(0, $sk)] . $raide[rand(0, $sk)] . $raide[rand(0, $sk)] .
                rand(0, 9) . rand(0, 9) . rand(0, 9);

            $radar = new \App\Radar();
            $radar->date = Carbon::createFromTimestamp($timestamp);
            $radar->number = $number;
            $radar->distance = $distance;
            $radar->time = $time;
            
            if ($i % 50 == 0) {
                $radar->driver_id = rand(1, 3);
            }

            $radar->creator_id = 1;
            $radar->updator_id = 1;
            
            $radar->save();
        }
    }
}
