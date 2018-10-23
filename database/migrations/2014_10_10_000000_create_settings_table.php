<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('application_name');
            $table->string('application_slogan');
            $table->string('business_name');
            $table->string('owners_name');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->string('postcode');
            $table->string('contact');
            $table->string('helpline');
            $table->string('helpmail');
            $table->string('email');
            $table->string('logo_photo');
            $table->string('icon_photo');
            $table->string('google_plus');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('google_map_api');
            $table->string('google_map_location');
            $table->tinyInteger('is_controlled_access')->default('2');    // 1=yes; 2=no;
            $table->decimal('commission', 4, 2)->unsigned()->default(0);
            $table->decimal('transaction_charge', 4, 2)->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}
