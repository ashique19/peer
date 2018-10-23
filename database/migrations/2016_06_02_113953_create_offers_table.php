<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('offer_type')->default(1);  // 1 = old offer type, 2 = Courier label, 3 = Send through Airposted
            $table->string('name');                     // product's name
            $table->string('link');                     // product's link
            $table->string('image_url');                // product's image
            $table->decimal('product_price', 10,2);     // product's price
            $table->decimal('offer_price', 10, 2)->unsigned();
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('transaction_charge', 10, 2)->unsigned();
            $table->decimal('airposted_commission', 10, 2)->unsigned();
            $table->decimal('total_price', 10, 2)->unsigned();
            $table->tinyInteger('is_reply')->default(0);    // 0 = no; 1 = yes;
            $table->tinyInteger('is_deleted')->default(0);  // 0 = no; 1 = yes;
            $table->integer('reply_of')->unsigned()->nullable();
            $table->foreign('reply_of')->references('id')->on('offers')->onDelete('set null');
            $table->tinyInteger('is_agreed')->default(0);   // 0 = no; 1 = yes;
            $table->tinyInteger('is_offer_from_buyer');
            $table->tinyInteger('is_offer_from_traveller');
            $table->integer('traveller_id')->unsigned()->nullable();
            $table->foreign('traveller_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('buyer_id')->unsigned()->nullable();
            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('set null');
            $table->string('note');
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
        Schema::drop('offers');
    }
}
