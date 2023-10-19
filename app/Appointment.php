<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //

    public $table = 'appointments';


    protected $fillable = [
        'university_id',
        'career_id',
        'course_id',
        'tutor_id',
        'student_id',
        'date_available',
        'time_available',
    ];
}
