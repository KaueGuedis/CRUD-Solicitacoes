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
Route::get('login', 'App\Http\Controllers\LoginController@index')->name('login');
Route::get('logout', 'App\Http\Controllers\LoginController@logout')->name('logout');
Route::post('authenticate', 'App\Http\Controllers\LoginController@authenticate')->name('authenticate');
Route::get('dashboard', 'App\Http\Controllers\LoginController@dashboard')->name('dashboard');
Route::get('novoUsuario', 'App\Http\Controllers\UserController@index')->name('novoUsuario');
Route::post('cadastro/novoUsuario', 'App\Http\Controllers\UserController@novoUsuario')->name('cadastro/novoUsuario');
Route::get('listagemChamados', 'App\Http\Controllers\ChamadosController@listagemChamados')->name('listagemChamados');
Route::get('novoChamado', 'App\Http\Controllers\ChamadosController@novoChamado')->name('novoChamado');
Route::post('salvarChamado', 'App\Http\Controllers\ChamadosController@salvarChamado')->name('salvarChamado');
Route::get('visualizarChamado/{id}', 'App\Http\Controllers\ChamadosController@visualizarChamado')->name('visualizarChamado');
Route::post('atualizaChamado', 'App\Http\Controllers\ChamadosController@atualizaChamado')->name('atualizaChamado');
Route::get('baixarArquivo', 'App\Http\Controllers\ChamadosController@baixarArquivo')->name('baixarArquivo');