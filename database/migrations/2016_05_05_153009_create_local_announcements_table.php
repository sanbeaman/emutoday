<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('author_id');
          $table->string('title');
          $table->string('announcement');
          $table->dateTime('start_date');
          $table->time('start_time');
          $table->dateTime('end_date')->nullable();
          $table->time('end_time')->nullable();
          $table->boolean('is_approved');
          $table->boolean('is_promoted');
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
        Schema::drop('announcements');
    }
}
