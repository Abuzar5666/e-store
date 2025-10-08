<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\mailSend;
use App\Http\Controllers\User\BuyProductController;
use App\Http\Controllers\Admin\BuyProductController as AdminBuyController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\FavoriteProductController;
use App\Http\Middleware\authenticate;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\notAuthenticate;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\form;

// Home page
Route::get('/',[HomeController::class,'home'])->name('homePage');
Route::get('home/products',[HomeController::class,'findProductPage'])->name('home.product');
Route::get('home/productDetail/{id}',[HomeController::class,'productDetailPage'])->name('home.productDetail');

// can not access these route if user login
Route::middleware('auth')->group(function(){
    Route::get('account/login',[AccountController::class,'login'])->name('account.login');
    Route::post('account/loginProcess',[AccountController::class,'loginProcess'])->name('account.loginProcess');
    Route::get('account/showRegister',[AccountController::class,'showRegister'])->name('account.showRegister');
    Route::post('account/registerProcess',[AccountController::class,'registerProcess'])->name('account.registerProcess');
});

// can not access these route if user not login
Route::middleware('notAuth')->group(function(){
    Route::get('account/logout',[AccountController::class,'logout'])->name('account.logout');
    Route::get('account/showAccount',[AccountController::class,'showAccount'])->name('account.showAccount');
    Route::post('account/updateProfile',[AccountController::class,'updateProfile'])->name('account.updateProfile');
    Route::post('account/updatePassword',[AccountController::class,'updatePassword'])->name('account.updatePasswrod');
    Route::post('account/updateImage',[AccountController::class,'updateImage'])->name('account.updateImage');


    // only admin can access this route
    Route::middleware(isAdmin::class)->group(function(){

        Route::get('admin/main',[AdminController::class,'mainPage'])->name('admin.main');
        
        // this is product category CRUD
        Route::get('category/index',[CategoryController::class,'index'])->name('category.index');
        Route::get('category/create',[CategoryController::class,'create'])->name('category.create');
        Route::post('category/store',[CategoryController::class,'store'])->name('category.store');
        Route::get('category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
        Route::post('category/update/{id}',[CategoryController::class,'update'])->name('category.update');
        Route::delete('category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
        
        // this is product CRUD
        Route::get('product/index',[ProductController::class,'index'])->name('product.index');
        Route::get('product/create',[ProductController::class,'create'])->name('product.create');
        Route::post('product/store',[ProductController::class,'store'])->name('product.store');
        Route::get('product/show/{id}',[ProductController::class,'show'])->name('product.show');
        Route::get('product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
        Route::post('product/update/{id}',[ProductController::class,'update'])->name('product.update');
        Route::delete('product/delete/{id}',[ProductController::class,'delete'])->name('product.delete');

          // show all buy product in buy products in admin page
        Route::get('admin/buy/product',[AdminBuyController::class,'index'])->name('admin.buy.product.index');
    });

    // favortie product
    Route::get('home/favoriteProduct/{id}',[FavoriteProductController::class,'favoriteProduct'])->name('home.favoriteProduct');
    Route::get('home/favorite/index',[FavoriteProductController::class,'index'])->name('home.favorite.index');
    Route::delete('home/favorite/delete/{id}',[FavoriteProductController::class,'delete'])->name('home.favorite.delete');

    // Cart product
    Route::get('home/cart/index',[CartController::class,'index'])->name('cart.index');
    Route::post('home/cart/store',[CartController::class,'store'])->name('cart.store');
    Route::get('home/cart/delete/{id}',[CartController::class,'delete'])->name('cart.delete');
    Route::put('home/cart/update/{id}',[CartController::class,'update'])->name('cart.update');
    
    // Order process
    Route::get('checkout/index',[CheckoutController::class,'index'])->name('checkout.index');
    Route::post('checkout/store',[CheckoutController::class,'store'])->name('checkout.store');

    // Buy product user
    Route::get('buy/product',[BuyProductController::class,'index'])->name('buy.product.index');

  
    
});
