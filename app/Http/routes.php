<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::auth();
//Everything under here is required to be logged in, otherwise you get kick to the login screen

Route::get('/home', 'HomeController@index');
Route::get('/results/{exercise_id?}', 'ExerciseController@results');
Route::get('/exercise/{exercise_id?}', 'ExerciseController@exercise');
Route::post('/exerciseSubmit', 'ExerciseController@submit');
