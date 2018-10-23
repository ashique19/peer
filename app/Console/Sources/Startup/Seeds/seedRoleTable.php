<?php

use Illuminate\Database\Seeder;

class seedRoleTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            
            [
                ['name'=>'dev'],
                ['name'=>'admin'],
                ['name'=>'client'],
                ['name'=>'vendor'],
            ]
        
        );
        
        
    }
}
