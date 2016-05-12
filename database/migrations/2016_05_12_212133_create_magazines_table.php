<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMagazinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magazines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year')->unsigned();
            $table->string('season');
            $table->string('title');
            $table->string('subtitle');
            $table->string('teaser');
            $table->date('start_date');
            $table->boolean('is_published');
            $table->boolean('is_archived');
            $table->string('cover_art');
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
        Schema::drop('magazines');
    }
}
