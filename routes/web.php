<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* Products Routes */
Route::get('/boutique', [ProductController::class,'index'])->name('products.index');
Route::get('/boutique/{slug}', [ProductController::class,'show'])->name('products.show');

Auth::routes();

/* Cart Routes */
Route::group(['middleware' => ['auth']], function(){
    Route::get('/panier', [CartController::class,'index'])->name('cart.index');
    Route::post('/panier/ajouter', [CartController::class,'store'])->name('cart.store');
    Route::patch('/panier/{rowId}', [CartController::class,'update'])->name('cart.update');
    Route::delete('/panier/{rowId}', [CartController::class,'destroy'])->name('cart.destroy');

    /* Checkout Routes */
    Route::get('/paiement', [CheckoutController::class,'index'])->name('checkout.index');
    Route::post('/paiement', [CheckoutController::class,'store'])->name('checkout.store');
    Route::get('/merci', [CheckoutController::class,'thankYou'])->name('checkout.thankYou');
    Route::get('/pdf/{id}', [CheckoutController::class,'pdf'])->name('checkout.pdf');

});


Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
