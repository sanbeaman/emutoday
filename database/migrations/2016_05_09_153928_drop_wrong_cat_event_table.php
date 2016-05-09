<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropWrongCatEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('category_event');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      //

    }
}
