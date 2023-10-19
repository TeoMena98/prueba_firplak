<?php
 Route::apiResource('users', 'UsersApiController');
Route::group(['prefix' => 'v1', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // // Users
    // Route::apiResource('users', 'UsersApiController');

});
