<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStorysTable0401 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('storys', function (Blueprint $table) {
              $table->dropColumn('published_at');
              $table->dateTime('publish_start');
              $table->dateTime('publish_end');
              $table->boolean('is_featured');
              $table->boolean('is_live');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('storys', function (Blueprint $table) {
             $table->dateTime('published_at');
            $table->dropColumn('publish_start');
            $table->dropColumn('publish_end');
            $table->dropColumn('is_featured');
            $table->dropColumn('is_live');
        });
    }
}
