<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');

            // fk career
            $table->unsignedInteger('career_id');
            $table->foreign('career_id')->references('id')->on('careers');

            // fk course
            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');

              // fk university
              $table->unsignedInteger('university_id');
              $table->foreign('university_id')->references('id')->on('universities');

            // fk tutor
            $table->unsignedInteger('tutor_id');
            $table->foreign('tutor_id')->references('id')->on('users');

               // fk student
               $table->unsignedInteger('student_id');
               $table->foreign('student_id')->references('id')->on('users');
          

            $table->date('date_available');
            $table->time('time_available');

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     //
    // }
}
