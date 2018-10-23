<?php

use Illuminate\Database\Seeder;

class blogAndCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('blog_blogcategory')->insert([
            ['blog_id'=> '1', 'blogcategory_id'=> '1'],
            ['blog_id'=> '1', 'blogcategory_id'=> '2'],
            ['blog_id'=> '1', 'blogcategory_id'=> '3'],
            ['blog_id'=> '1', 'blogcategory_id'=> '4'],
            ['blog_id'=> '1', 'blogcategory_id'=> '5'],
            ['blog_id'=> '2', 'blogcategory_id'=> '1'],
            ['blog_id'=> '2', 'blogcategory_id'=> '2'],
            ['blog_id'=> '2', 'blogcategory_id'=> '3'],
            ['blog_id'=> '2', 'blogcategory_id'=> '4'],
            ['blog_id'=> '2', 'blogcategory_id'=> '5'],
            ['blog_id'=> '3', 'blogcategory_id'=> '2'],
            ['blog_id'=> '3', 'blogcategory_id'=> '4'],
            ['blog_id'=> '3', 'blogcategory_id'=> '3'],
            ['blog_id'=> '3', 'blogcategory_id'=> '1'],
        ]);
        
    }
}
