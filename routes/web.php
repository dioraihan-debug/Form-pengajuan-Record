<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CctvRequestController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminRiwayatController;
use App\Http\Controllers\AdminPasswordController;

Route::get('/', function () {
    return redirect('/cctv-request');
});

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Client Routes
Route::get('/cctv-request', [CctvRequestController::class, 'create'])->name('cctv.create');
Route::post('/cctv-request', [CctvRequestController::class, 'store'])->name('cctv.store');
Route::get('/cctv-request/{id}/pdf', [CctvRequestController::class, 'downloadPdf'])->name('cctv.pdf');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Admin Routes
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    // Authenticated Admin Routes
    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        Route::get('/riwayat', [AdminRiwayatController::class, 'index'])->name('riwayat');
        Route::get('/riwayat/{id}/download-pdf', [AdminRiwayatController::class, 'downloadPdf'])->name('riwayat.download-pdf');
        Route::post('/riwayat/{id}/status', [AdminRiwayatController::class, 'updateStatus'])->name('riwayat.update-status');
        
        Route::get('/ganti-password', [AdminPasswordController::class, 'showChangePasswordForm'])->name('password.change');
        Route::post('/ganti-password', [AdminPasswordController::class, 'changePassword'])->name('password.update');
    });
});
