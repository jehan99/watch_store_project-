<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DeliveryInfoController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\User;
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



Route::post('/register', [UserController::class, 'user_registration']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/login', [UserController::class, 'login'])->name('login');

// Route::get('/redirect_user_to_login', [UserController::class, 'regUser_to_Login'])->name('displaylLoginPage');

Route::post('/user_login', [UserController::class, 'user_login'])->name('loginUser');

Route::get('/user_account', [UserController::class, 'displayUserAccount'])->middleware('auth')->name('displayAccount');

Route::get('/contact_us_pg', [PageController::class, 'routeContactUsPg'])->name('displayContactUs');

Route::get('/about_us_pg', [PageController::class, 'routeAboutUsPg'])->name('displayAboutUs');




Route::middleware('auth')->group(function () {
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
});


Route::get('/delivery_info/{product_id}', [DeliveryController::class, 'deliveryInfoDisplay'])
    ->name('deliveryData')
    ->middleware('auth');

Route::post('/delete-delivery-info',[DeliveryController::class, 'deleteDelivery']) ->name('delivery.delete');


Route::middleware('auth')->group(function () {
    Route::post('/cart/delete', [CartController::class, 'deleteCartItem'])->name('cart.delete');
});


Route::post('/cart/increment', [CartController::class, 'incrementQuantity'])->name('cart.increment');
Route::post('/cart/decrement', [CartController::class, 'decrementQuantity'])->name('cart.decrement');


Route::post('change-password',[UserController::class, 'changePassword'] )->name('password.change');
Route::get('change-password-page',[PageController::class, 'directToChangePasswordPg'] )->name('password.change.page');




Route::get('/homePg-registration', function () {
    return view('UserRegPg'); // User registration page
})->name('home.register');

Route::get('/watch-product1', function () {
    return view('Product1Pg'); // User registration page
})->name('product1');


//hanndle delivery info
Route::post('/delivery1', [DeliveryController::class, 'deliveryInfo'])
    ->name('delivery.data')
    ->middleware('auth');


Route::get('/delivery', [DeliveryController::class, 'showDeliveryPage']);



Route::get('/display_delivery-info/{product_id}', [DeliveryController::class, 'deliveryInfoDisplay'])->name('delivery.show');

//Route::post('/order_info', [OrderController::class, 'frontPgOrder'])->name('item_info')->middleware('auth');



Route::get('/product/{id}', [ProductController::class, 'showClickedProduct'])
    ->name('product.show');
    
    
    
    Route::middleware('auth')->group(function () {

    Route::get('/order-summary/{product_id}/{delivery_id}', [OrderController::class, 'index'])->name('order.summary');
    Route::get('/buy-now/{product}', [OrderController::class, 'buyNow'])->name('buy.now');
    Route::post('/order/store', [OrderController::class, 'storeOrder'])->name('order.store');
    Route::get('/my-orders', [OrderController::class, 'userOrders'])
    ->name('user.orders');

});
   

    // Route::post('/order-summary/{product_id}/{delivery_id}', [OrderController::class, 'index'])
    // ->name('order.summary');


//.........................ADMIN PANNEL.................................................


//Product Management
    Route::post('/admin/add-products', [ProductController::class,'productHandler'])->name('enterProductsDB');
    
   Route::get('/admin/add-products', function () {
        return view('admin.addProductsPg'); // your blade file
    });

    //products displaying to the home page
    Route::get('/', [ProductController::class, 'displayProductToHomePg'])->name('homePage');

    //Product listing 
    Route::get('/   ', function () {
        return view('admin.view-products')->name('viewProducts');
    });
    

//route for admin product view
Route::get('/admin/view-products', [ProductController::class, 'displayProductsAdmin'])
     ->name('admin.products');

//Delete products 
Route::delete('/delete-product/{product}', [ProductController::class, 'deleteProduct'] )->name('product.delete');

//Update products
Route::get('/update-products-page/{id}', [ProductController::class, 'upadateProductsPg'] )->name('productsUpdatePg');
Route::put('/update-product/{id}', [ProductController::class, 'updateProduct'] )->name('product.update');
Route::get('/updated-product-viewPg', [ProductController::class, 'displayProductsAdmin'] )->name('updatedPorductView');



// Route::get('/admin/dashboard', function () {
//     return view('admin.adminDashboard');
// })->name('admin.dashboard');


Route::post('/use-delivery', [DeliveryController::class, 'useDelivery'])
    ->name('use.delivery');


   

    Route::get('/admin/orders/{order_id}/pending/products', [OrderController::class, 'adminProductInfo'])
    ->name('admin.orders.products');

    Route::get('/admin/orders/pending', [OrderController::class, 'pendingOrders'])
    ->name('admin.orders.pending');

    Route::get('/admin/orders/shipped/products', [OrderController::class, 'shippedOrders'])
    ->name('admin.orders.shipped');

    Route::get('/admin/orders/cancelled/products', [OrderController::class, 'cancelledOrders'])
    ->name('admin.orders.cancelled');

    Route::get('/admin/orders/completed/products', [OrderController::class, 'completedOrders'])
    ->name('admin.orders.completed');

    Route::put('/admin/order/{id}/status', [OrderController::class, 'updateStatus'])
    ->name('admin.order.updateStatus');

    Route::delete('/order/delete/{id}', [OrderController::class, 'deleteOrder'])
    ->name('admin.order.delete');

    Route::get('/admin/dashboard', [OrderController::class, 'adminDashboard'])->name('admin.dashboard');

    Route::get('/admin/customer-list', [UserController::class, 'displayUserList'])->name('admin.customer.list');


    Route::post('/admin/customer-status/{id}', [UserController::class, 'updateUserStatus'])->name('admin.user.status');


   