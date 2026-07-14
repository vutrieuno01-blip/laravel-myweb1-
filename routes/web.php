<?php

use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/demo', [DemoController::class, 'index']);
Route::get('/demo2', [DemoController::class, 'index2']);
Route::get('/demo3', [DemoController::class, 'index3']);
Route::get('/demo4/{id}', [DemoController::class, 'index4']);
Route::get('/demo5/{id?}', [DemoController::class, 'index5']);
Route::get('/demo6/{parram1}/{parram2}', [DemoController::class, 'index6']);

Route::get('/test1', [ProductController::class, 'test1']);
Route::get('/test2', [ProductController::class, 'test2']);


// Provide a global 'login' route used by Laravel's auth middleware
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::prefix('admin')->name('admin.')->group(function () {

    // Auth routes (login, forgot password)
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotpassword');
    Route::post('/forgot-password', [AuthController::class, 'postForgotPassword'])->name('postForgotPassword');

    // Routes protected by authentication
    Route::middleware('auth')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/changepass', [AuthController::class, 'changePassword'])->name('changepass');
        Route::post('/changepass', [AuthController::class, 'postChangePassword'])->name('postChangePass');

        Route::resource('categories', CategoryController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('posts', PostController::class);
        Route::resource('products', ProductController::class);
        Route::resource('users', UserController::class);
    });
});
