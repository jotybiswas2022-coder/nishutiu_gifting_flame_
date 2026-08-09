<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\CategoryController;

// Site home, items and contact page routes
Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/contact', 'contact')->name('contact.page');
    Route::get('/items', 'items')->name('items.index');
    Route::get('/items/{category}', 'categoryItems')->name('items.category');
});

// Public owner photo (used by frontend owner's info section)
Route::get('/owner-photo/{owner}', [OwnerController::class, 'photo'])->name('owner.photo');

// Public item image (used by frontend item cards)
Route::get('/item-image/{itemImage}', [ItemController::class, 'image'])->name('item.image');

// Public category photo (used by frontend category boxes)
Route::get('/category-photo/{category}', [CategoryController::class, 'photo'])->name('category.photo');

// Password reset link request form route
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');


// Authentication routes
Auth::routes();

// Include admin route file
include('admin.php');
