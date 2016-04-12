<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotTablePageStory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_story', function (Blueprint $table) {
            $table->integer('page_id')->unsigned()->index();
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');

            $table->integer('story_id')->unsigned()->index();
            $table->foreign('story_id')->references('id')->on('storys')->onDelete('cascade');

            $table->integer('page_position');
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
        Schema::drop('page_story');
    }
}
