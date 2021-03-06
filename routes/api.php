<?php

use \App\Http\Controllers\RacesController;
use \App\Http\Controllers\TracksController;
use \App\Http\Controllers\SeriesController;
use \App\Http\Controllers\SeasonsController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:api')->group(function () {
    /* @see TracksController::store() */
    Route::post('/track', 'TracksController@store');

    /* @see RacesController::store() */
    Route::post('/race', 'RacesController@store');

    /* @see VideosController::store() */
    Route::post('/video', 'VideosController@store');

    /* @see SeriesController::store() */
    Route::post('/series', 'SeriesController@store');


    Route::get('/series-races-count', 'RacesController@test');
    Route::get('/season-races-count', 'RacesController@test2');
    Route::get('/races-per-track', 'RacesController@test3');
});



//Races
/* @see RacesController::index() */
Route::get('/races', 'RacesController@index');

/* @see LatestRacesController::index() */
Route::get('/races/latest', 'LatestRacesController@index');

/* @see RacesController::show() */
Route::get('/race/{race}', 'RacesController@show');



// Tracks
/* @see TracksController::index() */
Route::get('/tracks', 'TracksController@index');

/* @see TracksController::show() */
Route::get('/track/{track}', 'TracksController@show');



// Series
/* @see SeriesController::index() */
Route::get('/series', 'SeriesController@index');

/* @see SeriesController::show() */
Route::get('/series/{series}', 'SeriesController@show');



// Seasons
/* @see SeasonsController::index() */
Route::get('/seasons', 'SeasonsController@index');

/* @see SeriesSeasonController::index() */
Route::get('/series/{series}/season/{season}', 'SeriesSeasonController@index');



//Schedule
/* @see ScheduleController::index() */
Route::get('/events', 'ScheduleController@index');



//Contact Us
/* @see ContactUsController::store() */
Route::post('/contact-us', 'ContactUsController@store');