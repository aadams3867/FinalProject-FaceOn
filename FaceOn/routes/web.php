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
    return view('welcome');
});

Route::get('/kairos', 'KairosController@index')->name('kairos');
Route::post('/kairos', 'KairosController@login');

Auth::routes();

Route::get('/test', 'TestController@index');

Route::get('/home', 'HomeController@index');
