<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExchangesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListAuctionedController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\ProductInFoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QLExchangesController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\SuggestController;
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
    Route::get('/profile2/{id}', 'profileOrderUser') -> name('profile2');
    Route::get('/profile', 'index') -> name('profile');
    Route::post('/profile2/{id}', 'followUser') -> name('follow');
    Route::post('/profile2/{id}/unfollow', 'unFollowUser') -> name('un-follow');
    Route::get('/update-profile', 'updateProfileView') -> name('update-profile-view');
    Route::post('/update-profile', 'updateProfile') -> name('update-profile');
    Route::post('/create-post', 'createPost') -> name('create-post');
    Route::post('/like-post', 'like') -> name('like-post');
    Route::post('/unlike-post', 'unlike') -> name('unlike-post');
    Route::post('/update-post/{id}', 'updatePost') -> name('update-post');
    Route::get('/delete-post/{id}', 'deletePost') -> name('delete-post');
    Route::post('/comment-post/{id}', 'comment') -> name('comment-post');
});

Route::middleware(['auth', 'auth'])->group(function () {
    Route::get('/index', [HomeController::class, 'index'])->name('home');
});

Route::controller(ExchangesController::class) -> group(function(){
    Route::get('/exchanges','index') -> name('exchanges');
});

Route::controller(QLExchangesController::class) -> group(function(){
    Route::get('/exchanges-management','index') -> name('exchanges-management');
    Route::post('/exchanges-management', 'createProduct') ->name('create-product');
    Route::get('/exchanges-management/{id}', 'deleteProduct') -> name('delete-product');
});

Route::controller(ProductInFoController::class) -> group(function(){
    Route::get('product-info/{id}', 'index') -> name('product-info');
    Route::post('product-info/{id}', 'orderByUser') -> name('order-by-user');
    Route::post('product-info/update/{id}', 'updateByUser') -> name('update-by-user');
});

Route::controller(OrderDetailsController::class) -> group(function(){
    Route::get('/order-details/{id}', 'index') -> name('order-details');
    Route::post('/confirm-order/{id}', 'confirmOrder') -> name('confirm-order');
    Route::get('/cancel-order/{id}', 'cancelOrder') -> name('cancel-order');
});

Route::controller(ListAuctionedController::class) -> group(function(){
    Route::get('/list-auctioned/{id}', 'index')->name('list-auctioned');
    Route::post('/evalution','evalution')->name('eval');

});

Route::controller(StatisticsController::class) -> group(function(){
    Route::get('/statistics/{id}', 'index') -> name('statistics');
    Route::get('/print-statistics', 'printStatistics') -> name('print-statistics');
});

Route::controller(AdminController::class) -> group(function(){
    Route::post('/create-criteria','createcriteria')->name('create-criteria');
    Route::get('/all-users','listUsers') -> name('listUsers');
    Route::get('/all-session','listSession') -> name('listSession');
    Route::get('/all-criteria','criteria') -> name('criteria');
    Route::get('/delete-session/{id}', 'deleteSession') -> name('delete-session');
    Route::get('/delete-users/{id}', 'deleteUsers') -> name('delete-users');
    Route::get('/delete-criteria', 'deletecriteria') -> name('delete-criteria');
});





Route::controller(SuggestController::class) -> group(function()
{
    Route::get('/suggest/{id}' ,'index') -> name('suggest');
});

Route::get('/logout', function(){Auth::logout();return Redirect::to('');})->name('logout');



