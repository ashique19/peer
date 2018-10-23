<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 30); //->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->tinyInteger('role');
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->string('name', 60);
            $table->string('contact', 50);
            $table->string('address', 50);
            $table->string('city', 30);
            $table->string('state', 30);
            $table->string('postcode', 10);
            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
            $table->string('parmanent_address');
            $table->tinyInteger('active')->default('1');    // 1=active; 2=inactive; 3=waiting for review;
            $table->integer('referrer_id')->unsigned()->nullable();
            $table->foreign('referrer_id')->references('id')->on('users')->onDelete('set null');
            $table->string('user_photo');
            $table->decimal('balance', 10, 2);
            $table->string('paypal_email');
            $table->string('paypal_currency');
            $table->string('payza_email');
            $table->string('payza_currency');
            $table->string('bank_name');
            $table->string('bank_branch');
            $table->string('bank_swift_code');
            $table->string('bank_account_number');
            $table->string('bank_account_name');
            $table->string('bank_currency');
            $table->string('stripe_id');
            $table->timestamp('expiry_date');
            $table->integer('social_id')->unsigned()->nullable()->default(1);
            $table->foreign('social_id')->references('id')->on('socials')->onDelete('set null');
            $table->longText('note');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
