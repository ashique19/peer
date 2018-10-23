<?php

use Illuminate\Database\Seeder;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('buyers')->insert([
            ['name'=> 'Product X', 'amazon_url'=> 'http://www.amazon.com/gp/product/B00I15SB16', 'other_url'=> 'http://www.ebay.com/itm/Citizen-Eco-Drive-Brown-Leather-Mens-Watch-BM8475-26E-/161605353249', 'image_url'=> '//www.att.com/catalog/en/skus/images/apple-iphone%20se%2016gb-silver-450x350.png', 'price'=> 100, 'country_id'=> 1, 'user_id'=> 3],
            ['name'=> 'Product Y', 'amazon_url'=> 'http://www.amazon.com/gp/product/B00I15SB16', 'other_url'=> 'http://www.ebay.com/itm/Citizen-Eco-Drive-Brown-Leather-Mens-Watch-BM8475-26E-/161605353249', 'image_url'=> '//www.att.com/catalog/en/skus/images/apple-iphone%20se%2016gb-silver-450x350.png', 'price'=> 100, 'country_id'=> 1, 'user_id'=> 3],
            ['name'=> 'Product Z', 'amazon_url'=> 'http://www.amazon.com/gp/product/B00I15SB16', 'other_url'=> 'http://www.ebay.com/itm/Citizen-Eco-Drive-Brown-Leather-Mens-Watch-BM8475-26E-/161605353249', 'image_url'=> '//www.att.com/catalog/en/skus/images/apple-iphone%20se%2016gb-silver-450x350.png', 'price'=> 100, 'country_id'=> 1, 'user_id'=> 3],
            ['name'=> 'Product A', 'amazon_url'=> 'http://www.amazon.com/gp/product/B00I15SB16', 'other_url'=> 'http://www.ebay.com/itm/Citizen-Eco-Drive-Brown-Leather-Mens-Watch-BM8475-26E-/161605353249', 'image_url'=> '//www.att.com/catalog/en/skus/images/apple-iphone%20se%2016gb-silver-450x350.png', 'price'=> 100, 'country_id'=> 1, 'user_id'=> 3],
            ['name'=> 'Product B', 'amazon_url'=> 'http://www.amazon.com/gp/product/B00I15SB16', 'other_url'=> 'http://www.ebay.com/itm/Citizen-Eco-Drive-Brown-Leather-Mens-Watch-BM8475-26E-/161605353249', 'image_url'=> '//www.att.com/catalog/en/skus/images/apple-iphone%20se%2016gb-silver-450x350.png', 'price'=> 100, 'country_id'=> 1, 'user_id'=> 3],
            ['name'=> 'Product C', 'amazon_url'=> 'http://www.amazon.com/gp/product/B00I15SB16', 'other_url'=> 'http://www.ebay.com/itm/Citizen-Eco-Drive-Brown-Leather-Mens-Watch-BM8475-26E-/161605353249', 'image_url'=> '//www.att.com/catalog/en/skus/images/apple-iphone%20se%2016gb-silver-450x350.png', 'price'=> 100, 'country_id'=> 1, 'user_id'=> 7],
            ['name'=> 'Product D', 'amazon_url'=> 'http://www.amazon.com/gp/product/B00I15SB16', 'other_url'=> 'http://www.ebay.com/itm/Citizen-Eco-Drive-Brown-Leather-Mens-Watch-BM8475-26E-/161605353249', 'image_url'=> '//www.att.com/catalog/en/skus/images/apple-iphone%20se%2016gb-silver-450x350.png', 'price'=> 100, 'country_id'=> 1, 'user_id'=> 7],
            ['name'=> 'Product E', 'amazon_url'=> 'http://www.amazon.com/gp/product/B00I15SB16', 'other_url'=> 'http://www.ebay.com/itm/Citizen-Eco-Drive-Brown-Leather-Mens-Watch-BM8475-26E-/161605353249', 'image_url'=> '//www.att.com/catalog/en/skus/images/apple-iphone%20se%2016gb-silver-450x350.png', 'price'=> 100, 'country_id'=> 1, 'user_id'=> 8],
            ['name'=> 'Product F', 'amazon_url'=> 'http://www.amazon.com/gp/product/B00I15SB16', 'other_url'=> 'http://www.ebay.com/itm/Citizen-Eco-Drive-Brown-Leather-Mens-Watch-BM8475-26E-/161605353249', 'image_url'=> '//www.att.com/catalog/en/skus/images/apple-iphone%20se%2016gb-silver-450x350.png', 'price'=> 100, 'country_id'=> 1, 'user_id'=> 8],
            ['name'=> 'Product G', 'amazon_url'=> 'http://www.amazon.com/gp/product/B00I15SB16', 'other_url'=> 'http://www.ebay.com/itm/Citizen-Eco-Drive-Brown-Leather-Mens-Watch-BM8475-26E-/161605353249', 'image_url'=> '//www.att.com/catalog/en/skus/images/apple-iphone%20se%2016gb-silver-450x350.png', 'price'=> 100, 'country_id'=> 1, 'user_id'=> 3],
        ]);
        
    }
}
