<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('product_id');
            $table->string('title', 200)->nullable();
    		$table->string('description', 550)->nullable();
    		$table->string('category', 50)->nullable();
    		$table->string('price', 30);
    		$table->string('currency', 30);
    		$table->integer('quantity');
    		$table->string('url', 255);
    		$table->string('image', 255);
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
        Schema::drop('carts');
    }
}
