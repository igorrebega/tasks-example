<?php

use Illuminate\Support\Facades\Route;

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

Route::get('task', 'TaskController@index');
Route::post('task', 'TaskController@create');

Route::put('task/{task}/done', 'TaskDoneController@create');
Route::put('task/{task}/undone', 'TaskDoneController@destroy');
