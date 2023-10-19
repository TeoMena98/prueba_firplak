<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');


    // Appointments
    Route::delete('appointment/destroy', 'AppointmentsController@massDestroy')->name('appointment.massDestroy');
    Route::get('appointment/create_1', 'AppointmentsController@create_1');
    Route::resource('appointment', 'AppointmentsController');


   // Universities
   Route::delete('universities/destroy', 'UniversityController@massDestroy')->name('universities.massDestroy');
   Route::resource('universities', 'UniversityController');

      // Careers
      Route::delete('careers/destroy', 'CareerController@massDestroy')->name('careers.massDestroy');
      Route::resource('careers', 'CareerController');

         // Courses
   Route::delete('courses/destroy', 'CourseController@massDestroy')->name('courses.massDestroy');
   Route::resource('courses', 'CourseController');

    // Events
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::resource('events', 'EventsController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');

    
    // JSON
    Route::get('users/tutors/{tutor}', 'UsersController@tutors');
    Route::get('/schedule/hours', 'Api\ScheduleController@hours');
});
