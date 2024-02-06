<?php

use App\Console\Commands\Permission;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\CustomerController as FrontendCustomerController;
use App\Http\Controllers\Frontend\OrderController as FrontendOrderController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\CartController as FrontendCartController;
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

//wesite routes

Route::get('/', [FrontendHomeController::class, 'home'])->name('frontend.home');

Route::get('/search/products',[FrontendHomeController::class,'searchProduct'])->name('search.product');

Route::get('/registration', [FrontendCustomerController::class, 'registration'])->name('customer.registration');
Route::post('/reg-form-post', [FrontendCustomerController::class, 'store'])->name('registration.store');

Route::get('/login', [FrontendCustomerController::class, 'login'])->name('customer.login');
Route::post('/login-post', [FrontendCustomerController::class, 'loginPost'])->name('customer.loginPost');

Route::get('/single-product/{id}', [FrontendProductController::class, 'singleProductView'])->name('single.product');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [FrontendCustomerController::class, 'logout'])->name('customer.logout');

    Route::get('/profile', [FrontendCustomerController::class, 'profile'])->name('customer.profile');
    Route::get('/profile/edit/{id}',[FrontendCustomerController::class,'profileEdit'])->name('profile.edit');
    Route::put('/profile/update/{id}',[FrontendCustomerController::class,'profileUpdate'])->name('profile.update');
});
//admin panel routes

Route::group(['prefix' => 'admin'], function () {

    Route::get('/login', [UserController::class, 'loginForm'])->name('admin.login');
    Route::post('/login-form-post', [UserController::class, 'loginPost'])->name('admin.login.post');

    Route::group(['middleware' => 'auth'], function () {
        Route::group(['middleware' => 'CheckAdmin'], function () {

            Route::get('/home', [HomeController::class, 'home'])->name('dashboard');

            Route::get('/logout', [UserController::class, 'logOut'])->name('admin.logout');

            Route::get('/users/list', [UserController::class, 'list'])->name('users.list');
            Route::get('/create/user', [UserController::class, 'create'])->name('create.user');
            Route::post('/store/user', [UserController::class, 'store'])->name('store.user');
            Route::get('/user/view/{id}', [UserController::class, 'view'])->name('user.view');
            Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
            Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
            Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

            Route::get('/category/list', [CategoryController::class, 'list'])->name('category.list');
            Route::get('/create/category', [CategoryController::class, 'create'])->name('create.category');
            Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
            Route::get('/category/view/{id}', [CategoryController::class, 'view'])->name('category.view');
            Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
            Route::get('/category/delte/{id}', [CategoryController::class, 'delete'])->name('category.delete');

            Route::get('/brand/list', [BrandController::class, 'list'])->name('brand.list');
            Route::get('/brand/create', [BrandController::class, 'create'])->name('brand.create');
            Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
            Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
            Route::put('/brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
            Route::get('/brand/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');

            Route::get('/product/list', [ProductController::class, 'list'])->name('product.list');
            Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
            Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
            Route::get('/product/view/{id}', [ProductController::class, 'view'])->name('product.view');
            Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
            Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
            Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

            Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
                Route::get('/list', [RoleController::class, 'list'])->name('list');
                Route::get('/create', [RoleController::class, 'create'])->name('create');
                Route::post('/store', [RoleController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
                Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('delete');
            });

            Route::get('/permission-assign/{role_id}', [PermissionController::class, 'permission'])->name('role.assign');
            Route::post('/permission-assign/{role_id}', [PermissionController::class, 'assignPermission'])->name('assign.permission');
            });
    });
});



