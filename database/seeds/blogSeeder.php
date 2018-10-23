<?php

use Illuminate\Database\Seeder;

class blogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('blogs')->insert([
            ['name'=> 'First Blog',     'link'=> 'first-blog', 'banner_photo'=> '/public/img/blogs/20160510212321_lg.jpg', 'short_description'=> 'The short description should be really short and brief. It should speak the gist of the subject', 'details'=> 'This is a details area', 'status'=> 2, 'is_popular'=> 1, 'created_by'=> 3, 'created_at'=> \Carbon::now()->addDay(-10), 'updated_at'=> \Carbon::now()->addDay(-1)],
            ['name'=> 'Second Blog',    'link'=> 'second-blog', 'banner_photo'=> '/public/img/blogs/20160510212321_lg.jpg', 'short_description'=> 'The short description should be really short and brief. It should speak the gist of the subject', 'details'=> 'This is a details area', 'status'=> 2, 'is_popular'=> 1, 'created_by'=> 3, 'created_at'=> \Carbon::now()->addDay(-10), 'updated_at'=> \Carbon::now()->addDay(-1)],
            ['name'=> 'Third Blog',     'link'=> 'third-blog', 'banner_photo'=> '/public/img/blogs/20160510212321_lg.jpg', 'short_description'=> 'The short description should be really short and brief. It should speak the gist of the subject', 'details'=> 'This is a details area', 'status'=> 0, 'is_popular'=> 0, 'created_by'=> 3, 'created_at'=> \Carbon::now()->addDay(-10), 'updated_at'=> \Carbon::now()->addDay(-1)],
            ['name'=> 'Forth Blog',     'link'=> 'first-blog-2', 'banner_photo'=> '/public/img/blogs/20160510212321_lg.jpg', 'short_description'=> 'The short description should be really short and brief. It should speak the gist of the subject', 'details'=> 'This is a details area', 'status'=> 2, 'is_popular'=> 1, 'created_by'=> 3, 'created_at'=> \Carbon::now()->addDay(-10), 'updated_at'=> \Carbon::now()->addDay(-1)],
            ['name'=> 'Fifth Blog',     'link'=> 'second-blog-2', 'banner_photo'=> '/public/img/blogs/20160510212321_lg.jpg', 'short_description'=> 'The short description should be really short and brief. It should speak the gist of the subject', 'details'=> 'This is a details area', 'status'=> 1, 'is_popular'=> 1, 'created_by'=> 3, 'created_at'=> \Carbon::now()->addDay(-10), 'updated_at'=> \Carbon::now()->addDay(-1)],
            ['name'=> 'Sixth Blog',     'link'=> 'third-blog-2', 'banner_photo'=> '/public/img/blogs/20160510212321_lg.jpg', 'short_description'=> 'The short description should be really short and brief. It should speak the gist of the subject', 'details'=> 'This is a details area', 'status'=> 0, 'is_popular'=> 0, 'created_by'=> 3, 'created_at'=> \Carbon::now()->addDay(-10), 'updated_at'=> \Carbon::now()->addDay(-1)],
            ['name'=> 'Seventh Blog',   'link'=> 'first-blog-3', 'banner_photo'=> '/public/img/blogs/20160510212321_lg.jpg', 'short_description'=> 'The short description should be really short and brief. It should speak the gist of the subject', 'details'=> 'This is a details area', 'status'=> 2, 'is_popular'=> 1, 'created_by'=> 3, 'created_at'=> \Carbon::now()->addDay(-10), 'updated_at'=> \Carbon::now()->addDay(-1)],
            ['name'=> 'Eighth Blog',    'link'=> 'second-blog-3', 'banner_photo'=> '/public/img/blogs/20160510212321_lg.jpg', 'short_description'=> 'The short description should be really short and brief. It should speak the gist of the subject', 'details'=> 'This is a details area', 'status'=> 1, 'is_popular'=> 1, 'created_by'=> 3, 'created_at'=> \Carbon::now()->addDay(-10), 'updated_at'=> \Carbon::now()->addDay(-1)],
            ['name'=> 'Ningth Blog',    'link'=> 'third-blog-3', 'banner_photo'=> '/public/img/blogs/20160510212321_lg.jpg', 'short_description'=> 'The short description should be really short and brief. It should speak the gist of the subject', 'details'=> 'This is a details area', 'status'=> 0, 'is_popular'=> 0, 'created_by'=> 3, 'created_at'=> \Carbon::now()->addDay(-10), 'updated_at'=> \Carbon::now()->addDay(-1)],
            ['name'=> 'Tenth Blog',     'link'=> 'first-blog-4', 'banner_photo'=> '/public/img/blogs/20160510212321_lg.jpg', 'short_description'=> 'The short description should be really short and brief. It should speak the gist of the subject', 'details'=> 'This is a details area', 'status'=> 2, 'is_popular'=> 1, 'created_by'=> 3, 'created_at'=> \Carbon::now()->addDay(-10), 'updated_at'=> \Carbon::now()->addDay(-1)],
            ['name'=> 'Eleventh Blog',  'link'=> 'second-blog-4', 'banner_photo'=> '/public/img/blogs/20160510212321_lg.jpg', 'short_description'=> 'The short description should be really short and brief. It should speak the gist of the subject', 'details'=> 'This is a details area', 'status'=> 1, 'is_popular'=> 1, 'created_by'=> 3, 'created_at'=> \Carbon::now()->addDay(-10), 'updated_at'=> \Carbon::now()->addDay(-1)],
            ['name'=> 'Twelveth Blog',  'link'=> 'third-blog-4', 'banner_photo'=> '/public/img/blogs/20160510212321_lg.jpg', 'short_description'=> 'The short description should be really short and brief. It should speak the gist of the subject', 'details'=> 'This is a details area', 'status'=> 0, 'is_popular'=> 0, 'created_by'=> 3, 'created_at'=> \Carbon::now()->addDay(-10), 'updated_at'=> \Carbon::now()->addDay(-1)],
        ]);
        
    }
}
