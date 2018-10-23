<?php

use Illuminate\Database\Seeder;

class blogTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('blogtags')->insert([
            ['id'=> '1', 'name'=> 'News'                , 'link'=> 'news',               'banner_photo'=> '/public/img/blog-banners/20160510102510_lg.jpg'],
            ['id'=> '2', 'name'=> 'Latest Fashion'      , 'link'=> 'latest-fashion',     'banner_photo'=> '/public/img/blog-banners/20160510102510_lg.jpg'],
            ['id'=> '3', 'name'=> 'Clothing these days' , 'link'=> 'clothing-these-days','banner_photo'=> '/public/img/blog-banners/20160510102510_lg.jpg'],
            ['id'=> '4', 'name'=> 'Sunglass is hot'     , 'link'=> 'sunglass-is-hot',    'banner_photo'=> '/public/img/blog-banners/20160510102510_lg.jpg'],
            ['id'=> '5', 'name'=> 'Summer is cool'      , 'link'=> 'summer-is-cool',     'banner_photo'=> '/public/img/blog-banners/20160510102510_lg.jpg'],
        ]);
        
    }
}
