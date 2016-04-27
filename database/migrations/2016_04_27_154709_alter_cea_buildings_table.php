<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCeaBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cea_buildings', function (Blueprint $table) {
          $table->float('longitude', 10, 6)->change();
          $table->float('latitude', 10, 6)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cea_buildings', function (Blueprint $table) {
          $table->decimal('longitude', 12, 9)->change();
          $table->decimal('latitude', 12, 9)->change();
        });
    }
}
