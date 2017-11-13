<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RadarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('radars')->insert([
            'date' => Carbon::create(2017, 1, 1, 23, 25, 50),
            'number' => 'AAA123',
            'distance' => 5000,
            'time' => 99,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('radars')->insert([
            'date' => Carbon::create(2017, 1, 1, 23, 25, 55),
            'number' => 'ASS111',
            'distance' => 5000,
            'time' => 90,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
