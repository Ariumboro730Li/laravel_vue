<?php

use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestApiController;

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


Route::prefix('test-api')->group(function () {
    Route::get("/", [TestApiController::class, "index"]);
    Route::post("/", [TestApiController::class, "index"]);
    Route::delete("/{id}", [TestApiController::class, "delete"]);
    Route::post("/save", [TestApiController::class, "save"]);
    Route::post("/finder", [TestApiController::class, "finder"]);
});

Route::get("search/{value}", [SearchController::class, "index"]);
