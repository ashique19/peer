
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
                'application_name'      =>'AirPosted',
                'application_slogan'    =>'Shipping Simplicity',
                'business_name'         =>'AirPosted', 
                'owners_name'           =>'AirPosted', 
                'address'               =>'4445 Corporation Lane, STE 264', 
                'city'                  =>'Virginia Beach, Virginia', 
                'country'               =>'USA', 
                'postcode'              =>'23462', 
                'contact'               =>'909 272 5244', 
                'helpline'              =>'909 272 5244', 
                'helpmail'              =>'support@airposted.com', 
                'email'                 =>'support@airposted.com', 
                'logo_photo'            => '/public/img/settings/logo.png',
                'icon_photo'            => '/public/img/settings/favicon.png',
                'google_plus'           => 'http://plus.google.com',
                'facebook'              => 'http://facebook.com',
                'twitter'               => 'http://twitter.com',
                'google_map_api'        => 'AIzaSyCWrA6h5fZHdQHCOD-mDacVDbsSDcK7BRc',
                'google_map_location'   => 'Mirpur, dhaka, Bangladesh',
                'commission'            => 5,
                'transaction_charge'    => 3,
                'is_controlled_access'  => '2',
            ],
        ]);
        
    }
}

        