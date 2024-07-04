<?php

use App\Console\Commands\Permission;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Frontend\SslCommerzPaymentController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Frontend\CartController as FrontendCartController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\OrderController as FrontendOrderController;
use App\Http\Controllers\Frontend\ContactController as FrontendContactController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\CustomerController as FrontendCustomerController;

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

//website routes
Route::group(['middleware' => 'locale'], function () {

    Route::get('/change-lang/{locale}', [FrontendHomeController::class, 'changeLang'])->name('change.lang');


    Route::get('/', [FrontendHomeController::class, 'home'])->name('frontend.home');

    Route::get('/search/products', [FrontendHomeController::class, 'searchProduct'])->name('search.product');

    Route::get('/registration', [FrontendCustomerController::class, 'registration'])->name('customer.registration');
    Route::post('/reg-form-post', [FrontendCustomerController::class, 'store'])->name('registration.store');

    Route::get('/sendOtp', [FrontendCustomerController::class, 'sendOtp'])->name('sendOtp');
    Route::get('/verify-Otp', [FrontendCustomerController::class, 'showOtpVerificationForm'])->name('showOtp.VerificationForm');
    Route::post('/verify-Otp', [FrontendCustomerController::class, 'verifyOtp'])->name('verifyOtp');

    Route::get('/login', [FrontendCustomerController::class, 'login'])->name('customer.login');
    Route::post('/login-post', [FrontendCustomerController::class, 'loginPost'])->name('customer.loginPost');
    Route::get('/forget-password', [FrontendCustomerController::class, 'forgetPassword'])->name('forget.password');
    Route::post('/reset-link', [FrontendCustomerController::class, 'resetLink'])->name('reset.link');

    Route::get('/reset-password', [FrontendCustomerController::class, 'resetPasswordForm'])->name('reset.password.form');
    Route::post('/update-password/{token}', [FrontendCustomerController::class, 'updatePassword'])->name('update.password');



    Route::get('/single-product/{id}', [FrontendProductController::class, 'singleProductView'])->name('single.product');

    Route::get('/product-under-cagtegory/{cat_id}', [FrontendCategoryController::class, 'productsUnderCategory'])->name('products.under.category');


    Route::get('/sendEmail', [FrontendContactController::class, 'sendEmail'])->name('sendEmail');



    Route::middleware('auth:customerGuard')->group(function () {

        Route::get('/logout', [FrontendCustomerController::class, 'logout'])->name('customer.logout');

        Route::get('/profile', [FrontendCustomerController::class, 'profile'])->name('customer.profile');
        Route::get('/profile/edit/{id}', [FrontendCustomerController::class, 'profileEdit'])->name('profile.edit');
        Route::put('/profile/update/{id}', [FrontendCustomerController::class, 'profileUpdate'])->name('profile.update');

        //cart routes
        Route::get('/cart-view', [FrontendCartController::class, 'viewCart'])->name('cart.view');
        Route::get('/add-to-cart/{product_id}', [FrontendCartController::class, 'addToCart'])->name('add.to.Cart');
        Route::get('/clear-cart', [FrontendCartController::class, 'clearCart'])->name('clear.cart');
        Route::post('/update-cart', [FrontendCartController::class, 'updateCart'])->name('update.cart');
        Route::get('/delete-cartItem/{productId}', [FrontendCartController::class, 'deletecart'])->name('delete.cart');

        // order routes

        Route::get('/checkout', [FrontendOrderController::class, 'checkout'])->name('checkout.view');
        Route::post('/place-order', [FrontendOrderController::class, 'placeOrder'])->name('order.place');
        Route::get('/view-order/{id}', [FrontendOrderController::class, 'viewOrder'])->name('order.view');

        // SSLCOMMERZ Start
        Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
        Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

        Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
        Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

        Route::post('/success', [SslCommerzPaymentController::class, 'success']);
        Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
        Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

        Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
        //SSLCOMMERZ END


    });
});




//admin panel routes

Route::group(['prefix' => 'admin'], function () {

    Route::get('/login', [UserController::class, 'loginForm'])->name('admin.login');
    Route::post('/login-form-post', [UserController::class, 'loginPost'])->name('admin.login.post');

    Route::group(['middleware' => 'auth'], function () {
        Route::group(['middleware' => 'CheckAdmin'], function () {

            Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');

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

            Route::get('/order/list', [OrderController::class, 'list'])->name('order.list');


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
