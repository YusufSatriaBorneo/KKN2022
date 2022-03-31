<?php

use Illuminate\Support\Facades\Auth;
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


Route::middleware('auth')->group(function () {
    Route::get('/arsip', 'ArsipController@index')->name('arsip');
    Route::get('/arsip/{id}/show', 'ArsipController@show');
    Route::get('/arsip/create', 'ArsipController@create')->name('create');
    Route::get('/arsip/edit/{arsip:id}', 'ArsipController@edit');
    Route::patch('/arsip/edit/{arsip:id}', 'ArsipController@update');
    Route::post('/arsip/store', 'ArsipController@store')->name('store');
    Route::delete('/arsip/delete/{arsip:id}', 'ArsipController@destroy');
    Route::get('/', 'HomeController@index')->name('home');
});


Auth::routes();
