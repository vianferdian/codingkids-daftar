<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\PublicRegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - CodingKids Registration System
|--------------------------------------------------------------------------
*/

// ==========================================
// PUBLIC ROUTES
// ==========================================
Route::get('/', [PublicRegistrationController::class, 'index'])->name('public.landing');
Route::get('/daftar/{category}', [PublicRegistrationController::class, 'create'])->name('public.register');
Route::post('/daftar', [PublicRegistrationController::class, 'store'])->name('public.store');
Route::get('/pendaftaran/berhasil/{id}', [PublicRegistrationController::class, 'success'])->name('public.success');
Route::get('/pendaftaran/{id}/cetak', [PublicRegistrationController::class, 'printSlip'])->name('public.print-slip');

// ==========================================
// ADMIN AUTHENTICATION ROUTES
// ==========================================
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

// ==========================================
// ADMIN PROTECTED ROUTES (Requires Auth)
// ==========================================
Route::prefix('admin')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Peserta Management
    Route::get('/peserta', [RegistrationController::class, 'index'])->name('admin.peserta.index');
    Route::get('/peserta/{id}', [RegistrationController::class, 'show'])->name('admin.peserta.show');
    Route::get('/peserta/{id}/edit', [RegistrationController::class, 'edit'])->name('admin.peserta.edit');
    Route::put('/peserta/{id}', [RegistrationController::class, 'update'])->name('admin.peserta.update');
    Route::delete('/peserta/{id}', [RegistrationController::class, 'destroy'])->name('admin.peserta.destroy');

    // Laporan & Export
    Route::get('/laporan', [ReportController::class, 'index'])->name('admin.laporan.index');
    Route::get('/laporan/export/excel', [ReportController::class, 'exportExcel'])->name('admin.laporan.excel');
    Route::get('/laporan/export/csv', [ReportController::class, 'exportCsv'])->name('admin.laporan.csv');
    Route::get('/laporan/print', [ReportController::class, 'print'])->name('admin.laporan.print');
});
