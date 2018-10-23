<?php

use Illuminate\Database\Seeder;

class blogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('blogcategories')->insert([
            ['name'=> 'Programming'                 , 'link'=> 'news',                  'banner_photo'=> '/public/img/blog-banners/20160510102510_lg.jpg'],
            ['name'=> 'IT'                          , 'link'=> 'latest-fashion',        'banner_photo'=> '/public/img/blog-banners/20160510102510_lg.jpg'],
            ['name'=> 'Data Security'               , 'link'=> 'clothing-these-days',   'banner_photo'=> '/public/img/blog-banners/20160510102510_lg.jpg'],
            ['name'=> 'Music'                       , 'link'=> 'sunglass-is-hot',       'banner_photo'=> '/public/img/blog-banners/20160510102510_lg.jpg'],
            ['name'=> 'New Trends'                  , 'link'=> 'summer-is-cool',        'banner_photo'=> '/public/img/blog-banners/20160510102510_lg.jpg'],
            ['name'=> 'Others'                      , 'link'=> 'news-2',                'banner_photo'=> '/public/img/blog-banners/20160510102510_lg.jpg'],
        ]);
        
    }
}
