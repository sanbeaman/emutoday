<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExternalLinkToMagazinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('magazines', function (Blueprint $table) {
            $table->string('ext_url')->after('teaser');
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
            $table->dropColumn('ext_url');
        });
    }
}
