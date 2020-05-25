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

Auth::routes();

Route::prefix('/home')->middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/user', 'HomeController@update')->name('user.update');
    Route::post('/note', 'NoteController@store')->name('note.store');
    Route::post('/note/{id}', 'NoteController@update')->name('note.update');
    Route::get('/note/{id}', 'NoteController@status')->name('note.update');
    Route::delete('/note/{id}', 'NoteController@destruct')->name('note.destruct');
});
