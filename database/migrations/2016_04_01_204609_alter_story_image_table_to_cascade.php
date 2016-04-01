<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStoryImageTableToCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('story_images', function (Blueprint $table) {
            $table->dropColumn('is_featured');
            $table->integer('story_id')->unsigned()->change();
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
        Schema::table('story_images', function (Blueprint $table) {
            $table->boolean('is_featured');
            $table->dropForeign('story_id');
        });
    }
}
