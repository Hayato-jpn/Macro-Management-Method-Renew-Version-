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

Route::get('/', 'Admin\FoodController@top');
Route::get('/home', 'Admin\FoodController@top');
Route::get('top', 'Admin\FoodController@top');
Route::get('howtouse', 'Admin\FoodController@use')->middleware('auth');

Route::group(['prefix' => 'admin'], function() {
   Route::get('food/create', 'Admin\FoodController@create')->middleware('auth');
   Route::post('food/create', 'Admin\FoodController@record'); 
   Route::get('food/index', 'Admin\FoodController@index')->middleware('auth');
   Route::get('food/edit', 'Admin\FoodController@edit')->middleware('auth');
   Route::post('food/edit', 'Admin\FoodController@update');
   Route::get('food/delete', 'Admin\FoodController@delete')->middleware('auth');
   Route::get('food/history', 'Admin\FoodController@history')->middleware('auth');
   Route::post('food/history', 'Admin\FoodController@check');
   Route::get('food/today', 'Admin\FoodController@today')->middleware('auth');
   
   Route::get('profile/create', 'Admin\ProfileController@create')->middleware('auth');
   Route::post('profile/create', 'Admin\ProfileController@record');
   Route::get('profile/data', 'Admin\ProfileController@data')->middleware('auth');
   Route::get('profile/edit', 'Admin\ProfileController@edit')->middleware('auth');
   Route::post('profile/edit', 'Admin\ProfileController@update');
});
Auth::routes();
