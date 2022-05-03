<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ApiPlayerController,
					 	ApiScoreController,
						ApiStatusController,
						ApiCountryController};

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

Route::post('/user/add', [ApiPlayerController::class, 'addPlayer']);
Route::post('/score/add', [ApiScoreController::class, 'addScore']);

/* Route::get('user', 'ApiController@GetAllUsers'); */
/* Route::get('user/{userId}', 'ApiController@GetSpecificUsers'); */
/* Route::post('status', 'ApiController@UpdateStatus'); */
/* Route::put('user/{userId}', 'ApiController@UpdateUser'); */
