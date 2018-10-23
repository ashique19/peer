<?php

use Illuminate\Database\Seeder;

class blogAndTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('blog_blogtag')->insert([
            ['blog_id'=> '1', 'blogtag_id'=> '1'],
            ['blog_id'=> '2', 'blogtag_id'=> '1'],
            ['blog_id'=> '2', 'blogtag_id'=> '2'],
            ['blog_id'=> '2', 'blogtag_id'=> '2'],
            ['blog_id'=> '3', 'blogtag_id'=> '2'],
            ['blog_id'=> '3', 'blogtag_id'=> '3'],
            ['blog_id'=> '3', 'blogtag_id'=> '1'],
            ['blog_id'=> '6', 'blogtag_id'=> '1'],
            ['blog_id'=> '6', 'blogtag_id'=> '2'],
            ['blog_id'=> '6', 'blogtag_id'=> '3'],
            ['blog_id'=> '7', 'blogtag_id'=> '1'],
            ['blog_id'=> '7', 'blogtag_id'=> '2'],
            ['blog_id'=> '7', 'blogtag_id'=> '3'],
        ]);
        
    }
}
