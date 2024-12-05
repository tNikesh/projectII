<?php

use App\Http\Controllers\AddCategoryController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerOrder as ControllersCustomerOrder;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EsewaController;
use App\Http\Controllers\FaceController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SoapController;
use App\Http\Controllers\TrackOrder;
use App\Livewire\Admin\CustomerOrder;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;


Route::get('/', [IndexController::class,'index'])->name('home');

//  products category route
Route::get('/category/{id}',[ProductController::class, 'show'])->name('category.show');


// single product page route
Route::get('/product/{id}',[ProductController::class,'showSingleProduct'])->name('product');

//add to cart
Route::POST('/cart/add', [CartController::class, 'add'])->name('add.cart')->middleware('auth');

//add to cart
Route::get('/checkout', [CheckoutController::class,'index'])->name('checkout')->middleware('auth');

//add to cart
Route::POST('/checkout', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('auth');

// create customer review
route::post('/review/{id}',[ReviewController::class,'create'])->name('review')->middleware('auth');

//login route
route::get('/account/login',[AuthenticatedSessionController::class,'create'])->name('login');
route::post('/account/login',[AuthenticatedSessionController::class,'store'])->name('login.store');

// logout
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
->name('logout')->middleware('auth');

//signup route
route::get('/account/signup',[RegisteredUserController::class,'create'])->name('signup');
route::POST('/account/signup',[RegisteredUserController::class,'store'])->name('signup.store');

// -track-order-status
route::get('/track-order',[TrackOrder::class,'index'])->name('track.order')->middleware('auth');
// all admin route
Route::prefix('admin/dashboard')->group(function () {
    //dash board
    Route::get('/', [DashboardController::class,'index'])->name('admin.dashboard');

    //view product add page
    route::get('/add-product', [ProductController::class,'index'])->name('add.product');

    // add product route
    route::POST('/add-product', [ProductController::class,'create'])->name('post.add.product');

    // edit product
    route::get('/add-product/{id}', [ProductController::class,'edit'])->name('edit.product');
    // update product
    route::patch('/add-product/{id}', [ProductController::class,'update'])->name('update.product');


    // view all product route
    route::get('/all-product', [ProductController::class,'view'])->name('view.product');
    // view all product route
    // product catgeory route
    route::get('/product-category', [AddCategoryController::class, 'viewProductCategory'])->name('product.category');

    // inserting the product category
    route::POST('/product-category', [AddCategoryController::class, 'createProductCategory'])->name('post.product.category');

    // deleting the product category
    route::patch('/product-category', [AddCategoryController::class, 'update'])->name('update.category');

     route::get('/review',[ReviewController::class,'view'])->name('view.review');
     route::get('/review/{id}',[ReviewController::class,'destroy'])->name('delete.review');
    // customer order
    route::get('/order',[ControllersCustomerOrder::class,'index'])->name('customer.order');


});


// under construction
Route::get('/under-construction', function () {
    return view('underConstruction');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

route::get('/success',[EsewaController::class,'success'])->name('esewa.success');
route::get('/failure',[EsewaController::class,'failure'])->name('esewa.failure');

require __DIR__.'/auth.php';
