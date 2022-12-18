<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LendController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) { */
/* 	return $request->user(); */
/* }); */


// Usuarios
Route::group(['prefix' => 'Users', 'controller' => UserController::class], function () {
  Route::get('/GetAllUsers', 'getAllUsers');
  Route::get('/GetAnUser/{user}', 'getAnUser');
  Route::post('/CreateUser', 'createUser');
  Route::put('/UpdateUser/{user}', 'updateUser');
  Route::delete('/DeleteUser/{user}', 'deleteUser');
  Route::get('/GetAllLendsByUser/{user}', 'getAllLendsByUser');
  Route::get('/GetAllUsersWithLends/', 'getAllUsersWithLends');
});

// Libros
Route::group(['prefix' => '/Books', 'controller' => BookController::class], function () {
  Route::get('/getAllBooks', 'getAllBooks')->name('books');
});

// Categorias
Route::group(['prefix' => '/Categories', 'controller' => CategoryController::class], function () {
  Route::get('/GetAllCategories', 'getAllCategories');
});

// Autores
Route::group(['prefix' => '/Authors', 'controller' => AuthorController::class], function () {
  Route::get('/GetAllAuthors', 'getAllAuthors');
});

// Prestamos
Route::group(['prefix' => 'Lends', 'controller' => LendController::class], function () {
  Route::post('/CreateLend', 'createLend');
});
