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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();



Route::group([   
        'middleware' => 'auth',
        'prefix' => 'teams'  
    ], function ($router) {
        Route::post('/create', 'HomeController@teamCreate')->name('createTeam');
        Route::get('/create', 'HomeController@teamCreateView')->name('team');
        Route::get('/', 'HomeController@index')->name('teams');
    });
