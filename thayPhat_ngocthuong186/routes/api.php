<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//-------------------------------PRODUCT-11-----------------------------------------------------------
Route:: get('product_all/{limit}/{page?}', [ProductController :: class, "product_all"]);
Route::get('product_detail/{slug}/{limit}', [ProductController::class, "product_detail"]);
Route::get('product', [ProductController::class,'index']);
Route::get('product/show', [ProductController::class, 'show'])->name('product.show');
Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('product', [ProductController::class, 'store'])->name('product.store');
Route::get('product/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::get('/products/trash', [ProductController::class, 'trash'])->name('product.trash');
Route::get('product/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
Route::get('/products/latest', [ProductController::class, 'latest']);
Route::get('/products/top-sale', [ProductController::class, 'topSaleProducts']);
Route::get('product/toggle-status/{id}', [ProductController::class, 'toggleStatus'])->name('product.toggleStatus');

//-------------------------------CATEGORY-8-----------------------------------------------------------
Route::get('category', [CategoryController::class,'index']);//in ra tat ca
Route::get('/category/{categoryId}', [CategoryController::class, "getProductsByCategory"]);//lay sp theo danh muc
Route::post('category', [CategoryController::class,'store'])->name('category.store');
Route::get('category/create', [CategoryController::class,'create'])->name('category.create');
Route::get('category/{id}', [CategoryController::class,'show'])->name('category.show');
Route::put('category/{id}', [CategoryController::class,'update'])->name('category.update');
Route::delete('category/{id}', [CategoryController::class,'deystroy'])->name('category.deystroy');
Route::get('category/{id}/edit', [CategoryController::class,'edit'])->name('category.edit');
Route::post('/login', [UserController::class, 'login']);
//-------------------------------BRAND-7-----------------------------------------------------------
Route::get('brand', [BrandController::class,'index']);//in ra tat ca
// Route::get('/brand/{categoryId}', [CategoryController::class, "getProductsByCategory"]);//lay sp theo danh muc
Route::post('brand', [BrandController::class,'store'])->name('brand.store');
Route::get('brand/create', [BrandController::class,'create'])->name('brand.create');
Route::get('brand/{id}', [BrandController::class,'show'])->name('brand.show');
Route::put('brand/{id}', [BrandController::class,'update'])->name('brand.update');
Route::delete('brand/{id}', [BrandController::class,'deystroy'])->name('brand.deystroy');
Route::get('brand/{id}/edit', [BrandController::class,'edit'])->name('brand.edit');
//-------------------------------POST-11-----------------------------------------------------------
//user-end
Route::post('post_new/{limit}', [PostController::class,'post_new'])->name('post.post_new');//bai viet moi
Route::post('post_all/{limit}/{page?}', [PostController::class,'post_all'])->name('post.post_all');//tat ca bai viet 
Route::post('post_detail/{slug}/{limit}', [PostController::class,'post_detail'])->name('post.post_detail');//chi tiet bai viet
// Route::post('post_page/{slug}', [BrandController::class,'post_page'])->name('post.post_page');
// //
Route::post('post_topic/{topic_id}/{limit}', [PostController::class,'post_topic'])->name('post.post_topic');//chu de bai viet
//admin
Route::get('post', [PostController::class,'index']);//in ra tat ca
Route::post('post', [PostController::class,'store'])->name('post.store');
Route::get('post/create', [PostController::class,'create'])->name('post.create');
Route::get('post/{id}', [PostController::class,'show'])->name('post.show');
Route::put('post/{id}', [PostController::class,'update'])->name('post.update');
Route::delete('post/{id}', [PostController::class,'deystroy'])->name('post.deystroy');
Route::get('post/{id}/edit', [PostController::class,'edit'])->name('post.edit');
//-------------------------------TOPIC-7-----------------------------------------------------------
Route::get('topic', [TopicController::class,'index']);//in ra tat ca
Route::post('topic', [TopicController::class,'store'])->name('topic.store');
Route::get('topic/create', [TopicController::class,'create'])->name('topic.create');
Route::get('topic/{id}', [TopicController::class,'show'])->name('topic.show');
Route::put('topic/{id}', [TopicController::class,'update'])->name('topic.update');
Route::delete('topic/{id}', [TopicController::class,'deystroy'])->name('topic.deystroy');
Route::get('topic/{id}/edit', [TopicController::class,'edit'])->name('topic.edit');
//-------------------------------USER-7-----------------------------------------------------------
Route::get('user', [UserController::class,'index']);//in ra tat ca
Route::post('user', [UserController::class,'store'])->name('user.store');
Route::get('user/create', [UserController::class,'create'])->name('user.create');
Route::get('user/{id}', [UserController::class,'show'])->name('user.show');
Route::put('user/{id}', [UserController::class,'update'])->name('user.update');
Route::delete('user/{id}', [UserController::class,'deystroy'])->name('user.deystroy');
Route::get('user/{id}/edit', [UserController::class,'edit'])->name('user.edit');
//-------------------------------BANNER-7-----------------------------------------------------------
Route::get('banner', [BannerController::class,'index']);//in ra tat ca
Route::post('banner', [BannerController::class,'store'])->name('banner.store');
Route::get('banner/create', [BannerController::class,'create'])->name('banner.create');
Route::get('banner/{id}', [BannerController::class,'show'])->name('banner.show');
Route::put('banner/{id}', [BannerController::class,'update'])->name('banner.update');
Route::delete('banner/{id}', [BannerController::class,'deystroy'])->name('banner.deystroy');
Route::get('banner/{id}/edit', [BannerController::class,'edit'])->name('banner.edit');
//-------------------------------MENU-7-----------------------------------------------------------
Route::get('menu', [MenuController::class,'index']);//in ra tat ca
Route::post('menu', [MenuController::class,'store'])->name('menu.store');
Route::get('menu/create', [MenuController::class,'create'])->name('menu.create');
Route::get('menu/{id}', [MenuController::class,'show'])->name('menu.show');
Route::put('menu/{id}', [MenuController::class,'update'])->name('menu.update');
Route::delete('menu/{id}', [MenuController::class,'deystroy'])->name('menu.deystroy');
Route::get('menu/{id}/edit', [MenuController::class,'edit'])->name('menu.edit');
//-------------------------------MENU-7-----------------------------------------------------------
Route::get('contact', [ContactController::class,'index']);//in ra tat ca
Route::post('contact', [ContactController::class,'store'])->name('contact.store');
Route::get('contact/create', [ContactController::class,'create'])->name('contact.create');
Route::get('contact/{id}', [ContactController::class,'show'])->name('contact.show');
Route::put('contact/{id}', [ContactController::class,'update'])->name('contact.update');
Route::delete('contact/{id}', [ContactController::class,'deystroy'])->name('contact.deystroy');
Route::get('contact/{id}/edit', [ContactController::class,'edit'])->name('contact.edit');
//-------------------------------ORDER-7-----------------------------------------------------------
Route::get('orders', [OrderController::class,'index'])->name('orders.index');
Route::get('orders/create', [OrderController::class,'create'])->name('orders.create');
Route::post('orders', [OrderController::class,'store'])->name('orders.store');
Route::get('orders/{id}', [OrderController::class,'show'])->name('orders.show');
Route::get('orders/{id}/edit', [OrderController::class,'edit'])->name('orders.edit');
Route::put('orders/{id}', [OrderController::class,'update'])->name('orders.update');
Route::delete('orders/{id}', [OrderController::class,'destroy'])->name('orders.destroy');
//-------------------------------ORDER-DETAIL-7---------------------------------------------------------------
Route::get('order-details', [OrderDetailController::class,'index'])->name('order-details.index');
Route::get('order-details/create', [OrderDetailController::class,'create'])->name('order-details.create');
Route::post('order-details', [OrderDetailController::class,'store'])->name('order-details.store');
Route::get('order-details/{orderDetail}', [OrderDetailController::class,'show'])->name('order-details.show');
Route::get('order-details/{orderDetail}/edit', [OrderDetailController::class,'edit'])->name('order-details.edit');
Route::put('order-details/{orderDetail}', [OrderDetailController::class,'update'])->name('order-details.update');
Route::delete('order-details/{orderDetail}', [OrderDetailController::class,'destroy'])->name('order-details.destroy');