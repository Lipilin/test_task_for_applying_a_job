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

Route::match(array('GET','POST'),'/','App\Http\Controllers\MainController@mainpage');
Route::get('/registration','App\Http\Controllers\MainController@registration');
Route::get('/login','App\Http\Controllers\MainController@login');

Route::post('/registration','App\Http\Controllers\AuthController@registration');
Route::post('/login','App\Http\Controllers\AuthController@login');
Route::post('/logout','App\Http\Controllers\AuthController@logout');
Route::get('/confirm_email','App\Http\Controllers\AuthController@checkVerification');
Route::post('/change_my_logo','App\Http\Controllers\UserController@change_my_logo');
Route::post('/create_post','App\Http\Controllers\PostController@create');
Route::post('/change_visibility','App\Http\Controllers\PostController@change_visibility');
Route::post('/delete_post','App\Http\Controllers\PostController@delete');
Route::post('/change_logo','App\Http\Controllers\UserController@change_logo');

