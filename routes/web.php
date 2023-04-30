<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
Route::get('/welcome',function(){
    return view('welcome');
});
Route::controller(UserController::class)->group(function () {
    Route::get('/','getlogin')->name('login');
    Route::post('/users/login', 'login')->name('check-login');
    Route::post('/users', 'create')->name('create');
});
Route::middleware(['auth', 'auth'])->group(function () {
    Route::get('/index', [HomeController::class, 'index'])->name('home');
    Route::post('/eval',[HomeController::class,'evalution'])->name('eval');
});

Route::get('/logout', function(){Auth::logout();return Redirect::to('');})->name('logout');

