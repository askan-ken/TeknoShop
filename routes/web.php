<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Models\Product;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

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
    return view('landing', [
        'products' => Product::orderBy('id', 'DESC')->limit(4)->get()
    ]);
});

Route::post('/products/cart/{product}', [CartController::class, 'addCart'])->middleware('is_buyer');

Route::get('/products/{product}', function (Product $product) {
    return view('detail-product', [
        'title' => $product->name,
        'product' => $product
    ]);
});

Route::get('/products', function () {
    return view('products', [
        'title' => 'Data Produk',
        'products' => Product::orderBy('id', 'DESC')->get()
    ]);
});

Route::post('/login', [AuthController::class, 'loginAction'])->middleware('guest');
Route::get('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/register', [AuthController::class, 'registerAction'])->middleware('guest');
Route::get('/register', [AuthController::class, 'register'])->middleware('guest');
Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/profile', [AuthController::class, 'buyerProfile'])->middleware('is_buyer');
Route::put('/profile', [AuthController::class, 'buyerProfileAction'])->middleware('is_buyer');
Route::get('/change-password', [AuthController::class, 'buyerChangePassword'])->middleware('is_buyer');
Route::put('/change-password', [AuthController::class, 'changePasswordAction'])->middleware('is_buyer');
Route::get('/cart', [CartController::class, 'index'])->middleware('is_buyer');
Route::post('/cart', [CartController::class, 'create'])->middleware('is_buyer');
Route::post('/checkout', [CartController::class, 'store'])->middleware('is_buyer');
Route::resource('/transactions', TransactionController::class)->except(['edit', 'destroy'])->middleware('is_buyer');
Route::patch("/cancel-transaction/{id}", [TransactionController::class, 'autoCancel']);


Route::get('/dashboard', [AuthController::class, 'index'])->middleware('is_administrator');
Route::resource('/dashboard/products', ProductController::class)->middleware('is_administrator');
Route::resource('/dashboard/users/buyers', BuyerController::class)->middleware('is_administrator');
Route::resource('/dashboard/users/administrators', AdministratorController::class)->middleware('is_administrator');
Route::resource('/dashboard/purchases', PurchaseController::class)->except(['create', 'store', 'delete', 'edit'])->middleware('is_administrator');
Route::get('/dashboard/reports', [ReportController::class, 'index'])->middleware('is_administrator');
Route::get('/dashboard/reports/print', [ReportController::class, 'print'])->middleware('is_administrator');
Route::get('/dashboard/profile', [AuthController::class, 'administratorProfile'])->middleware('is_administrator');
Route::put('/dashboard/profile', [AuthController::class, 'administratorProfileAction'])->middleware('is_administrator');
Route::get('/dashboard/change-password', [AuthController::class, 'administratorChangePassword'])->middleware('is_administrator');
Route::put('/dashboard/change-password', [AuthController::class, 'changePasswordAction'])->middleware('is_administrator');

// Routes Category main
Route::get('/dashboard/categories', [CategoryController::class, 'index']);
Route::post('/dashboard/categories',[CategoryController::class, 'store'])->middleware('is_administrator');
Route::get('/dashboard/categories/{id}', [CategoryController::class, 'show'])->middleware('is_administrator');
Route::put('/dashboard/categories/{id}', [CategoryController::class, 'update'])->middleware('is_administrator');
Route::delete('/dashboard/categories/{id}', [CategoryController::class, 'destroy'])->middleware('is_administrator');

// Routes Pelanggan Kategori
Route::get('/kategori', [CategoryController::class, 'getProductByCategory']);