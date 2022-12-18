<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
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

//Auth
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/index', [ChatController::class, 'index']);
    Route::get('/room-chat', [ChatController::class, 'roomChatList']);
    Route::get('/room-chat/{room}', [ChatController::class, 'roomChatDetail']);
    Route::post('/message', [ChatController::class, 'messageNewRoom']);
    Route::post('/message/{room}', [ChatController::class, 'messageWithRoom']);
});
