<?php

use Illuminate\Database\Seeder;

class blogRelatedBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('relatedblogs')->insert([
            ['blog_id'=> '1', 'related_blog_id'=> '2'],
            ['blog_id'=> '1', 'related_blog_id'=> '3'],
            ['blog_id'=> '2', 'related_blog_id'=> '1'],
            ['blog_id'=> '2', 'related_blog_id'=> '3'],
            ['blog_id'=> '3', 'related_blog_id'=> '1'],
            ['blog_id'=> '3', 'related_blog_id'=> '2'],
        ]);
        
    }
}
