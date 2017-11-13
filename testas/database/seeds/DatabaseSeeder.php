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
        App\User::create([
            'name' => 'Adminas Jonas',
            'email' => 'admin@firma.lt',
            'password' => bcrypt('123456')
        ]);
        App\User::create([
            'name' => 'Ona Petrona',
            'email' => 'ona@firma.lt',
            'password' => bcrypt('111111')
        ]);

        // $this->call(UsersTableSeeder::class);
        App\Driver::create([
            'name' => 'Jonas',
            'surname' => 'Jonaitis',
            'city' => 'Babtai',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'creator_id' => 1, 
            'updater_id' => 1
        ]);
        App\Driver::create([
            'name' => 'Ona',
            'surname' => 'Onė',
            'city' => 'Raudondvaris',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'creator_id' => 2, 
            'updater_id' => 2
        ]);
        App\Driver::create([
            'name' => 'Petras',
            'surname' => 'Petraitis',
            'city' => 'Palanga',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'creator_id' => 2, 
            'updater_id' => 1
        ]);


        // rand(min, max)       
        $radarsDistance = [5000, 4500, 5100];

        $raide = 'ABCDEFGHIJKLMNOPRSTUVZ';
        $sk = strlen($raide) - 1;

        for ($i = 0; $i < 1000; $i++) {
            
            $distance = $radarsDistance[ rand(0, 2)];
            $speed = rand(120, 190);
            $time = round($distance / ($speed / 3.6));  

            // https://www.unixtimestamp.com/index.php
            // 01/01/2017 - 10/23/2017 @ 1:14pm (UTC)
            $timestamp = rand(1483228800, 1508764460);

            $number = $raide[rand(0, $sk)] . $raide[rand(0, $sk)] . $raide[rand(0, $sk)] .
                rand(0, 9) . rand(0, 9) . rand(0, 9);

            if (rand(0, 10) == 0) {
                $driverId = rand(1, 3);
            } else {
                $driverId = null;
            }


            App\Radar::create([
                'date' => Carbon::createFromTimestamp($timestamp),
                'number' => $number,
                'distance' => $distance,
                'time' => $time,
                'driver_id' => $driverId,
                
                'created_at' => Carbon::createFromTimestamp($timestamp),
                'updated_at' => Carbon::createFromTimestamp($timestamp),

                'creator_id' => rand(1, 2),
                'updater_id' => rand(1, 2)
            ]);
        }
    }
}