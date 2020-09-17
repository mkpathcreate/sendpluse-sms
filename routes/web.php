<?php

use Illuminate\Support\Facades\Route;

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
//Route::middleware(['under-construction'])->group(function(){});
Auth::routes(['verify' => true]);

Route::get('/', 'IndexController@index')->middleware('auth');
Route::post('/send-sms', 'IndexController@send_sms')->middleware('auth');
Route::get('/my-campaigns', 'IndexController@my_campaigns')->middleware('auth');
Route::get('/my-campaigns/{id}', 'IndexController@my_campaign_info')->middleware('auth');
Route::get('/my-campaigns/{id}/cancel', 'IndexController@my_campaign_cancel');
Route::get('/my-campaigns/{id}/delete', 'IndexController@my_campaign_delete');
Route::get('/documentation', 'IndexController@documentation')->middleware('auth');

