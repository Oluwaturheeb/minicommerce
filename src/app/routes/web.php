<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrdersController;

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


Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('single-product/{slug}', [IndexController::class, 'singleProduct']);

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/cart', [CartController::class, 'index'])->name('cart');
  Route::post('add-to-cart', [CartController::class, 'store'])->name('add-to-cart');
  Route::get('/cart/delete/{item}', [CartController::class, 'destroy'])->name('checkout');
  Route::get('/checkout', [CartController::class, 'create'])->name('checkout');
  Route::post('/process-order', [OrdersController::class, 'store'])->name('process-order');
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
