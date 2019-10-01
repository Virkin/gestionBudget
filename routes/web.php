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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/getData/{user_id?}', 'ApiController@index');
Route::get('/getUsers', 'ApiController@getUsers');
Route::get('/getSellers', 'ApiController@getSellers');
Route::post('/submitPurchase', 'ApiController@addPurchase');
