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

Route::get('/', 'IndexController@index');
Route::post('/send-sms', 'IndexController@send_sms');

