<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// # CI IMPORTIAMO IL CONTROLLER DELL'API
use App\Http\Controllers\Api\ProjectController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// # ROTTA DELL'API CONTROLLER RESOURCE CHE USA SOLO DUE ROTTE INDEX E SHOW
Route::apiResource("projects", ProjectController::class)->only(["index", "show"]);