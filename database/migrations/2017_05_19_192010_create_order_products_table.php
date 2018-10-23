<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->string('source');
            $table->string('product_url');
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->double('price');
            $table->double('height');
            $table->double('width');
            $table->double('length');
            $table->double('weight');
            $table->string('dimension_unit');
            $table->string('weight_unit');
            $table->string('product_image');
            $table->tinyInteger('quantity');
            $table->mediumText('note');
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
        Schema::drop('order_products');
    }
}


