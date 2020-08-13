<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {

return redirect('/login');
});


Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::resource('users', 'UsersController');
Route::resource('task', 'tasksController');
Route::get('/tasks', 'tasksController@show');
Route::get('/sort-date', 'tasksController@sortByDate')->name('sortDate');

Route::get('/test-email', 'JobController@processQueue');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

