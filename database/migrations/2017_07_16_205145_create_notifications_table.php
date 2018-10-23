<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notification_from')->unsigned()->default(2);
            $table->foreign('notification_from')->references('id')->on('users')->onDelete('cascade');
            $table->integer('notification_to')->unsigned();
            $table->foreign('notification_to')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->string('link');
            $table->string('is_delivered')->default(0); // 0=no, 1=yes
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
        Schema::drop('notifications');
    }
}
