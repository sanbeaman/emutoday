<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotTableMagazineStory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magazine_story', function (Blueprint $table) {
          $table->integer('magazine_id')->unsigned();
          $table->integer('story_id')->unsigned();
          $table->integer('story_position')->unsigned();
          $table->foreign('magazine_id')->references('id')->on('magazines')->onDelete('cascade');
          $table->foreign('story_id')->references('id')->on('storys')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('magazine_story');
    }
}
