<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Role;
use App\USer;
use App\Event;
use App\University;
use App\Career;
use App\Course;
use App\Appointment;
use Illuminate\Support\Facades\DB;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $appointment = Appointment::all();
        
        // dd($appointment);
        return view('admin.appointment.index', compact('appointment'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create_1()
    {


$coursos = Course::all();


        return view('admin.appointment.create_1', compact('coursos'));
    }
    public function create()
    {
        //
        $fecha= request('fecha');
        abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $universities = University::all()->pluck('title', 'id');
        $careers = Career::all()->pluck('title', 'id');
        $courses = Course::all()->pluck('title', 'id');
      
        $events_time = DB::table('events')->where('start_time', 'LIKE',"%{$fecha}%")
        ->join('users', 'users.id', 'events.tutor_id')
        ->join('courses', 'courses.id', 'events.course_id')
        ->selectRaw('date(end_time) As Fecha')
        ->get();
   

        $events_hour = DB::table('events')->where('start_time', 'LIKE',"%{$fecha}%")
        ->join('users', 'users.id', 'events.tutor_id')
        ->join('courses', 'courses.id', 'events.course_id')
        ->selectRaw('time(start_time) As Hora_inicial, time(end_time) As Hora_final')
        ->get();


  
//  dd($events_hour);
        $relacionEloquent = 'roles'; //Nombre de tu relacion con roles en el modelo User

        $user_roles = User::whereHas($relacionEloquent, function ($query) {
            return $query->where('title', '=', 'User');
        })->get();

        $users = DB::table('events')
        ->join('users', 'users.id', '=', 'events.tutor_id')
        ->join('appointments', 'appointments.tutor_id', '=', 'events.tutor_id')
        ->select('events.start_time', 'events.end_time')
        ->get();


        return view('admin.appointment.create', compact( 'careers', 'universities', 'courses', 'events_time', 'events_hour', 'user_roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       
        $appointment = Appointment::create($request->all());
       

        return redirect()->route('admin.appointment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $appointment->load('roles');

        return view('admin.appointment.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
        abort_if(Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $roles = Role::all()->pluck('title', 'id');

        // $appointment->load('roles');

        return view('admin.appointment.edit', compact('roles', 'appointment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $appointment->update($request->all());
        $appointment->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.appointment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->delete();

        return back();
    }
    
    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
