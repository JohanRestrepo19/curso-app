<?php

use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

Route::get('/test', function () {
  /* return Role::all()->pluck('name'); */
  /* $users = User::get(); */
  /* foreach ($users as $user) { */
  /*   if ($user->number_id == 1234567890) $user->assignRole('admin'); */
  /*   else $user->assignRole('user'); */
  /* } */
  /* Role::create(['name' => 'user']); */
});

Route::get('/', [BookController::class, 'showHomeWithBooks'])->name('home');

// Usuarios
Route::group(['prefix' => '/users', 'middleware' => ['auth', 'role:admin'], 'controller' => UserController::class], function () {
  Route::get('/', 'showAllUsers')->name('users');
  Route::get('/createUser', 'showCreateUser')->name('user.create');
  Route::post('/createUser', 'createUser')->name('user.create.post');
  Route::get('/updateUser/{user}', 'showUpdateUser')->name('user.update');
  Route::put('/updateUser/{user}', 'updateUser')->name('user.update.put');
  Route::delete('/deleteUser/{user}', 'deleteUser')->name('user.delete');
});

// Libros
Route::group(['prefix' => '/books', 'middleware' => ['auth', 'role:admin'], 'controller' => BookController::class], function () {
  Route::get('/', 'showAllBooks')->name('books');
  Route::get('/getAllBooks', 'getAllBooks');
  Route::get('/getBook/{book}', 'getBook');
  Route::post('/SaveBook', 'saveBook');
  Route::post('/UpdateBook/{book}', 'updateBook');
  Route::delete('/DeleteBook/{book}', 'deleteBook');
});

// Categorias
Route::group(['prefix' => '/categories', 'controller' => CategoryController::class], function () {
  Route::get('/GetAllCategories', 'getAllCategories');
});

// Autores
Route::group(['prefix' => '/authors', 'controller' => AuthorController::class], function () {
  Route::get('/GetAllAuthors', 'getAllAuthors');
});

// Autenticacion
Route::group(['controller' => LoginController::class], function () {
  // Login Routes...
  Route::get('login', 'showLoginForm')
    ->name('login');
  Route::post('login', 'login');
  // Logout Routes...
  Route::post('logout', 'logout')
    ->name('logout');
});


// Password Reset Routes...
Route::group(['controller' => ForgotPasswordController::class], function () {
  Route::get('password/reset', 'showLinkRequestForm')
    ->name('password.request');
  Route::post('password/email', 'sendResetLinkEmail')
    ->name('password.email');
  Route::get('password/reset/{token}', 'showResetForm')
    ->name('password.reset');
  Route::post('password/reset', 'reset')
    ->name('password.update');
});

// Password Confirmation Routes...
Route::group(['controller' => ConfirmPasswordController::class], function () {
  Route::get('password/confirm', 'showConfirmForm')
    ->name('password.confirm');
  Route::post('password/confirm', 'confirm');
});

// Email Verification Routes...
Route::group(['controller' => VerificationController::class], function () {
  Route::get('email/verify', 'show')
    ->name('verification.notice');
  Route::get('email/verify/{id}/{hash}', 'verify')
    ->name('verification.verify');
  Route::post('email/resend', 'resend')
    ->name('verification.resend');
});
