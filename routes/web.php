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

Route::get('/', 'HomeController@getIndex')->name('home');


Route::get('/login/spotify', 'AuthSpotifyController@spotifyLogin')->name('login.spotify');
Route::get('/auth/spotify', 'AuthSpotifyController@spotifyCallback');

Route::get('/result', 'SpotifyController@getResult')->name('result');

Route::get('/{slug}', 'HomeController@getUserChart')->name('user.chart');