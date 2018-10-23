
<?php

use Illuminate\Database\Seeder;

class seedNavRoleTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nav_role')->insert([
            ['nav_id'=>1, 'role_id'=>1],
            ['nav_id'=>2, 'role_id'=>1],
            ['nav_id'=>3, 'role_id'=>1],
            ['nav_id'=>4, 'role_id'=>1],
            ['nav_id'=>5, 'role_id'=>1],
            ['nav_id'=>6, 'role_id'=>1],
            ['nav_id'=>7, 'role_id'=>1],
            ['nav_id'=>8, 'role_id'=>1],
            ['nav_id'=>9, 'role_id'=>1],
            ['nav_id'=>10, 'role_id'=>1],
            ['nav_id'=>11, 'role_id'=>1],
            ['nav_id'=>12, 'role_id'=>1],
            ['nav_id'=>13, 'role_id'=>1],
            ['nav_id'=>14, 'role_id'=>1],
            ['nav_id'=>15, 'role_id'=>1],
            ['nav_id'=>16, 'role_id'=>1],
            ['nav_id'=>17, 'role_id'=>1],
            ['nav_id'=>18, 'role_id'=>1],
            ['nav_id'=>19, 'role_id'=>1],
            ['nav_id'=>20, 'role_id'=>1],
            ['nav_id'=>21, 'role_id'=>1],
            ['nav_id'=>22, 'role_id'=>1],
            ['nav_id'=>23, 'role_id'=>1],
            ['nav_id'=>24, 'role_id'=>1],
            ['nav_id'=>25, 'role_id'=>1],
            ['nav_id'=>26, 'role_id'=>1],
            
            ['nav_id'=>11, 'role_id'=>2],
            ['nav_id'=>12, 'role_id'=>2],
            ['nav_id'=>13, 'role_id'=>2],
            ['nav_id'=>14, 'role_id'=>2],
            ['nav_id'=>15, 'role_id'=>2],
            ['nav_id'=>16, 'role_id'=>2],
            ['nav_id'=>17, 'role_id'=>2],
            
        ]);
    }
}

        