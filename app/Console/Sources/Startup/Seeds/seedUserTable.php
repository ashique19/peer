<?php

use Illuminate\Database\Seeder;

class seedUserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username'          => 'ashique',
                'email'             => 'ashique19@gmail.com',
                'password'          => bcrypt('1234'),
                'role'              => '1',
                'firstname'         => 'md ashiqul',
                'lastname'          => 'islam',
                'name'              => 'Md Ashiqul Islam',
                'contact'           => '01710123456',
                'address'           => 'Banasree',
                'city'              => 'Dhaka',
                'state'             => 'Dhaka',
                'postcode'          => '1219',
                'country_id'        => 10,
                'parmanent_address' => 'Brahmanbaria',
                'active'            => '1',
                'expiry_date'       => \Carbon::now()->addYear(1),
                'user_photo'        => '\public\img\users\1.png',
                'balance'           => '100.52',
            ],
            [
                'username'          => 'admin',
                'email'             => 'admin@flowerifybd.com',
                'password'          => bcrypt('1234'),
                'role'              => '2',
                'firstname'         => 'the admin',
                'lastname'          => 'of flowerifybd',
                'name'              => 'The admin of FlowerifyBD',
                'contact'           => '01710123457',
                'address'           => 'Mirpur 10',
                'city'              => 'Dhaka',
                'state'             => 'Dhaka',
                'postcode'          => '1219',
                'country_id'        =>  11,
                'parmanent_address' => 'Bangladesh',
                'active'            => '1',
                'expiry_date'       => null,
                'user_photo'        => '\public\img\users\1.png',
                'balance'           => '0',
            ],
            
        ]);
    }
}
