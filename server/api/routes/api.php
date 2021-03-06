<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ApiController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/


/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) { */
/*     return $request->user(); */
/* }); */

Route::controller(ApiController::class)->group(function () {
    Route::get('/user/one/{id}', 'oneUser');
    Route::get('/user', 'allUsers');
    Route::get('/rank', 'topResults');
    Route::get('/rank/{id}', 'userRank');
    Route::post('/user/add', 'storeUser');
    Route::post('/score/add', 'storeScore');
    Route::put('/score/add', 'updateScore');
    });
