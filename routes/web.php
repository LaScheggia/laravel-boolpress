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

Auth::routes();



Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function(){
        // qui si mettono tutte le rotte admin (il nostro CRUD)
        Route::get('/','HomeController@index')->name('home');
        Route::resource('/posts', 'PostController');
    });


    // rotta che serve a vue per gestire tutte le rotte possibili alternative a quelle Auth e admin
Route::get('{any?}', function(){

      return view('guest.home');

    })->where('any','.*');
