<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(seedSettings::class);
        $this->call(seedSocials::class);
        $this->call(seedGatewayTable::class);
        $this->call(seedPages::class);
        $this->call(countrySeeder::class);
        $this->call(AirportSeeder::class);
        $this->call(citySeeder::class);
        $this->call(currencySeeder::class);
        $this->call(seedRoleTable::class);
        $this->call(seedNavsTable::class);
        $this->call(seedNavRoleTable::class);
        $this->call(seedPermissions::class);
        $this->call(seedPermissionRole::class);
        $this->call(seedUserTable::class);
        // $this->call(TravelSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BuyerSeeder::class);
        $this->call(sliderSeeder::class);
        $this->call(slideSeeder::class);
        $this->call(blogCategorySeeder::class);
        $this->call(blogSeeder::class);
        $this->call(blogAndCategorySeeder::class);
        $this->call(blogTagSeeder::class);
        $this->call(chatSeeder::class);

        Model::reguard();
    }
}

    