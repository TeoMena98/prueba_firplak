<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Event;
Use App\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        // Set timezone
        date_default_timezone_set('America/New_York');
        // If there is set date, find the doctors
          
        if (request('fecha')) {
            $formatDate = date('Y-m-d', strtotime(request('fecha')));
            $doctors = Event::where('start_time', 'LIKE',"%{$formatDate}%")
            ->join('users', 'users.id', 'events.tutor_id')
            ->join('courses', 'courses.id', 'events.course_id')
           
            ->get();
           
            return view('welcome', compact('doctors', 'formatDate'));
        };
        // Return all doctors avalable for today to the welcome page

        $fecha = date('Y-m-d');
        
        $doctors = Event::where('start_time', 'LIKE',"%{$fecha}%")
        ->join('users', 'users.id', 'events.tutor_id')
            ->join('courses', 'courses.id', 'events.course_id')
        
        ->get();
       dd($doctors);
        return view('welcome', compact('doctors'));
    }


    public function show($tutorId, $date)
    {
        $appointment = Event::where('tutor_id', $tutorId)->where('date_available', 'LIKE',"%{$date}%")->first();
        
        $times = Event::where('tutor_id', $tutorId)->where('date_available', 'LIKE',"%{$date}%")->first();
        $user = User::where('id', $tutorId)->first();
        $tutor_id = $tutorId;
        return view('appointment', compact('times', 'date', 'user', 'tutor_id'));
    }

    public function showqualification($tutorId)
    {
        $id = Appointment::all()->where('user_id', auth()->user()->id) ->where('status', 2) ->join('users', 'bookings.doctor_id', '=', 'users.id');
        // $appointment = Booking::where('user_id', auth()->user()->id) ->where('status', 2)
        // ->join('users', 'bookings.doctor_id', '=', 'users.id')
        // ->get();
        
        // $times = Time::where('appointment_id', $appointment->id)->where('status', 0)->get();
        $user = User::where('id', $tutorId)->first();
        $tutorId = $tutorId;
        return view('qualification', compact('id',  'tutorId'));
    }


}
