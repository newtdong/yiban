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

Route::get('/', 'index@index')->name('index');
Route::get('/dati', 'dati@index')->name('dati');
Route::get('/rank', 'rank@index')->name('rank');
Route::get('/hasjoin', 'hasjoin@index')->name('hasjoin');
/*每关的题目请求*/
Route::get('/datiing1', 'datiing@lev1')->name('datiing1');
Route::get('/datiing2', 'datiing@lev2')->name('datiing2');
Route::get('/datiing3', 'datiing@lev3')->name('datiing3');
/*每关的计分以及跳转至下一关*/
Route::post('/score1', 'score@index1')->name('score1');
Route::post('/score2', 'score@index2')->name('score2');
Route::post('/score3', 'score@index3')->name('score3');
/*录入填空题*/
Route::get('/input', 'input@index')->name('input');
Route::post('/input_save', 'input@save')->name('input_save');