<?php

use App\Mail\RegistrationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
App::setLocale(Cookie::get('lang'));

Route::get('/', function () {
    return view('app');
});

Route::get('/mail', function () {
    $user = \App\Models\User::where('email', 'joseaperez87@gmail.com')->first();
    return view('mail.registration', [ 'user' => $user]);
});

Route::group(['prefix' => '/auth'], function(){
    Route::get('/login', function () {
        return view('auth.login');
    });
    Route::get('/register', function () {
        return view('auth.register');
    });
    Route::get('/success', function () {
        return view('auth.success');
    });
    Route::get('/resend', function () {
        return view('auth.resend');
    });
    Route::get('/confirm/{code}', [\App\Http\Controllers\auth\AuthController::class, 'confirm_code']);
});
