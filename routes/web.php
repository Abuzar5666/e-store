<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Middleware\authenticate;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\notAuthenticate;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\form;

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
    });

});
