<?php

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
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;
use App\Services\CustomerReportService;

Route::get('/', [LoginController::class, 'indexLogin'])->name('auth.login');
Route::post('/login_proses', [LoginController::class, 'proses'])->name('login_proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'Register'])->name('auth.register');
Route::post('/register', [LoginController::class, 'storeRegister'])->name('auth.register');

Route::middleware(['auth' , 'isLevel:admin'])->group(function () {
    Route::resource('dashboard', PageController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('transactions', TransactionController::class);
    Route::post('transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::put('/transactions/{id}/update-status', [TransactionController::class, 'updateStatus'])->name('transactions.update-status');
    Route::get('/pdf/transactions', [TransactionController::class, 'downloadPdf'])->name('transactions.pdf');
    Route::get('/pdf/customers', [CustomerController::class, 'downloadPdf'])->name('customers.pdf');
});

Route::middleware(['auth' , 'isLevel:admin,customer'])->group(function () {
    Route::resource('customers', CustomerController::class)->except(['show','edit', 'destroy']);
    Route::resource('products', ProductController::class)->except(['edit', 'destroy']);
    Route::resource('dashboard', PageController::class);
});

// Route::middleware(['auth' , 'isLevel:admin,customer'])->group(function () {
//     Route::resource('dashboard', PageController::class)->middleware('isLogin');
//     Route::resource('products', ProductController::class)->middleware('isLogin');
// });

// Route::resource('dashboard', PageController::class)->middleware('isLogin');
// Route::resource('customers', CustomerController::class)->middleware('isLogin');
// Route::resource('products', ProductController::class)->middleware('isLogin');
// Route::resource('orders', OrderController::class)->middleware('isLogin');

// Route::group(['middleware' => ['auth']], function () {
//     Route::resource('dashboard', PageController::class);
//     Route::resource('products', ProductController::class);
// });