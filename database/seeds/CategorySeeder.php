<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('categories')->insert([
        ['name' => 'All Departments'                   , 'search_index'=> 'All'                 , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => ''           , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Amazon Instant Video'              , 'search_index'=> 'UnboxVideo'          , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '2858778011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Appliances'                        , 'search_index'=> 'Appliances'          , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '2619526011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Apps & Games'                      , 'search_index'=> 'MobileApps'          , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '2350150011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Arts, Crafts & Sewing'             , 'search_index'=> 'ArtsAndCrafts'       , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '2617942011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Automotive'                        , 'search_index'=> 'Automotive'          , 'is_active'=> 1, 'is_at_homepage'=> 1 , 'amazon_node' => '15690151'   , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Baby'                              , 'search_index'=> 'Baby'                , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '165797011'  , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Beauty & Health'                   , 'search_index'=> 'Beauty'              , 'is_active'=> 1, 'is_at_homepage'=> 1 , 'amazon_node' => '11055981'   , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Books'                             , 'search_index'=> 'Books'               , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '1000'       , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'CDs & Vinyl'                       , 'search_index'=> 'Music'               , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '301668'     , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Cell Phones & Accessories'         , 'search_index'=> 'Wireless'            , 'is_active'=> 1, 'is_at_homepage'=> 1 , 'amazon_node' => '2335753011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Shoes & Jewelry'                   , 'search_index'=> 'Fashion'             , 'is_active'=> 1, 'is_at_homepage'=> 1 , 'amazon_node' => '7141124011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Clothing, Shoes & Jewelry - Baby'  , 'search_index'=> 'FashionBaby'         , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '7147444011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Clothing, Shoes & Jewelry - Boys'  , 'search_index'=> 'FashionBoys'         , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '7147443011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Clothing, Shoes & Jewelry - Girls' , 'search_index'=> 'FashionGirls'        , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '7147442011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Clothing, Shoes & Jewelry - Men'   , 'search_index'=> 'FashionMen'          , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '7147441011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Clothing, Shoes & Jewelry - Women' , 'search_index'=> 'FashionWomen'        , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '7147440011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Collectibles & Fine Arts'          , 'search_index'=> 'Collectibles'        , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '4991426011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Computers'                         , 'search_index'=> 'PCHardware'          , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '541966'     , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Digital Music'                     , 'search_index'=> 'MP3Downloads'        , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '624868011'  , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Electronics'                       , 'search_index'=> 'Electronics'         , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '493964'     , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Gift Cards'                        , 'search_index'=> 'GiftCards'           , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '2864120011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Grocery & Gourmet Food'            , 'search_index'=> 'Grocery'             , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '16310211'   , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Health & Personal Care'            , 'search_index'=> 'HealthPersonalCare'  , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '3760931'    , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Home & Kitchen'                    , 'search_index'=> 'HomeGarden'          , 'is_active'=> 1, 'is_at_homepage'=> 1 , 'amazon_node' => '1063498'    , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Industrial & Scientific'           , 'search_index'=> 'Industrial'          , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '16310161'   , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Kindle Store'                      , 'search_index'=> 'KindleStore'         , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '133141011'  , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Luggage & Travel Gear'             , 'search_index'=> 'Luggage'             , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '9479199011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Magazine Subscriptions'            , 'search_index'=> 'Magazines'           , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '599872'     , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'TV & Video'                        , 'search_index'=> 'Movies'              , 'is_active'=> 1, 'is_at_homepage'=> 1 , 'amazon_node' => '2625374011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Musical Instruments'               , 'search_index'=> 'MusicalInstruments'  , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '11965861'   , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Office Products'                   , 'search_index'=> 'OfficeProducts'      , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '1084128'    , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Patio, Lawn & Garden'              , 'search_index'=> 'LawnAndGarden'       , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '3238155011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Pet Supplies'                      , 'search_index'=> 'PetSupplies'         , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '2619534011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Software'                          , 'search_index'=> 'Software'            , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '409488'     , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Sports & Outdoors'                 , 'search_index'=> 'SportingGoods'       , 'is_active'=> 1, 'is_at_homepage'=> 1 , 'amazon_node' => '3375301'    , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Home'                              , 'search_index'=> 'Tools'               , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '468240'     , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Toys, Kids & Baby'                 , 'search_index'=> 'Toys'                , 'is_active'=> 1, 'is_at_homepage'=> 1 , 'amazon_node' => '165795011'  , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Video Games'                       , 'search_index'=> 'VideoGames'          , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '11846801'   , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Wine'                              , 'search_index'=> 'Wine'                , 'is_active'=> 1, 'is_at_homepage'=> 0 , 'amazon_node' => '2983386011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Tablet & Computers'                , 'search_index'=> 'PCHardware'          , 'is_active'=> 1, 'is_at_homepage'=> 1 , 'amazon_node' => '13896617011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Camera, Photo & Video'             , 'search_index'=> 'Electronics'          , 'is_active'=> 1, 'is_at_homepage'=> 1 , 'amazon_node' => '502394' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Headphones'                        , 'search_index'=> 'Electronics'          , 'is_active'=> 1, 'is_at_homepage'=> 1 , 'amazon_node' => '172541' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
        ['name' => 'Home Audio & Theater'              , 'search_index'=> 'Electronics'          , 'is_active'=> 1, 'is_at_homepage'=> 1 , 'amazon_node' => '667846011' , 'category_photo'=> '/public/img/category/20160610101214_lg.jpg'],
    ]);
        
    }
}
