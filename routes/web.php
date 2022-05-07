<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\BrandProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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

// Frontend
Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'index']);

Route::post('/search', [HomeController::class, 'search']);

// List Product
Route::get('/category/{category_id}', [ProductController::class, 'show_category']);

Route::get('/brand/{brand_id}', [ProductController::class, 'show_brand']);

Route::get('/product-details/{product_id}', [ProductController::class, 'product_details']);

//Cart

Route::post('/add-to-cart',[CartController::class, 'add_to_cart']);

Route::get('/show-cart',[CartController::class, 'show_cart']);

Route::get('/delete-to-cart/{rowId}',[CartController::class, 'delete_to_cart']);

Route::post('/update-quantity',[CartController::class, 'update_quantity']);

// Backend
Route::get('/admin', [AdminController::class, 'index']);

Route::get('/admin-logout', [AdminController::class, 'logout']);

Route::post('/check',[AdminController::class, 'check']);

Route::get('/dashboard', [AdminController::class, 'dashboard']);

//Category Product

Route::get('/add-category-product', [CategoryProductController::class, 'add_category_product']);

Route::get('/all-category-product', [CategoryProductController::class, 'all_category_product']);

Route::post('/save-category-product', [CategoryProductController::class, 'save_category_product']);

Route::get('/edit-category-product/{category_product_id}', [CategoryProductController::class, 'edit_category_product']);

Route::post('/update-category-product/{category_product_id}', [CategoryProductController::class, 'update_category_product']);

Route::get('/delete-category-product/{category_product_id}', [CategoryProductController::class, 'delete_category_product']);

Route::get('/unactive-category-product/{category_product_id}', [CategoryProductController::class, 'unactive_category_product']);

Route::get('/active-category-product/{category_product_id}', [CategoryProductController::class, 'active_category_product']);

// Brand product

Route::get('/add-brand-product', [BrandProductController::class, 'add_brand_product']);

Route::get('/all-brand-product', [BrandProductController::class, 'all_brand_product']);

Route::post('/save-brand-product', [BrandProductController::class, 'save_brand_product']);

Route::get('/edit-brand-product/{brand_product_id}', [BrandProductController::class, 'edit_brand_product']);

Route::post('/update-brand-product/{brand_product_id}', [BrandProductController::class, 'update_brand_product']);

Route::get('/delete-brand-product/{brand_product_id}', [BrandProductController::class, 'delete_brand_product']);

Route::get('/unactive-brand-product/{brand_product_id}', [BrandProductController::class, 'unactive_brand_product']);

Route::get('/active-brand-product/{brand_product_id}', [BrandProductController::class, 'active_brand_product']);

// Brand product

Route::get('/add-product', [ProductController::class, 'add_product']);

Route::get('/all-product', [ProductController::class, 'all_product']);

Route::post('/save-product', [ProductController::class, 'save_product']);

Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);

Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);

Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);

Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);

Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);

//Checkout
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);

Route::post('/add-customer', [CheckoutController::class, 'add_customer']);

Route::get('/checkout', [CheckoutController::class, 'checkout']);

Route::post('/save-shipping', [CheckoutController::class, 'save_shipping']);

Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);

Route::post('/login-customer', [CheckoutController::class, 'login_customer']);

Route::get('/payment', [CheckoutController::class, 'payment']);

Route::post('/order-place', [CheckoutController::class, 'order_place']);

//Order

Route::get('/manage-order', [CheckoutController::class, 'manage_order']);

Route::get('/view-order/{order_id}', [CheckoutController::class, 'view_order']);

Route::get('/delete-order/{order_id}', [CheckoutController::class, 'delete_order']);

