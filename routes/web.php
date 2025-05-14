<?php

use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Store\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/code', function () {
//     return bcrypt('168108');
// });



Route::get('/', [HomeAdminController::class, 'index'])->name('home');

Route::get('/login-page', [CustomerController::class, 'customerLogin'])
    ->name('customerLogin');
Route::post('/login-page', [CustomerController::class, 'loginCustomerProcess'])
    ->name('loginCustomerProcess');
Route::get('/logout-page', [CustomerController::class, 'logoutCustomer'])
    ->name('logoutCustomer');

Route::get('/register', [CustomerController::class, 'register'])
    ->name('register');
Route::post('/register', [CustomerController::class, 'registerProcess'])
    ->name('registerProcess');

Route::get('/login/forgot-password', [\App\Http\Controllers\ForgotPasswordController::class, 'showForgotPasswordForm'])
    ->name('password.request');
Route::post('/login/forgot-password', [\App\Http\Controllers\ForgotPasswordController::class, 'sendResetPass'])
    ->name('password.email');
Route::get('/login/reset-password', [\App\Http\Controllers\ForgotPasswordController::class, 'showResetPasswordForm'])
    ->name('password.reset');
Route::post('/login/reset-password', [\App\Http\Controllers\ForgotPasswordController::class, 'verifyPassword'])
    ->name('password.update');


Route::get('/checkout', [\App\Http\Controllers\OrderController::class, 'checkout'])
    ->name('checkout');
Route::post('/checkout', [\App\Http\Controllers\OrderController::class, 'store'])
    ->name('storeCheckout');
Route::get('/checkout/success', [\App\Http\Controllers\OrderController::class, 'successCheckout'])
    ->name('successCheckout');

Route::get('/order-history', [\App\Http\Controllers\OrderController::class, 'orderHistory'])
    ->name('orderHistory');
Route::get('/order-history/{order}', [\App\Http\Controllers\OrderController::class, 'orderDetail'])
    ->name('orderDetail');
Route::post('/order-history/{order}', [\App\Http\Controllers\OrderController::class, 'cancelOrder'])
    ->name('order.cancel');

Route::get('/orders/filter', [\App\Http\Controllers\OrderController::class, 'filterOrders'])
    ->name('orders.filter');

Route::get('/home', [HomeController::class, 'index'])->name('homePage');
Route::get('/shop', [HomeController::class,'shop'])->name('shop');
Route::get('/profile', [CustomerController::class, 'index'])
    ->name('profile');
Route::post('/profile/update/{customer}', [CustomerController::class, 'update'])
    ->name('profile.update');

Route::get('/shop/product-detail/{product}', [HomeController::class, 'productDetail'])
    ->name('products.products-detail');


Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::post('/cart/apply-coupon', [OrderController::class, 'applyCoupon'])->name('cart.apply_coupon');
Route::get('/add-to-cart/{product}', [\App\Http\Controllers\ProductController::class, 'addToCart'])
    ->name('products.add-to-cart');
Route::post('/add-to-cart/{product}', [\App\Http\Controllers\ProductController::class, 'addToCartPost'])
    ->name('products.add-to-cart.post');
Route::put('/add-to-cart', [\App\Http\Controllers\ProductController::class, 'updateCart'])
    ->name('products.update_cart');
Route::get('/remove-cart/{product}', [\App\Http\Controllers\ProductController::class, 'removeProduct'])
    ->name('products.remove_a_product');
Route::get('/remove-cart', [\App\Http\Controllers\ProductController::class, 'deleteAllProducts'])
    ->name('products.remove_cart');

Route::get('/login', [\App\Http\Controllers\AdminController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AdminController::class, 'loginProcess'])->name('loginProcess');
Route::get('/logout', [\App\Http\Controllers\AdminController::class, 'logout'])->name('logout');



Route::middleware('adminLoginMiddleware')->prefix('admin')->group(function () {
    Route::prefix('/categories')->group(function () {
        Route::get('/', [\App\Http\Controllers\CategoryController::class, 'index'])
            ->name('categories.index');
        Route::get('/create', [\App\Http\Controllers\CategoryController::class, 'create'])
            ->name('categories.create');

        Route::post('/store', [\App\Http\Controllers\CategoryController::class, 'store'])
            ->name('categories.store');

        Route::get('/edit/{category}', [\App\Http\Controllers\CategoryController::class, 'edit'])
            ->name('categories.edit');
        Route::put('/edit/{category}', [\App\Http\Controllers\CategoryController::class, 'update'])
            ->name('categories.update');
        Route::delete('/{category}', [\App\Http\Controllers\CategoryController::class, 'destroy'])
            ->name('categories.destroy');
    });

    Route::prefix('/images')->group(function () {
        Route::get('/', [ImageController::class, 'index'])
            ->name('images.index');
        Route::get('/create', [ImageController::class, 'create'])
            ->name('images.create');
        Route::post('/store', [ImageController::class, 'store'])
            ->name('images.store');

    });

    Route::prefix('/brands')->group(function () {
        Route::get('/', [\App\Http\Controllers\BrandController::class, 'index'])
            ->name('brands.index');
        Route::get('/create', [\App\Http\Controllers\BrandController::class, 'create'])
            ->name('brands.create');

        Route::post('/store', [\App\Http\Controllers\BrandController::class, 'store'])
            ->name('brands.store');

        Route::get('/edit/{brand}', [\App\Http\Controllers\BrandController::class, 'edit'])
            ->name('brands.edit');
        Route::put('/edit/{brand}', [\App\Http\Controllers\BrandController::class, 'update'])
            ->name('brands.update');
        Route::delete('/{brand}', [\App\Http\Controllers\BrandController::class, 'destroy'])
            ->name('brands.destroy');
    });

    Route::prefix('/colors')->group(function () {
        Route::get('/', [\App\Http\Controllers\ColorController::class, 'index'])
            ->name('colors.index');
        Route::get('/create', [\App\Http\Controllers\ColorController::class, 'create'])
            ->name('colors.create');

        Route::post('/store', [\App\Http\Controllers\ColorController::class, 'store'])
            ->name('colors.store');

        Route::get('/edit/{color}', [\App\Http\Controllers\ColorController::class, 'edit'])
            ->name('colors.edit');
        Route::put('/edit/{color}', [\App\Http\Controllers\ColorController::class, 'update'])
            ->name('colors.update');
        Route::delete('/{color}', [\App\Http\Controllers\ColorController::class, 'destroy'])
            ->name('colors.destroy');
    });

    Route::prefix('/sizes')->group(function () {
        Route::get('/', [\App\Http\Controllers\SizeController::class, 'index'])
            ->name('sizes.index');
        Route::get('/create', [\App\Http\Controllers\SizeController::class, 'create'])
            ->name('sizes.create');

        Route::post('/store', [\App\Http\Controllers\SizeController::class, 'store'])
            ->name('sizes.store');

        Route::get('/edit/{size}', [\App\Http\Controllers\SizeController::class, 'edit'])
            ->name('sizes.edit');
        Route::put('/edit/{size}', [\App\Http\Controllers\SizeController::class, 'update'])
            ->name('sizes.update');
        Route::delete('/{size}', [\App\Http\Controllers\SizeController::class, 'destroy'])
            ->name('sizes.destroy');
    });

    Route::prefix('/materials')->group(function () {
        Route::get('/', [\App\Http\Controllers\MaterialController::class, 'index'])
            ->name('materials.index');
        Route::get('/create', [\App\Http\Controllers\MaterialController::class, 'create'])
            ->name('materials.create');

        Route::post('/store', [\App\Http\Controllers\MaterialController::class, 'store'])
            ->name('materials.store');

        Route::get('/edit/{material}', [\App\Http\Controllers\MaterialController::class, 'edit'])
            ->name('materials.edit');
        Route::put('/edit/{material}', [\App\Http\Controllers\MaterialController::class, 'update'])
            ->name('materials.update');
        Route::delete('/{material}', [\App\Http\Controllers\MaterialController::class, 'destroy'])
            ->name('materials.destroy');
    });

    Route::prefix('/origins')->group(function () {
        Route::get('/', [\App\Http\Controllers\OriginController::class, 'index'])
            ->name('origins.index');
        Route::get('/create', [\App\Http\Controllers\OriginController::class, 'create'])
            ->name('origins.create');

        Route::post('/store', [\App\Http\Controllers\OriginController::class, 'store'])
            ->name('origins.store');

        Route::get('/edit/{origin}', [\App\Http\Controllers\OriginController::class, 'edit'])
            ->name('origins.edit');
        Route::put('/edit/{origin}', [\App\Http\Controllers\OriginController::class, 'update'])
            ->name('origins.update');
        Route::delete('/{origin}', [\App\Http\Controllers\OriginController::class, 'destroy'])
            ->name('origins.destroy');
    });

    Route::prefix('/users')->group(function () {
        Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])
            ->name('users.index');
        Route::get('/create', [\App\Http\Controllers\AdminController::class, 'create'])
            ->name('users.create');
        Route::post('/store', [\App\Http\Controllers\AdminController::class, 'store'])
            ->name('users.store');

        Route::get('/edit/{admin}', [\App\Http\Controllers\AdminController::class, 'edit'])
            ->name('users.edit');

        Route::put('/edit/{admin}', [\App\Http\Controllers\AdminController::class, 'update'])
            ->name('users.update');

        Route::delete('/{admin}', [\App\Http\Controllers\AdminController::class, 'destroy'])
            ->name('users.destroy');
    });

    Route::prefix('/products')->group(function () {
        Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])
            ->name('products.index');
        Route::get('/create', [\App\Http\Controllers\ProductController::class, 'create'])
            ->name('products.create');
        Route::post('/store', [\App\Http\Controllers\ProductController::class, 'store'])
            ->name('products.store');
        Route::get('/edit/{product}', [\App\Http\Controllers\ProductController::class, 'edit'])
            ->name('products.edit');
        Route::put('/edit/{product}', [\App\Http\Controllers\ProductController::class, 'update'])
            ->name('products.update');
        Route::delete('/{product}', [\App\Http\Controllers\ProductController::class, 'destroy'])
            ->name('products.destroy');
        Route::get('/show/{product}', [\App\Http\Controllers\ProductController::class, 'show'])
            ->name('products.show');

    });

    Route::prefix('/orders')->group(function (){
        Route::get('/',[HomeAdminController::class, 'orderManage'])
            ->name('orders');
        Route::get('/order-item/{order}',[HomeAdminController::class, 'orderItem'])
            ->name('orders.items');
        Route::post('/update-status/{order}',[HomeAdminController::class, 'updateStatusOrder'])
            ->name('orders.updateOrder');
        Route::post('/orders/delete/{order}', [HomeAdminController::class, 'deleteOrder'])
            ->name('orders.delete');
        Route::get('/orders/filter-order/{status}', [HomeAdminController::class, 'filterOrders'])
            ->name('orders.filterOrder');
    });


});
