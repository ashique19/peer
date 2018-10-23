<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyersNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyers_new', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description', 255);
            $table->string('url');
            $table->string('image');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->integer('from_country_id')->unsigned()->nullable();
            $table->foreign('from_country_id')->references('id')->on('countries')->onDelete('set null');
            $table->integer('to_country_id')->unsigned()->nullable();
            $table->foreign('to_country_id')->references('id')->on('countries')->onDelete('set null');
            $table->string('from_address', 200);
            $table->string('to_address', 200);
            $table->string('from_state', 50);
            $table->string('to_state', 50);
            $table->string('from_zip', 50);
            $table->string('to_zip', 50);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('buyers_new');
    }
}
