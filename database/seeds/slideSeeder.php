<?php

use Illuminate\Database\Seeder;

class slideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('slides')->insert([
            ['name'=> 'airposted slide 1', 'slide_photo'=> '/public/img/slider/1.png', 'slider_id'=> 1],
            ['name'=> 'airposted slide 2', 'slide_photo'=> '/public/img/slider/2.png', 'slider_id'=> 1],
            ['name'=> 'airposted slide 3', 'slide_photo'=> '/public/img/slider/3.png', 'slider_id'=> 1],
        ]);
        
    }
}
