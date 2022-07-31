<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;

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

Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {

    Route::post('login', 'LoginController@login')->name('login');

    Route::post('register', 'RegisterController@register')->name('register');

    Route::group(['middleware' => ['auth:api']], function () {

        Route::get('email/verify/{hash}', 'VerificationController@verify')->name('verification.verify');

        Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');

        Route::get('user', 'AuthenticationController@user')->name('user');

        Route::post('logout', 'LoginController@logout')->name('logout');

    });    

});

Route::get('lists', [ListController::class, 'index']);
Route::prefix('/list')->group(function () {
    Route::post('/store', [ListController::class, 'store']);
    Route::put('/{id}', [ListController::class, 'update']);
    Route::delete('/{id}', [ListController::class, 'destroy']);
});