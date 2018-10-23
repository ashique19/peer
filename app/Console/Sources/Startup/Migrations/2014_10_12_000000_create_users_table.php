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
            $table->string('contact', 20);
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
            $table->integer('referral_balance')->unsigned()->default(0);
            $table->timestamp('referral_benefit_expiry_date');
            $table->string('user_photo');
            $table->decimal('balance', 10, 2);
            $table->timestamp('expiry_date');
            $table->integer('social_id')->unsigned()->nullable()->default(1);
            $table->foreign('social_id')->references('id')->on('socials')->onDelete('set null');
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
