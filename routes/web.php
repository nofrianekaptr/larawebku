<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminShortUrlController;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\SettingController;
use Illuminate\Support\Facades\Route;


Route::get('/s/{code}', [AdminShortUrlController::class, 'shortenLink'])->name('shorturl.getcode');
Route::post('log/act', [LoginController::class, 'login'])->name('log.act');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');



Route::middleware(['auth', 'user-access:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('dashboard');

    Route::controller(AdminShortUrlController::class)->group(function () {
        Route::get('short-url', 'index')->name('shorturl.index');
        Route::post('short-url', 'post')->name('shorturl.post');
        Route::delete('short-url/{row}', 'destroy')->name('shorturl.destroy');
    });

    Route::controller(SettingController::class)->group(function () {
        Route::get('update-profile', 'profile')->name('setting.profile');
        Route::patch('update-profile/update', 'profileUpdate')->name('update.profile');

        Route::get('update-password', 'password')->name('setting.password');
        Route::patch('update-password/update', 'passwordUpdate')->name('update.password');
    });

    Route::resource('post', AdminPostController::class);
});
