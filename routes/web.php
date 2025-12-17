<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DeliveryInfoController;



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

Route::get('/', function () {
    return view('HomePage');
});


Route::post('/register', [UserController::class, 'user_registration']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/LoginPg', [UserController::class, 'login'])->name('showLoginForm');

Route::get('/redirect_user_to_login', [UserController::class, 'regUser_to_Login'])->name('displaylLoginPage');

Route::post('/user_login', [UserController::class, 'user_login'])->name('loginUser');

Route::get('/user_account', [UserController::class, 'displayUserAccount'])->middleware('auth')->name('displayAccount');

Route::get('/contact_us_pg', [PageController::class, 'routeContactUsPg'])->name('displayContactUs');

Route::get('/about_us_pg', [PageController::class, 'routeAboutUsPg'])->name('displayAboutUs');



Route::middleware('auth')->group(function () {
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
});


Route::get('/delivery_info', [PageController::class, 'directDeliveryPg'])->name('deliveryData');

Route::get('/home_page', [PageController::class, 'directHomePg'])->name('displayHomePg');

Route::middleware('auth')->group(function () {
    Route::post('/cart/delete', [CartController::class, 'deleteCartItem'])->name('cart.delete');
});


Route::post('/cart/increment', [CartController::class, 'incrementQuantity'])->name('cart.increment');
Route::post('/cart/decrement', [CartController::class, 'decrementQuantity'])->name('cart.decrement');



//hanndle delivery info
Route::post('/delivery', [DeliveryController::class, 'store'])
    ->name('delivery.data')
    ->middleware('auth');



Route::get('/HomePage', function(){
return view('HomePage');
})->name('viewHomePage');




Route::get('/homePg-registration', function () {
    return view('UserRegPg'); // User registration page
})->name('home.register');

Route::get('/watch-product1', function () {
    return view('Product1Pg'); // User registration page
})->name('product1');




