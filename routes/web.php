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
        Route::post('/edit/{id}', 'HomeController@teamEdit')->name('editTeam');
        Route::post('/forward', 'HomeController@forward')->name('navigateForward');
        Route::post('/back', 'HomeController@back')->name('navigateBack');
        Route::delete('/delete/{id}', 'HomeController@teamDelete')->name('teamDelete');
        Route::get('/create', 'HomeController@teamCreateView');
        Route::get('/', 'HomeController@index')->name('teams');
        Route::get('/{id}', 'HomeController@teamEditView');
        Route::put('/add/{id}', 'HomeController@add')->name('addPlayer');
    });


Route::group([   
        'middleware' => 'auth',
        'prefix' => 'players'  
], function ($router) {
        Route::post('/create', 'PlayersController@createMethod')->name('createPlayer');
        Route::put('/edit/{id}', 'PlayersController@edit')->name('editPlayer');
        Route::delete('/delete/{id}', 'PlayersController@delete')->name('playerDelete');
        Route::delete('/kick/{id}', 'PlayersController@kick')->name('playerKick');
        Route::get('/create', 'PlayersController@createView');
        Route::get('/', 'PlayersController@index')->name('players');
        Route::get('/{id}', 'PlayersController@editView');
    });
