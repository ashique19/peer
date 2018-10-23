<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->default(1);  // 1=> new order, 2=> order processing (unpaid), 3=> order processing (paid), 4=> delivery in progress 5=> delivered 6=> cancel and return
            $table->tinyInteger('no_of_products')->default(0);
            $table->double('product_cost')->default(0);
            $table->double('shipping_cost')->default(0);
            $table->double('airposted_margin')->default(0);
            $table->double('order_total')->default(0);
            $table->double('paid_amount')->default(0);
            $table->double('paid_for_poduct')->default(0);
            $table->double('paid_for_shipping')->default(0);
            $table->integer('label_id')->unsigned()->nullable();
            $table->foreign('label_id')->references('id')->on('labels')->onDelete('set null');
            $table->integer('payment_id')->unsigned()->nullable();
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('set null');
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
        Schema::drop('orders');
    }
}


