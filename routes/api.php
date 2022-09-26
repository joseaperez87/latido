<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
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
App::setLocale(Cookie::get('lang'));

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [\App\Http\Controllers\auth\AuthController::class, 'logout']);
});

Route::post('/register', [\App\Http\Controllers\auth\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\auth\AuthController::class, 'login']);
Route::post('/check_email', [\App\Http\Controllers\auth\AuthController::class, 'email']);
Route::post('/check_username', [\App\Http\Controllers\auth\AuthController::class, 'username']);
Route::post('/resend', [\App\Http\Controllers\auth\AuthController::class, 'resend_email']);
