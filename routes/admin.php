<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItemController;


Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/contact', [AdminController::class, 'contacts'])->name('contact.index');

    Route::controller(OwnerController::class)->prefix('owners')->group(function () {
        Route::get('/', 'index')->name('admin.owner.index');
        Route::get('/create', 'create')->name('admin.owner.create');
        Route::post('/', 'store')->name('admin.owner.store');
        Route::get('/{owner}/edit', 'edit')->name('admin.owner.edit');
        Route::put('/{owner}', 'update')->name('admin.owner.update');
        Route::delete('/{owner}', 'destroy')->name('admin.owner.destroy');
        Route::get('/{owner}/photo', 'photo')->name('admin.owner.photo');
    });

    Route::controller(CategoryController::class)->prefix('categories')->group(function () {
        Route::get('/', 'index')->name('admin.category.index');
        Route::get('/create', 'create')->name('admin.category.create');
        Route::post('/', 'store')->name('admin.category.store');
        Route::get('/{category}/edit', 'edit')->name('admin.category.edit');
        Route::put('/{category}', 'update')->name('admin.category.update');
        Route::delete('/{category}', 'destroy')->name('admin.category.destroy');
        Route::get('/{category}/photo', 'photo')->name('admin.category.photo');
    });

    Route::controller(ItemController::class)->prefix('items')->group(function () {
        Route::get('/', 'index')->name('admin.item.index');
        Route::get('/create', 'create')->name('admin.item.create');
        Route::post('/', 'store')->name('admin.item.store');
        Route::get('/{item}/edit', 'edit')->name('admin.item.edit');
        Route::put('/{item}', 'update')->name('admin.item.update');
        Route::delete('/{item}', 'destroy')->name('admin.item.destroy');
        Route::get('/image/{itemImage}', 'image')->name('admin.item.image');
    });
});