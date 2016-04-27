<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCeaBuildings extends Migration
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
            $table->string('alias')->nullable();
            $table->string('name');
            $table->decimal('longitude', 9, 6);
            $table->decimal('latitude', 9, 9);
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
