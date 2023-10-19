<?php
 Route::apiResource('users', 'UsersApiController');
Route::group(['prefix' => 'v1', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

       // Universities
       Route::apiResource('universities', 'UniversitiesApiController');

        // Careers
        Route::apiResource('carrers', 'CarrersApiController');

         // Courses
       Route::apiResource('courses', 'CoursesApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // // Users
    // Route::apiResource('users', 'UsersApiController');

     // Appointments
     Route::apiResource('appointments', 'AppointmentsApiController');

    // Events
    Route::apiResource('events', 'EventsApiController');
});
