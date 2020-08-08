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
Route::post('register', 'API\AuthController@register');
Route::post('login', 'API\AuthController@login');


Route::group([ 'middleware' => ['api']], static function () {

Route::get('users', 'API\UserController@index')->name('users.index');
Route::post('user', 'API\UserController@store')->name('users.store');
Route::put('user/{id}', 'API\UserController@update')->name('users.update');
Route::delete('user/{id}', 'API\UserController@destroy')->name('users.destroy');

    Route::group(['middleware' => 'jwt.verify'], static function(){
        Route::post('logout', 'API\AuthController@logout');
        Route::post('refresh', 'API\AuthController@refresh');

    });
});

