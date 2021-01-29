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

Route::get('/', function () {
    return view('welcome');
});
Route::get('show', 'ArticleController@show');
Route::get('create', 'ArticleController@create');
Route::post('store', 'ArticleController@store');
Route::get('del/{id}', 'ArticleController@del');
Route::post('uploader', 'ArticleController@uploader');
Route::get('spider', 'ArticleController@spider');
Route::get('read', 'ArticleController@read');

