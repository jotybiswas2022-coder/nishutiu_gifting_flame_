<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OwnerController;


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
});