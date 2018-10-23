<?php

use Illuminate\Database\Seeder;

class blogVotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('blogvotes')->insert([
            ['name'=> 2, 'blog_id'=>1, 'user_id'=> '1'],
            ['name'=> 4, 'blog_id'=>1, 'user_id'=> '1'],
            ['name'=> 4, 'blog_id'=>1, 'user_id'=> null],
            ['name'=> 3, 'blog_id'=>1, 'user_id'=> null],
            ['name'=> 5, 'blog_id'=>1, 'user_id'=> null],
            ['name'=> 3, 'blog_id'=>1, 'user_id'=> null],
            ['name'=> 4, 'blog_id'=>1, 'user_id'=> null],
            ['name'=> 2, 'blog_id'=>1, 'user_id'=> null],
            ['name'=> 1, 'blog_id'=>1, 'user_id'=> null],
            ['name'=> 2, 'blog_id'=>1, 'user_id'=> '1'],
            ['name'=> 4, 'blog_id'=>1, 'user_id'=> '1'],
            ['name'=> 4, 'blog_id'=>1, 'user_id'=> '1'],
            ['name'=> 3, 'blog_id'=>2, 'user_id'=> '1'],
            ['name'=> 5, 'blog_id'=>2, 'user_id'=> '1'],
            ['name'=> 3, 'blog_id'=>2, 'user_id'=> '1'],
            ['name'=> 4, 'blog_id'=>2, 'user_id'=> '1'],
            ['name'=> 2, 'blog_id'=>2, 'user_id'=> '1'],
            ['name'=> 1, 'blog_id'=>2, 'user_id'=> '1'],
            ['name'=> 2, 'blog_id'=>3, 'user_id'=> '1'],
            ['name'=> 4, 'blog_id'=>3, 'user_id'=> '1'],
            ['name'=> 4, 'blog_id'=>3, 'user_id'=> '1'],
            ['name'=> 3, 'blog_id'=>3, 'user_id'=> '1'],
            ['name'=> 5, 'blog_id'=>3, 'user_id'=> '1'],
            ['name'=> 3, 'blog_id'=>3, 'user_id'=> '1'],
            ['name'=> 4, 'blog_id'=>3, 'user_id'=> '1'],
            ['name'=> 2, 'blog_id'=>3, 'user_id'=> '1'],
            ['name'=> 1, 'blog_id'=>3, 'user_id'=> '1'],
        ]);
        
    }
}
