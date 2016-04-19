<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RedoDateColumnsInStorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('storys', function (Blueprint $table) {
            $table->dropColumn('publish_start');
            $table->dropColumn('publish_end');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
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
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dateTime('publish_start');
            $table->dateTime('publish_end')->nullable();
        });
    }
}
