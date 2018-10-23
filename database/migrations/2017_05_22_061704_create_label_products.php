<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('label_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('label_id')->unsigned();
            $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
            $table->string('name');
            $table->integer('quantity');
            $table->double('weight');
            $table->double('value');
            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
            $table->string('hs_tarrif');
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
        Schema::drop('label_products');
    }
}
