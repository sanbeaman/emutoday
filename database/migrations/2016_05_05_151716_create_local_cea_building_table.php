<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalCeaBuildingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cea_buildings', function (Blueprint $table) {
          $table->increments('id')->unsigned();
          $table->string('name');
          $table->string('alias')->nullable();
          $table->float('longitude', 10, 6);
          $table->float('latitude', 10, 6);
          $table->string('map');
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
        Schema::drop('cea_buildings');
    }
}
