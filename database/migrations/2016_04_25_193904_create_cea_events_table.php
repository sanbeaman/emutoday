<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeaEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cea_events', function (Blueprint $table) {
          $table->increments('id')->unsigned();
          $table->string('title', 255)->nullable();
          $table->string('short_title', 255)->nullable();
          $table->string('location', 255)->nullable();
          $table->dateTime('start_date')->nullable();
          $table->dateTime('end_date')->nullable();
          $table->boolean('all_day')->unsigned()->nullable();
          $table->boolean('no_end_time')->unsigned()->nullable();
          $table->text('description');
          $table->string('contact_person',255)->nullable();
          $table->string('contact_phone',255)->nullable();
          $table->string('contact_email',255)->nullable();
          $table->string('related_link_1',255)->nullable();
          $table->string('related_link_2',255)->nullable();
          $table->string('related_link_3',255)->nullable();
          $table->dateTime('reg_deadline')->nullable();
          $table->float('cost')->nullable();
          $table->boolean('free')->unsigned()->nullable();
          $table->string('participants', 10)->nullable();
          $table->boolean('lbc_approved')->unsigned()->nullable();
          $table->boolean('is_featured')->unsigned()->default(0);
          $table->boolean('is_approved')->unsigned()->default(0);
          $table->boolean('is_canceled')->unsigned()->default(0);
          $table->boolean('homepage')->unsigned()->default(0);
          $table->string('submitter',255)->nullable();
          $table->string('building',255)->nullable();
          $table->string('tickets', 10)->nullable();
          $table->string('ticket_details_online',255)->nullable();
          $table->string('ticket_details_phone',255)->nullable();
          $table->string('ticket_details_office',255)->nullable();
          $table->string('ticket_details_other',255)->nullable();
          $table->date('submission_date')->nullable();
          $table->date('approved_date')->nullable();
          $table->string('contact_fax',255)->nullable();
          $table->boolean('mini_calendar')->unsigned()->nullable();
          $table->boolean('lbc_reviewed')->unsigned()->default(0);
          $table->boolean('ensemble')->unsigned()->nullable();
          $table->boolean('mba')->unsigned()->nullable();
          $table->boolean('mini_calendar_alt')->unsigned()->nullable();
          $table->string('feature_image',255)->nullable();
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
        Schema::drop('cea_events');
    }
}
