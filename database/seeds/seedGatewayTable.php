<?php

use Illuminate\Database\Seeder;

class seedGatewayTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('gateways')->insert([
            ['name'=>'Paypal', 'charge'=>'0', 'is_active'=> 1 ],
            ['name'=>'Payza', 'charge'=>'0', 'is_active'=> 1 ],
            ['name'=>'Debit/Credit Card', 'charge'=>'0', 'is_active'=> 1 ],
        ]);
        
    }
}
