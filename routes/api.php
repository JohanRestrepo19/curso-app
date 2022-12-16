<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\LendController;
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
	Route::get('/GetAllLendsByUser/{user}', 'getAllLendsByUser');
	Route::get('/GetAllUsersWithLends/', 'getAllUsersWithLends');
});

Route::group(['prefix' => '/Books', 'controller' => BookController::class], function () {
	Route::get('/getAllBooks', 'getAllBooks')->name('books');
});

Route::group(['prefix' => 'Lends', 'controller' => LendController::class], function () {

	Route::post('/CreateLend', 'createLend');
});
