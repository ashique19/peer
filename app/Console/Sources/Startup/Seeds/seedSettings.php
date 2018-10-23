
<?php

use Illuminate\Database\Seeder;

class seedSettings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('settings')->insert([
            [
                'application_name'      =>'Hierarchy',
                'application_slogan'    =>'We glorify your day',
                'business_name'         =>'WebHawks IT', 
                'owners_name'           =>'WebHawks IT', 
                'address'               =>'Mirpur', 
                'city'                  =>'Dhaka', 
                'country'               =>'Bangladesh', 
                'postcode'              =>'1212', 
                'contact'               =>'01787-698232', 
                'helpline'              =>'01787-698232', 
                'helpmail'              =>'info@webhakwsit.com', 
                'email'                 =>'info@webhakwsit.com', 
                'logo_photo'            => '/public/img/settings/logo.png',
                'icon_photo'            => '/public/img/settings/favicon.png',
                'google_plus'           => 'http://plus.google.com',
                'facebook'              => 'http://facebook.com',
                'twitter'               => 'http://twitter.com',
                'is_controlled_access'  => '2',
            ],
        ]);
        
    }
}

        