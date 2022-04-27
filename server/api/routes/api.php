<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user', 'App\Http\Controllers\ApiPlayerController@addPlayer');

/* Route::get('user', 'ApiController@GetAllUsers'); */
/* Route::get('user/{userId}', 'ApiController@GetSpecificUsers'); */
/* Route::post('score', 'ApiController@UpdateScoreData'); */
/* Route::post('status', 'ApiController@UpdateStatus'); */
/* Route::put('user/{userId}', 'ApiController@UpdateUser'); */
