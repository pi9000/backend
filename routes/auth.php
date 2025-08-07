<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::namespace('Auth')->group( function () {
    Route::get('/','LoginController@showLoginForm')->name('login')->middleware('guest');
    Route::post('login','LoginController@login')->name('login.post')->middleware('guest');
    Route::get('logout','LoginController@logout')->name('logout')->middleware('auth');

    Route::get('/request_otp','LoginController@verifyLogin')->name('verifyLogin')->middleware('auth');
    Route::post('/otp_validate','LoginController@verifyCode')->name('verifyCode')->middleware('auth');
    Route::post('/second-password','LoginController@second_password')->name('second_password')->middleware('guest');
    Route::post('/retry_otp','LoginController@verifyCodeResend')->name('verifyCodeResend')->middleware('auth');
});
