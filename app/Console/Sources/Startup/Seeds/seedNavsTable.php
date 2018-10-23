
<?php

use Illuminate\Database\Seeder;

class seedNavsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('navs')->insert([
            
            /**
            *
            * Auth navs
            * 
            */
            ['name'=> 'Users', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-tachometer', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all users', 'type'=>'1', 'parent'=>'1', 'active'=>'1', 'route'=>'admin/users', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new user', 'type'=>'1', 'parent'=>'1', 'active'=>'1', 'route'=>'admin/users/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Role', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-wheelchair', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all roles', 'type'=>'1', 'parent'=>'4', 'active'=>'1', 'route'=>'admin/roles', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new role', 'type'=>'1', 'parent'=>'4', 'active'=>'1', 'route'=>'admin/roles/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Navs', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all navs', 'type'=>'1', 'parent'=>'7', 'active'=>'1', 'route'=>'admin/navs', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new nav', 'type'=>'1', 'parent'=>'7', 'active'=>'1', 'route'=>'admin/navs/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Permissions', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all Permissions', 'type'=>'1', 'parent'=>'10', 'active'=>'1', 'route'=>'admin/permissions', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new Permission', 'type'=>'1', 'parent'=>'10', 'active'=>'1', 'route'=>'admin/permissions/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Currencies', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all Currencies', 'type'=>'1', 'parent'=>'13', 'active'=>'1', 'route'=>'admin/currencies', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new Currency', 'type'=>'1', 'parent'=>'13', 'active'=>'1', 'route'=>'admin/currencies/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Settings', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'App settings', 'type'=>'1', 'parent'=>'16', 'active'=>'1', 'route'=>'admin/settings/1', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Pages', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all pages', 'type'=>'1', 'parent'=>'18', 'active'=>'1', 'route'=>'admin/pages', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new page', 'type'=>'1', 'parent'=>'18', 'active'=>'1', 'route'=>'admin/pages/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Social', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all Socials', 'type'=>'1', 'parent'=>'21', 'active'=>'1', 'route'=>'admin/socials', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new Social', 'type'=>'1', 'parent'=>'21', 'active'=>'1', 'route'=>'admin/socials/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Gateways', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all gateways', 'type'=>'1', 'parent'=>'24', 'active'=>'1', 'route'=>'admin/gateways', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new gateway', 'type'=>'1', 'parent'=>'24', 'active'=>'1', 'route'=>'admin/gateways/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            
            
            /**
            *
            * Public navs
            * 
            */
            ['name'=> 'Contact us', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'contact-us', 'icon'=>'fa fa-globe', 'location'=> '2', 'is_public'=>'1'],
            ['name'=> 'Privacy', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'privacy-policy', 'icon'=>'fa fa-pencil', 'location'=> '2', 'is_public'=>'1'],
            ['name'=> 'About', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'about-us', 'icon'=>'fa fa-smile-o', 'location'=> '2', 'is_public'=>'1'],
            
            
        ]);
    }
}

        