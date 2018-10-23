
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
            ['name'=> 'Users', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-users', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all users', 'type'=>'1', 'parent'=>'1', 'active'=>'1', 'route'=>'admin/users', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new user', 'type'=>'1', 'parent'=>'1', 'active'=>'1', 'route'=>'admin/users/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Buyer-Travelers', 'type'=>'1', 'parent'=>'1', 'active'=>'1', 'route'=>'admin/users/buyers-travelers', 'icon'=>'fa fa-user', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Admins', 'type'=>'1', 'parent'=>'1', 'active'=>'1', 'route'=>'admin/users/admins', 'icon'=>'fa fa-user-secret', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Download', 'type'=>'1', 'parent'=>'1', 'active'=>'1', 'route'=>'admin/users/export', 'icon'=>'fa fa-user-secret', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Role', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-wheelchair', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all roles', 'type'=>'1', 'parent'=>'7', 'active'=>'1', 'route'=>'admin/roles', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new role', 'type'=>'1', 'parent'=>'7', 'active'=>'1', 'route'=>'admin/roles/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Navs', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all navs', 'type'=>'1', 'parent'=>'10', 'active'=>'1', 'route'=>'admin/navs', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new nav', 'type'=>'1', 'parent'=>'10', 'active'=>'1', 'route'=>'admin/navs/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Permissions', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all Permissions', 'type'=>'1', 'parent'=>'13', 'active'=>'1', 'route'=>'admin/permissions', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new Permission', 'type'=>'1', 'parent'=>'13', 'active'=>'1', 'route'=>'admin/permissions/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Currencies', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all Currencies', 'type'=>'1', 'parent'=>'16', 'active'=>'1', 'route'=>'admin/currencies', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new Currency', 'type'=>'1', 'parent'=>'16', 'active'=>'1', 'route'=>'admin/currencies/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Settings', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'App settings', 'type'=>'1', 'parent'=>'19', 'active'=>'1', 'route'=>'admin/settings/1', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Backup', 'type'=>'1', 'parent'=>'19', 'active'=>'1', 'route'=>'admin/backup/status', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Pages', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all pages', 'type'=>'1', 'parent'=>'22', 'active'=>'1', 'route'=>'admin/pages', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new page', 'type'=>'1', 'parent'=>'22', 'active'=>'1', 'route'=>'admin/pages/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Social', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all Socials', 'type'=>'1', 'parent'=>'25', 'active'=>'1', 'route'=>'admin/socials', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new Social', 'type'=>'1', 'parent'=>'25', 'active'=>'1', 'route'=>'admin/socials/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Gateways', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all gateways', 'type'=>'1', 'parent'=>'28', 'active'=>'1', 'route'=>'admin/gateways', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new gateway', 'type'=>'1', 'parent'=>'28', 'active'=>'1', 'route'=>'admin/gateways/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Travel Info', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-fighter-jet', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all Travels', 'type'=>'1', 'parent'=>'31', 'active'=>'1', 'route'=>'admin/travels', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new Travel', 'type'=>'1', 'parent'=>'31', 'active'=>'1', 'route'=>'admin/travels/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Messages', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all', 'type'=>'1', 'parent'=>'34', 'active'=>'1', 'route'=>'admin/messages', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Countries', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all', 'type'=>'1', 'parent'=>'36', 'active'=>'1', 'route'=>'admin/countries', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Airports', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all', 'type'=>'1', 'parent'=>'38', 'active'=>'1', 'route'=>'admin/airports', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Buys', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'All Posts', 'type'=>'1', 'parent'=>'40', 'active'=>'1', 'route'=>'admin/buyers', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Categories', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all', 'type'=>'1', 'parent'=>'42', 'active'=>'1', 'route'=>'admin/categories', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Brands', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all', 'type'=>'1', 'parent'=>'44', 'active'=>'1', 'route'=>'admin/brands', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Offers', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all Offers', 'type'=>'1', 'parent'=>'46', 'active'=>'1', 'route'=>'admin/offers', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new Offer', 'type'=>'1', 'parent'=>'46', 'active'=>'1', 'route'=>'admin/offers/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Payments', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all Payments', 'type'=>'1', 'parent'=>'49', 'active'=>'1', 'route'=>'admin/payments', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new Payment', 'type'=>'1', 'parent'=>'49', 'active'=>'1', 'route'=>'admin/payments/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Newsletters', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all Newsletters', 'type'=>'1', 'parent'=>'52', 'active'=>'1', 'route'=>'admin/newsletters', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new Newsletter', 'type'=>'1', 'parent'=>'52', 'active'=>'1', 'route'=>'admin/newsletters/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all Subscribers', 'type'=>'1', 'parent'=>'52', 'active'=>'1', 'route'=>'admin/subscribers', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new Subscriber', 'type'=>'1', 'parent'=>'52', 'active'=>'1', 'route'=>'admin/subscribers/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Slider', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-road', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View Sliders', 'type'=>'1', 'parent'=>'57', 'active'=>'1', 'route'=>'admin/sliders', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View Slides', 'type'=>'1', 'parent'=>'57', 'active'=>'1', 'route'=>'admin/slides', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Blogs', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-subway', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View Blogs', 'type'=>'1', 'parent'=>'60', 'active'=>'1', 'route'=>'admin/blogs', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create Blog', 'type'=>'1', 'parent'=>'60', 'active'=>'1', 'route'=>'admin/blogs/create', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View all Comments', 'type'=>'1', 'parent'=>'60', 'active'=>'1', 'route'=>'admin/comments', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create Comment', 'type'=>'1', 'parent'=>'60', 'active'=>'1', 'route'=>'admin/comments/create', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Blog Categories', 'type'=>'1', 'parent'=>'60', 'active'=>'1', 'route'=>'admin/blogcategories', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Blog Tags', 'type'=>'1', 'parent'=>'60', 'active'=>'1', 'route'=>'admin/blogtags', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            
            
            ['name'=> 'Cities', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-fighter-jet', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View cities', 'type'=>'1', 'parent'=>'67', 'active'=>'1', 'route'=>'admin/cities', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new city', 'type'=>'1', 'parent'=>'67', 'active'=>'1', 'route'=>'admin/cities/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            ['name'=> 'Chats', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-fighter-jet', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View chats', 'type'=>'1', 'parent'=>'70', 'active'=>'1', 'route'=>'admin/chats', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'Create new chat', 'type'=>'1', 'parent'=>'70', 'active'=>'1', 'route'=>'admin/chats/create', 'icon'=>'fa fa-bullseye', 'location'=> '1', 'is_public'=>'0'],
            
            
            ['name'=> 'Labels', 'type'=>'0', 'parent'=>'', 'active'=>'1', 'route'=>'', 'icon'=>'fa fa-fighter-jet', 'location'=> '1', 'is_public'=>'0'],
            ['name'=> 'View Labels', 'type'=>'1', 'parent'=>'73', 'active'=>'1', 'route'=>'admin/labels', 'icon'=>'fa fa-paw', 'location'=> '1', 'is_public'=>'0'],
            
            
        ]);
    }
}

        