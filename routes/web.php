<?php

use App\Http\Controllers\AddCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SoapController;
use App\Http\Controllers\SubCategoryController;

Route::get('/', [IndexController::class,'index'])->name('home');

// soap page route
Route::get('/soap',[SoapController::class,'view'])->name('soap');

// single product page route
Route::get('/product/{id}',[ProductController::class,'showSingleProduct'])->name('product');

//add to cart
Route::POST('/cart/add', [CartController::class, 'add'])->name('add.cart');

//add to cart
Route::get('/checkout', function(){
    return view('checkout');
} )->name('checkout');
//login route
route::get('/account/login', function () {
    return view('login');
})->name('login');

//login route
route::get('/account/signup', function () {
    return view('signup');
})->name('signup');


// all admin route
Route::prefix('admin/dashboard')->group(function () {
    //dash board
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    //view product add page
    route::get('/add-product', [ProductController::class,'index'])->name('add.product');

    // add product route
    route::POST('/add-product', [ProductController::class,'create'])->name('post.add.product');

    // view all product route
    route::get('/all-product', [ProductController::class,'view'])->name('view.product');
    // view all product route
    route::Delete('/all-product', [ProductController::class,'destroy'])->name('destroy.product');
    // product catgeory route
    route::get('/product-category', [AddCategoryController::class, 'viewProductCategory'])->name('product.category');

    // inserting the product category
    route::POST('/product-category', [AddCategoryController::class, 'createProductCategory'])->name('post.product.category');

    // deleting the product category
    route::Delete('/product-category', [AddCategoryController::class, 'deleteProductCategory'])->name('delete.product.category');

    // routing to sub catgeory
    route::get('/sub-category', [SubCategoryController::class, 'viewSubCategory'])->name('sub.category');
    // insert sub catgeory
    route::Post('/sub-category', [SubCategoryController::class, 'createSubCategory'])->name('post.sub.catgeory');
    //delete sub catgeory
    route::delete('/sub-category', [SubCategoryController::class, 'deleteSubCategory'])->name('delete.sub.category');
});


// under construction
Route::get('/under-construction', function () {
    return view('underConstruction');
});
