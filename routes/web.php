<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BuyedController;
use App\Http\Controllers\AdminController;


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

Route::get('/', [ProductController::class, "main"]);
Route::post("/signup", [UsersController::class, "sign_up"]);
Route::get("/get_products", [ProductController::class, "get_products"]);
Route::get("/profile", [UsersController::class, "profile"])->middleware("Buyer");
Route::get("/seller", [UsersController::class, "seller"])->middleware("seller");
Route::post("/login", [UsersController::class, "login"]);
Route::get("/seller/addProduct", [ProductController::class, "add_product"])->middleware("seller");
Route::post("/seller/addProduct/adding", [ProductController::class, "adding_product"])->middleware("seller");
Route::get("/seller/myProducts", [ProductController::class, "my_products"])->middleware("seller");
Route::get("/products/{id}", [ProductController::class, "filter_by_seller"]);
Route::get("/product/details/{id}", [ProductController::class, "get_product_details"]);
Route::get("/product/edit/{id}", [ProductController::class, "edit_product"])->middleware("seller");
Route::post("/product/edit/adding", [ProductController::class, "edit_product_adding"])->middleware("seller");
Route::post("/seller/show_images", [ProductController::class, "show_images"])->middleware("seller");
Route::get("/product/delete/{id}", [ProductController::class, "delete_product"])->middleware("seller");
Route::get("/to_card/{id}", [CardController::class, "profile_card"])->middleware("Buyer");
Route::get("/user/card", [CardController::class, "card"])->middleware("Buyer");
Route::get("/delete_in_card/{id}", [CardController::class, "delete_in_card"])->middleware("Buyer");
Route::post("/user/search", [SearchController::class, "search"]);
Route::get("/logout", [UsersController::class, "logout"]);
Route::get("/seller/details/product/{id}", [ProductController::class, "seller_details_product"]);
Route::get("/product/unavailable/{id}", [ProductController::class, "is_unavailable"])->middleware("seller");
Route::get("/product/available/{id}", [ProductController::class, "is_available"])->middleware("seller");
Route::get("/get_catalog", [ProductController::class, "get_catalogs"]);
Route::get("/filter_with_catalog/{catalog}", [ProductController::class, "filter_with_catalog"]);
Route::get("/my_purchased_products", [BuyedController::class, 'buyed'])->middleware("Buyer");
Route::get("/guest/product/details/{id}", [ProductController::class, "guest_product_details"]);
Route::get("/guest/seller/products/{id}", [ProductController::class, "guest_filter_by_seller"]);
Route::get("/admin", [AdminController::class, "admin"])->middleware("Admin");
Route::get("/get_users", [AdminController::class, "get_users"])->middleware("Admin");
Route::get("/admin_logout", [AdminController::class, "admin_logout"])->middleware("Admin");
Route::post("/block_user", [AdminController::class, "block_user"])->middleware("Admin");
Route::post("/unblock_user", [AdminController::class, "unblock_user"])->middleware("Admin");
Route::get("/blocked", [UsersController::class, "blocked"]);

Route::get('/stripe', [StripePaymentController::class, "stripe"]);
Route::post('/stripe', [StripePaymentController::class, "stripePost"])->name('stripe.post');

Route::get("/stripe", [StripePaymentController::class, "stripe"]);
Route::post("/add_feedback/{product_id}/{user_id}", [ProductController::class, 'add_feedback'])->middleware("Buyer");



//https://www.itsolutionstuff.com/post/laravel-57-stripe-payment-gateway-integration-exampleexample.html?fbclid=IwAR1GQN3CkGj34oNxwRZUSCuZSNEotT74C5P3yYB-xcy6cTcMd5Wl_e0YRxQ
//https://dashboard.stripe.com/test/balance/overview
//bg #1a1f36
