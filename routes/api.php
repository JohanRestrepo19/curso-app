<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) { */
/* 	return $request->user(); */
/* }); */


Route::group(['prefix' => 'Users', 'controller' => UserController::class], function () {
	Route::get('/GetAllUsers', 'getAllUsers');
	Route::get('/GetAnUser/{user}', 'getAnUser');
	Route::post('/CreateUser', 'createUser');
	Route::put('/UpdateUser/{user}', 'updateUser');
	Route::delete('/DeleteUser/{user}', 'deleteUser');
});
