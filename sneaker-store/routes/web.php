<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\DashbroadController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAuth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('categories', CategoryController::class);

Route::post('/comment', [CommentController::class, 'create'])->middleware('auth')->name('comment.create');

Route::get('/log-in', [UserController::class, 'formLogin'])->name('formLogin');
Route::post('/log-in', [UserController::class, 'login'])->name('login');

Route::get('/log-out', [UserController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/register', [UserController::class, 'formRegister'])->name('formRegister');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/{product}', [ProductController::class, 'show'])->name('product.show');
});

Route::prefix('/cart')->group(function () {
    Route::post('/', [CartController::class, 'addToCart'])->name('addToCart');
    Route::post('/{variantId}', [CartController::class, 'removeFromCart'])->name('removeFromCart');
    Route::put('/{variantId}', [CartController::class, 'updateCart'])->name('updateCart');
});

Route::prefix('/order')->group(function () {
    Route::get('/{orderId}', [OrderController::class, 'showOrder'])->name('showOrder');
    Route::post('/', [OrderController::class, 'createOrder'])->name('createOrder');
});

Route::get('/pay', [OrderItemController::class, 'pay'])->name('pay');

Route::prefix('/user')->middleware('auth')->group(function() {
    Route::get('/information', [UserController::class, 'information'])->name('information');
    Route::put('/change-password', [UserController::class, 'changePassword'])->name('changePassword');
    Route::get('/order', [UserController::class, 'orderList'])->name('orderList');
});

Route::prefix('/brand')->group(function() {
    Route::get('/{category}', [CategoryController::class, 'index'])->name('brand.index');
    Route::get('/', [CategoryController::class, 'search'])->name('brand.search');
});

Route::prefix('/admin')->middleware([CheckAuth::class])->group(function () {
    Route::get('/', [DashbroadController::class, 'dashbroad'])->name('admin.dashbroad');

    Route::resource('categories', AdminCategoryController::class);

    Route::resource('products', AdminProductController::class);
    Route::resource('size', SizeController::class);

    Route::get('/users', [AdminUserController::class, 'index'])->name('user.index');
    Route::get('/users/{user}/ban', [AdminUserController::class, 'banAccount'])->name('banAccount');
    Route::get('/users/{user}/unban', [AdminUserController::class, 'unbanAccount'])->name('unbanAccount');

    Route::prefix('/order')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('order.index');
        Route::post('/', [AdminOrderController::class, 'status'])->name('order.status');
        Route::get('/edit/{order}', [AdminOrderController::class, 'edit'])->name('order.edit');
        Route::put('/edit/{order}/payment-status', [AdminOrderController::class, 'paymentStatus'])->name('order.paymentStatus');
        Route::put('/edit/{order}', [AdminOrderController::class, 'update'])->name('order.update');
    });

    Route::get('/comments', [AdminCommentController::class, 'index'])->name('comment.index');
    Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('comment.destroy');
});
