<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('chat_image');
            $table->integer('message_from')->unsigned();
            $table->foreign('message_from')->references('id')->on('users')->onDelete('cascade');
            $table->integer('message_to')->unsigned();
            $table->foreign('message_to')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('is_read_by_from')->default(1);    // 0 = no, 1 = yes
            $table->tinyInteger('is_read_by_to')->default(0);    // 0 = no, 1 = yes
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
        Schema::drop('chats');
    }
}
