<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('Airposted Travel');
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->date('travel_date');
            $table->integer('country_from')->unsigned()->nullable();
            $table->foreign('country_from')->references('id')->on('countries')->onDelete('set null');
            $table->integer('country_to')->unsigned()->nullable();
            $table->foreign('country_to')->references('id')->on('countries')->onDelete('set null');
            $table->integer('airport_from')->unsigned()->nullable();
            $table->foreign('airport_from')->references('id')->on('airports')->onDelete('set null');
            $table->integer('airport_to')->unsigned()->nullable();
            $table->foreign('airport_to')->references('id')->on('airports')->onDelete('set null');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('is_active')->default(1);
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
        Schema::drop('travels');
    }
}
