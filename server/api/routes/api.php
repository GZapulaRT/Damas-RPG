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
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) { */
/*     return $request->user(); */
/* }); */

Route::controller(ApiController::class)->group(function () {
    Route::get('/user/one/{id}', 'oneUser');
    Route::get('/user/{page?}', 'allUsers');
    Route::get('/rank/{page?}', 'topResults');
    Route::post('/score/add', 'updateScore');
    });

//added for some testing, too lazy to actually do a proper PHPunit test
Route::get('/test', [ApiTestController::class, 'insertRank']);
