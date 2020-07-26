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

/* Account */
Route::prefix('account')->group(function () {
    Route::post('/login', 'LoginController@Login');
    Route::post('/register', 'LoginController@Register');
    Route::post('/verifyphoneno', 'LoginController@Verifyphoneno');
    Route::post('/sendsmsonregisteragain', 'LoginController@SendSmsOnRegisterAgain');

    Route::post('/forgotpassword', 'LoginController@ForgotPassword');
    Route::post('/newpassword', 'LoginController@NewPassword');
    Route::post('/verifyforgotpassword', 'LoginController@VerifyForgotPassword');
});

/* Lenta */
Route::prefix('lenta')->group(function () {
    Route::post('index', 'LentaController@index');
    Route::post('get', 'LentaController@getInfo');
    Route::post('comments', 'LentaController@Comments');
    Route::post('comments/add', 'LentaController@AddComment');
});


Route::prefix('order')->group(function () {
    Route::post('create', 'OrderController@CreateOrder');
    Route::post('list', 'OrderController@ListOrders');
});

Route::prefix('chief')->group(function () {
    Route::post('create', 'ChiefController@CreateChief');
    Route::post('bestchiefs', 'ChiefController@BestChiefs');
    Route::post('nearchiefs', 'ChiefController@NearChiefs');
    Route::post('newchiefs', 'ChiefController@NewChiefs');
    Route::post('chiefforhome', 'ChiefController@ChiefForHome');
    Route::post('chiefinformation', 'ChiefController@ChiefInformation');
    Route::post('subscribe', 'ChiefController@SubscribeToChief');

});

Route::get('images/{type}/{filename}', 'PhotoController@image');
