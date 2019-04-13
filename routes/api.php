<?php

use Illuminate\Http\Request;

Route::post('login','ApiController@login');
Route::post('register','ApiController@register');
Route::post('addFood','ApiController@addFood');
Route::post('getTodayFood','ApiController@getTodayFood');
Route::post('deleteItem','ApiController@deleteItem');
Route::post('updateQty','ApiController@updateQty');
Route::post('getRestaurants','ApiController@getRestaurants');
Route::post('todayItemDetail','ApiController@todayItemDetail');
Route::post('addOrderItem','ApiController@addOrderItem');
Route::post('restoHistory','ApiController@restoHistory');
Route::post('acceptItem','ApiController@acceptItem');
Route::post('ngoRequestStatus','ApiController@ngoRequestStatus');