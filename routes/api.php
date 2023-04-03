<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CurrencyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping',[CurrencyController::class, "pingCheck"]);


// Route::post('/add/pair',[CurrencyController::class, "addPair"]);
Route::middleware('trusttoken')->group(function(){
    Route::post('/add/pair/{token?}',[CurrencyController::class, "addPair"]);
});
Route::get('/get/pair/{token?}',[CurrencyController::class, "getPair"]);
Route::delete('/delete/pair/{id}',[CurrencyController::class, "delete"]);

Route::post('/user/register',[UserController::class, "register"]);
Route::post('/user/login',[UserController::class, "login"]);


