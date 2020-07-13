<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', 'LoginController@Login');
Route::post('/register', 'LoginController@Register');
Route::post('/verifyphoneno', 'LoginController@Verifyphoneno');

Route::post('/forgotpassword', 'LoginController@ForgotPassword');
Route::post('/newpassword', 'LoginController@NewPassword');
Route::post('/verifyforgotpassword', 'LoginController@VerifyForgotPassword');
