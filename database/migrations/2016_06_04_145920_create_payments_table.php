<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('payment_type')->default(1);
            $table->integer('offer_id')->unsigned()->nullable();
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('set null');
            $table->integer('buyer_id')->unsigned()->nullable();
            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('traveller_id')->unsigned()->nullable();
            $table->foreign('traveller_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('from_country_id')->unsigned()->nullable();
            $table->foreign('from_country_id')->references('id')->on('countries')->onDelete('set null');
            $table->integer('to_country_id')->unsigned()->nullable();
            $table->foreign('to_country_id')->references('id')->on('countries')->onDelete('set null');
            $table->string('product_price');
            $table->string('traveller_commission');
            $table->string('airposted_commission');
            $table->string('transaction_charge');
            $table->string('payment');
            $table->integer('gateway_id')->unsigned()->nullable();
            $table->foreign('gateway_id')->references('id')->on('gateways')->onDelete('set null');
            $table->tinyInteger('status')->default(1);  // 1 = unpaid; 2 = paid but not verified; 3 = payment verified; 4 = money given to traveller; 
            $table->tinyInteger('is_delivered')->default(0);    // 0 = no; 1 = traveller delivered to buyer; 2 = Buyer confirmed delivery;
            $table->string('gateway_payment_id');
            $table->string('gateway_payer_id');
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
        Schema::drop('payments');
    }
}
