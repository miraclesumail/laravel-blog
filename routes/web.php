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

Route::get('/student', 'studentController@index');

Route::get('/players', 'studentController@players');

Route::get('/players/{id}', 'studentController@player');

Route::get('/dogs', 'dogController@index');

Route::get('/flights', 'dogController@flights');

Route::get('/musics', 'dogController@musics');

Route::post('/players', 'studentController@createPlayer');

Route::get('/animals/getCount', 'studentController@getAniCount');

Route::get('/animals/{type}/{count?}/{page?}', 'studentController@getAniByType');

Route::post('/signin', 'studentController@signin');

Route::get('/onetwo', 'studentController@testOnetoOne');

Route::get('/test', 'studentController@test_obj');

Route::get('/country', 'studentController@getCountry');

Route::post('/upload', 'studentController@upload');

Route::get('/getPosition/{title}', 'studentController@getPosition');

Route::get('/getJobs/{des}', 'studentController@getJobs');

Route::post('/withdraw', 'studentController@withdraw');

Route::get('/getbalance/{username}', 'studentController@getbalance');
//Route::get('/signin/{name}', 'studentController@signin');



