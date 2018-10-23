<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('message_from')->unsigned();
            $table->foreign('message_from')->references('id')->on('users')->onDelete('cascade');
            $table->integer('message_to')->unsigned();
            $table->foreign('message_to')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('is_reply')->default(0);    // 0 = no, 1 = yes
            $table->tinyInteger('is_read')->default(0);    // 0 = no, 1 = yes
            $table->integer('message_id')->unsigned()->nullable();
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('set null');
            $table->longText('details');
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
        Schema::drop('messages');
    }
}
