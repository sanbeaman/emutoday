<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMagazineTableToAddDefaultsAndNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('magazines', function (Blueprint $table) {
          $table->string('title')->nullable()->change();
          $table->string('subtitle')->nullable()->change();
          $table->string('teaser')->nullable()->change();
          $table->date('start_date')->nullable()->change();
          $table->boolean('is_published')->default(0)->change();
          $table->boolean('is_archived')->default(0)->change();
          $table->string('cover_art')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('magazines', function (Blueprint $table) {
            //
        });
    }
}
