<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ratings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rate_by')->unsigned()->default(2);
            $table->foreign('rate_by')->references('id')->on('users')->onDelete('cascade');
            $table->integer('traveller_id')->unsigned();
            $table->foreign('traveller_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('comment');
            $table->integer('rating');
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
        Schema::drop('reviews');
    }
}
