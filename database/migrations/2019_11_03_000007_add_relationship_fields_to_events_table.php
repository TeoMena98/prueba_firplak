<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEventsTable extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedInteger('event_id')->nullable();

            $table->foreign('event_id', 'event_fk_556522')->references('id')->on('events');



            $table->unsignedInteger('tutor_id');
            $table->foreign('tutor_id')->references('id')->on('users');

            
            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }
}
