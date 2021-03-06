<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveImageTypeColCloserToImagetypeID extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('story_images', function (Blueprint $table) {

            $table->string('group')->before('image_name');
						$table->string('image_type')->after('imagetype_id')->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('story_images', function (Blueprint $table) {
            $table->removeColumn('group');
        });
    }
}
