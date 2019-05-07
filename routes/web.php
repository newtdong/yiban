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

Route::get('/','index@index')->name('index');
Route::any('/dati','dati@index')->name('dati');
Route::get('/rank','rank@index')->name('rank');
Route::get('/hasjoin','hasjoin@index')->name('hasjoin');
Route::get('/datiing','datiing@lev3')->name('datiing');
Route::any('/score','score@index')->name('score');
Route::any('/input','input@index')->name('input');
Route::any('/inputing','input@save')->name('inputing');