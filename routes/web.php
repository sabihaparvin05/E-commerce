<?php

use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UserController;
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

//admin panel routes

Route::group(['prefix' => 'admin'], function () {

    Route::get('/login', [UserController::class, 'loginForm'])->name('admin.login');
    Route::post('/login-form-post', [UserController::class, 'loginPost'])->name('admin.login.post');

    Route::group(['middleware' => 'auth'], function () {
        Route::group(['middleware' => 'CheckAdmin'], function () {

            Route::get('/logout', [UserController::class, 'logOut'])->name('admin.logout');
            
            Route::get('/home', [HomeController::class, 'home'])->name('dashboard');

            Route::get('/users/list', [UserController::class, 'list'])->name('users.list');
            Route::get('/create/user', [UserController::class, 'create'])->name('create.user');
            Route::post('/store/user', [UserController::class, 'store'])->name('store.user');

            Route::get('/category/list', [CategoryController::class, 'list'])->name('category.list');
            Route::get('/create/category', [CategoryController::class, 'create'])->name('create.category');
            Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');

            Route::get('/brand/list', [BrandController::class, 'list'])->name('brand.list');
            Route::get('/brand/create', [BrandController::class, 'create'])->name('brand.create');
            Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');

            Route::get('/product/list', [ProductController::class, 'list'])->name('product.list');
            Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
            Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
        });
    });
});



//wesite routes