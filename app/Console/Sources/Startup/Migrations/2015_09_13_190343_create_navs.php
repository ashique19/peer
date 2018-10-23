<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->tinyInteger('type');
            $table->tinyInteger('parent');
            $table->tinyInteger('active');
            $table->string('route', 50);
            $table->string('icon', 50);
            $table->tinyInteger('location');
            $table->tinyInteger('is_public');
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
        Schema::drop('navs');
    }
}
