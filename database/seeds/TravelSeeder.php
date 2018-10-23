<?php

use Illuminate\Database\Seeder;

class TravelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('travels')->insert([
            ['arrival_date'=> \Carbon::now()->addDay(15)->format('Y-m-d'), 'departure_date'=> \Carbon::now()->addDay(15)->format('Y-m-d'), 'travel_date'=> \Carbon::now()->addDay(19)->format('Y-m-d'), 'country_from'=> 1,  'country_to'=> 2, 'airport_from'=> '1', 'airport_to'=> '5', 'user_id'=> 4, 'created_at' => \Carbon::now()->addDay(7)->format('Y-m-d')],
            ['arrival_date'=> \Carbon::now()->addDay(21)->format('Y-m-d'), 'departure_date'=> \Carbon::now()->addDay(20)->format('Y-m-d'), 'travel_date'=> \Carbon::now()->addDay(19)->format('Y-m-d'), 'country_from'=> 1,  'country_to'=> 2, 'airport_from'=> '1', 'airport_to'=> '5', 'user_id'=> 5, 'created_at' => \Carbon::now()->addDay(6)->format('Y-m-d')],
            ['arrival_date'=> \Carbon::now()->addDay(22)->format('Y-m-d'), 'departure_date'=> \Carbon::now()->addDay(21)->format('Y-m-d'), 'travel_date'=> \Carbon::now()->addDay(19)->format('Y-m-d'), 'country_from'=> 1,  'country_to'=> 2, 'airport_from'=> '1', 'airport_to'=> '5', 'user_id'=> 6, 'created_at' => \Carbon::now()->addDay(3)->format('Y-m-d')],
            ['arrival_date'=> \Carbon::now()->addDay(23)->format('Y-m-d'), 'departure_date'=> \Carbon::now()->addDay(22)->format('Y-m-d'), 'travel_date'=> \Carbon::now()->addDay(19)->format('Y-m-d'), 'country_from'=> 1,  'country_to'=> 2, 'airport_from'=> '1', 'airport_to'=> '5', 'user_id'=> 4, 'created_at' => \Carbon::now()->addDay(8)->format('Y-m-d')],
            ['arrival_date'=> \Carbon::now()->addDay(24)->format('Y-m-d'), 'departure_date'=> \Carbon::now()->addDay(24)->format('Y-m-d'), 'travel_date'=> \Carbon::now()->addDay(19)->format('Y-m-d'), 'country_from'=> 1,  'country_to'=> 2, 'airport_from'=> '1', 'airport_to'=> '5', 'user_id'=> 4, 'created_at' => \Carbon::now()->addDay(9)->format('Y-m-d')],
            ['arrival_date'=> \Carbon::now()->addDay(25)->format('Y-m-d'), 'departure_date'=> \Carbon::now()->addDay(25)->format('Y-m-d'), 'travel_date'=> \Carbon::now()->addDay(19)->format('Y-m-d'), 'country_from'=> 13, 'country_to'=> 2, 'airport_from'=> '1', 'airport_to'=> '5', 'user_id'=> 5, 'created_at' => \Carbon::now()->addDay(2)->format('Y-m-d')],
            ['arrival_date'=> \Carbon::now()->addDay(26)->format('Y-m-d'), 'departure_date'=> \Carbon::now()->addDay(26)->format('Y-m-d'), 'travel_date'=> \Carbon::now()->addDay(19)->format('Y-m-d'), 'country_from'=> 13, 'country_to'=> 2, 'airport_from'=> '1', 'airport_to'=> '5', 'user_id'=> 5, 'created_at' => \Carbon::now()->addDay(4)->format('Y-m-d')],
            ['arrival_date'=> \Carbon::now()->addDay(27)->format('Y-m-d'), 'departure_date'=> \Carbon::now()->addDay(27)->format('Y-m-d'), 'travel_date'=> \Carbon::now()->addDay(19)->format('Y-m-d'), 'country_from'=> 13, 'country_to'=> 2, 'airport_from'=> '1', 'airport_to'=> '5', 'user_id'=> 4, 'created_at' => \Carbon::now()->addDay(7)->format('Y-m-d')],
            ['arrival_date'=> \Carbon::now()->addDay(28)->format('Y-m-d'), 'departure_date'=> \Carbon::now()->addDay(28)->format('Y-m-d'), 'travel_date'=> \Carbon::now()->addDay(19)->format('Y-m-d'), 'country_from'=> 13, 'country_to'=> 2, 'airport_from'=> '1', 'airport_to'=> '5', 'user_id'=> 6, 'created_at' => \Carbon::now()->addDay(9)->format('Y-m-d')],
        ]);
        
    }
}
