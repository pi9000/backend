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

Route::middleware(['auth','verify'])->group( function () {
    Route::post('_get_me_count','HomeController@_get_me_count')->name('_get_me_count');
    Route::post('_get_latest','HomeController@_get_latest')->name('_get_latest');
    Route::post('_get_latest_promotion','HomeController@_get_latest_promotion')->name('_get_latest_promotion');

    Route::get('total_bet_sbo','HomeController@comingsoon')->name('total_bet_sbo');
    Route::get('total_bet_bti','HomeController@comingsoon')->name('total_bet_bti');
    Route::get('total_bet_ug','HomeController@comingsoon')->name('total_bet_ug');
    Route::get('commision_setting','HomeController@comingsoon')->name('commision_setting');
    Route::get('commision_process','HomeController@comingsoon')->name('commision_process');
    Route::get('release_commision_log','HomeController@comingsoon')->name('release_commision_log');
    Route::get('commision_process_new','HomeController@comingsoon')->name('commision_process_new');
    Route::get('rebate','HomeController@comingsoon')->name('rebate');
    Route::get('cashrebate_settings','HomeController@comingsoon')->name('cashrebate_settings');
    Route::get('cashrebate_log','HomeController@comingsoon')->name('cashrebate_log');
    Route::get('cashback','HomeController@comingsoon')->name('cashback');
    Route::get('cashback_setting','HomeController@comingsoon')->name('cashback_setting');
    Route::get('cashback_log','HomeController@comingsoon')->name('cashback_log');


    Route::post('request_update_otp_session','HomeController@request_otp_session')->name('request_otp_session');
    Route::post('update_profile_username','ProfileController@update_profile_username')->name('update_profile_username');
    Route::post('update_profile_pin','ProfileController@update_profile_pin')->name('update_profile_pin');
    Route::post('update_profile_password','ProfileController@update_profile_password')->name('update_profile_password');
    Route::post('upload_admin_logo_images','ProfileController@upload_app_logo')->name('upload_app_logo');
});
