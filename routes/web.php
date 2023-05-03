<?php

use App\Http\Controllers\ExchangesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QLExchangesController;
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
Route::get('/',function(){
    return view('login');
});
Route::controller(UserController::class)->group(function () {
    Route::get('/','getlogin')->name('login');
    Route::post('/users/login', 'login')->name('check-login');
    Route::post('/users', 'create')->name('create');
    Route::get('/search', 'search') ->name('search');
    Route::post('/search', 'search') ->name('search');
});

Route::controller(ProfileController::class) -> group(function(){
    Route::get('/profile2/{username}', 'profileOrderUser') -> name('profile2');
    Route::get('/profile', 'index') -> name('profile');
});

Route::middleware(['auth', 'auth'])->group(function () {
    Route::get('/index', [HomeController::class, 'index'])->name('home');
    Route::post('/eval',[HomeController::class,'evalution'])->name('eval');
});

Route::controller(ExchangesController::class) -> group(function(){
    Route::get('/exchanges','index') -> name('exchanges');
});



Route::controller(QLExchangesController::class) -> group(function(){
    Route::get('/exchanges-management','index') -> name('exchanges-management');
    Route::post('/exchanges-management', 'createProduct') ->name('create-product');
    Route::get('/exchanges-management/{name}', 'deleteProduct') -> name('delete-product');
});

Route::get('/logout', function(){Auth::logout();return Redirect::to('');})->name('logout');

