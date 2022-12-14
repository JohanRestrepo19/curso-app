<?php

use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
