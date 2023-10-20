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

Route::get('/', 'App\Http\Controllers\LoginController@index');
Route::get('index', 'App\Http\Controllers\LoginController@index')->name('index');
Route::post('login', 'App\Http\Controllers\LoginController@authenticate')->name('login');
Route::get('dashboard', 'App\Http\Controllers\LoginController@dashboard')->name('dashboard');
Route::get('novoUsuario', 'App\Http\Controllers\UserController@index')->name('novoUsuario');
Route::post('cadastro/novoUsuario', 'App\Http\Controllers\UserController@novoUsuario')->name('cadastro/novoUsuario');