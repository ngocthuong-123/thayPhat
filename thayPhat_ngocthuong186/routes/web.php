<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderDetailController;

Route::get('/',[ DashboardController::class,'index']);
//Route::get('/product',[ ProductController::class,'index']);
Route::resource('banner', BannerController::class);
Route::resource('brand', BrandController::class);
Route::resource('category', CategoryController::class);
Route::resource('contact', ContactController::class);
Route::resource('menu', MenuController::class);
Route::resource('order', OrderController::class);
Route::resource('orderdetail', OrderDetailController::class);
Route::resource('post', PostController::class);
Route::resource('product', ProductController::class);
Route::resource('topic', TopicController::class);
Route::resource('user', UserController::class);
