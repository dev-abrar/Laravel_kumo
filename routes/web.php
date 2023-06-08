<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponComtroller;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PasswordrResetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Front End
Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/Product/Details/{slug}', [FrontController::class, 'details'])->name('details');
Route::get('/cart', [FrontController::class, 'cart'])->name('cart');
Route::get('/wishlist', [FrontController::class, 'wishlist'])->name('wishlist');
Route::post('/getSize', [FrontController::class, 'getSize']);

// Others
Auth::routes();
Route::get('/admin/logout', [HomeController::class, 'admin_logout'])->name('admin.logout');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Users
Route::get('/users', [UserController::class, 'users'])->name('users')->middleware('auth');
Route::get('/users/delete/{user_id}', [UserController::class, 'user_delete'])->name('user.delete')->middleware('auth');
Route::get('/users/edit', [UserController::class, 'user_edit'])->name('user.edit')->middleware('auth');
Route::post('/users/update', [UserController::class, 'user_update'])->name('user.update')->middleware('auth');
Route::post('/users/update/password', [UserController::class, 'update_password'])->name('update.password')->middleware('auth');
Route::post('/users/update/photo', [UserController::class, 'update_photo'])->name('update.photo')->middleware('auth');

// Category
Route::get('/category', [CategoryController::class, 'category'])->name('category')->middleware('auth');
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store')->middleware('auth');
Route::get('/category/delete/{category_id}', [CategoryController::class, 'category_delete'])->name('category.delete')->middleware('auth');
Route::get('/category/edit/{category_id}', [CategoryController::class, 'category_edit'])->name('category.edit')->middleware('auth');
Route::post('/category/update', [CategoryController::class, 'category_update'])->name('category.update')->middleware('auth');
Route::get('/category/restore/{category_id}', [CategoryController::class, 'category_restore'])->name('category.restore')->middleware('auth');
Route::get('/category/permanent/delete/{category_id}', [CategoryController::class, 'category_per_delete'])->name('category.per_delete')->middleware('auth');
Route::post('/category/check/delete', [CategoryController::class, 'check_delete'])->name('check.delete')->middleware('auth');
Route::post('/category/check/restore', [CategoryController::class, 'check_restore'])->name('check.restore')->middleware('auth');

// Sub Category
Route::get('/subcategory', [SubcategoryController::class, 'subcategory'])->name('subcategory')->middleware('auth');
Route::post('/subcategory/store', [SubcategoryController::class, 'subcategory_store'])->name('subcategory.store')->middleware('auth');
Route::get('/subcategory/delete/{sub_id}', [SubcategoryController::class, 'sub_delete'])->name('sub.delete')->middleware('auth');
Route::get('/subcategory/restore/{sub_id}', [SubcategoryController::class, 'sub_restore'])->name('sub.restore')->middleware('auth');
Route::get('/subcategory/pdelete/{sub_id}', [SubcategoryController::class, 'sub_pdelete'])->name('sub.pdelete')->middleware('auth');
Route::post('/subcategory/subcategory_delete', [SubcategoryController::class, 'subcheck_delete'])->name('subcheck.delete')->middleware('auth');
Route::post('/subcategory/subcategory_restore', [SubcategoryController::class, 'checkall_restore'])->name('checkall.restore')->middleware('auth');
Route::get('/subcategory/edit/{sub_cat_id}', [SubcategoryController::class, 'sub_edit'])->name('sub.edit')->middleware('auth');
Route::post('/subcategory/update', [SubcategoryController::class, 'subcategory_update'])->name('subcategory.update')->middleware('auth');

// Brands
Route::get('/Brand', [BrandController::class, 'brand'])->name('brand')->middleware('auth');
Route::post('/Brand/store', [BrandController::class, 'brand_store'])->name('brand.store')->middleware('auth');
Route::get('/Brand/delete/{brand_id}', [BrandController::class, 'brand_delete'])->name('brand.delete')->middleware('auth');


// Product
Route::get('/Product', [ProductController::class, 'product'])->name('product')->middleware('auth');
Route::get('/Product/List', [ProductController::class, 'product_list'])->name('product.list')->middleware('auth');
Route::get('/Product/Edit/', [ProductController::class, 'pro_edit'])->name('edit.product')->middleware('auth');
Route::get('/Product/Delete/{product_id}', [ProductController::class, 'product_delete'])->name('product.delete')->middleware('auth');
Route::post('/getSubcategory', [ProductController::class, 'getSubcategory']); 
Route::post('/Product/store', [ProductController::class, 'product_store'])->name('product.store')->middleware('auth');
Route::post('/Product/update', [ProductController::class, 'product_update'])->name('product.update')->middleware('auth');


// Variation
Route::get('/variation', [InventoryController::class, 'variation'])->name('variation')->middleware('auth');
Route::post('/color/store', [InventoryController::class, 'color_store'])->name('color.store')->middleware('auth');
Route::get('/color/delete/{color_id}', [InventoryController::class, 'color_delete'])->name('color.delete')->middleware('auth');
Route::get('/size/delete/{size_id}', [InventoryController::class, 'size_delete'])->name('size.delete')->middleware('auth');

// Inventroy
Route::get('/Product/Inventory/{product_id}', [ProductController::class, 'product_inventory'])->name('product.inventory')->middleware('auth');
Route::get('/Product/Inventory/Delete/{product_id}', [ProductController::class, 'inventory_delete'])->name('inventory.delete')->middleware('auth');
Route::post('/Product/Inventory/Store', [ProductController::class, 'inventory_store'])->name('inventory.store')->middleware('auth');


// Cart
Route::post('/cart/store', [CartController::class, 'cart_store'])->name('cart.store');
Route::get('/cart/delete/{cart_id}', [CartController::class, 'cart_delete'])->name('cart.delete');
Route::post('/cart/update', [CartController::class, 'cart_update'])->name('cart.update');
Route::get('/wish/delete/{wish_id}', [CartController::class, 'wish_delete'])->name('wish.delete');

// Coupon
Route::get('/coupon', [CouponComtroller::class, 'coupon'])->name('coupon');
Route::get('/coupon/delete/{coupon_id}', [CouponComtroller::class, 'coupon_delete'])->name('coupon.delete');
Route::post('/coupon/store', [CouponComtroller::class, 'coupon_store'])->name('coupon.store');


// Customer
Route::get('/customer/register/login', [CustomerController::class, 'customer_register_login'])->name('customer.register.login');
Route::post('/customer/register/store', [CustomerController::class, 'customer_register_store'])->name('customer.register.store');
Route::post('/customer/login', [CustomerController::class, 'customer_login'])->name('customer.login');
Route::get('/customer/logout', [CustomerController::class, 'customer_logout'])->name('customer.logout');
Route::get('/customer/profile', [CustomerController::class, 'customer_profile'])->name('customer.profile');
Route::post('/customer/update', [CustomerController::class, 'customer_update'])->name('customer.update');

// Chackout
Route::get('/Checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/getCities', [CheckoutController::class, 'getCities']);
Route::post('/order.store', [CheckoutController::class, 'order_store'])->name('order.store');
Route::get('/order/success/{order_id}', [CheckoutController::class, 'order_success'])->name('order.success');


// Orders
Route::get('/myorder', [CustomerController::class, 'myorder'])->name('myorder');
Route::get('/orders', [OrderController::class, 'orders'])->name('orders');
Route::post('/status/update', [OrderController::class, 'status_update'])->name('status.update');
Route::get('/download/invoice/{order_id}', [OrderController::class, 'download_invoice'])->name('download.invoice');


// SSLCOMMERZ Start

Route::get('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


// Stripe
Route::controller(StripePaymentController::class)->group(function(){
Route::get('stripe', 'stripe');
Route::post('stripe', 'stripePost')->name('stripe.post');

});

// Review
Route::post('/Review', [CustomerController::class, 'review_store'])->name('review.store');

// Password Reset
Route::get('/Forget/Password', [PasswordrResetController::class, 'forgot_pass'])->name('forgot.pass');
Route::post('/Password/reset/req', [PasswordrResetController::class, 'password_reset_req'])->name('password.reset.req');
Route::get('/Password/reset/form/{token}', [PasswordrResetController::class, 'pass_reset_form'])->name('pass.reset.form');
Route::post('/pass/reset/confirm', [PasswordrResetController::class, 'pass_reset_confirm'])->name('pass.reset.confirm');

// Email Verify
Route::get('/customer/email/verify/{token}', [CustomerController::class, 'customer_email_verify'])->name('customer.email.verify');