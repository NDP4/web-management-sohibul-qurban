<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SohibulQurbanController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\KwitansiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('upload', [FileUploadController::class, 'store'])->name('upload');
    Route::delete('upload', [FileUploadController::class, 'destroy'])->name('upload.destroy');
    Route::resource('sohibul-qurban', SohibulQurbanController::class);

    Route::post('/upload', [FileUploadController::class, 'store'])->name('file.upload');
    Route::delete('/upload', [FileUploadController::class, 'destroy'])->name('file.destroy');

    Route::get('/kwitansi', [KwitansiController::class, 'index'])->name('kwitansi.index');
    Route::post('/kwitansi', [KwitansiController::class, 'store'])->name('kwitansi.store');
    Route::get('/kwitansi/{kwitansi}/download', [KwitansiController::class, 'download'])->name('kwitansi.download');

    Route::get('/sohibul-qurban/export/pdf', [KwitansiController::class, 'exportSohibulQurbanPDF'])->name('sohibul-qurban.export.pdf');
    Route::get('/sohibul-qurban/export/excel', [KwitansiController::class, 'exportSohibulQurbanExcel'])->name('sohibul-qurban.export.excel');
    Route::get('/keuangan/export/pdf', [KwitansiController::class, 'exportKeuanganPDF'])->name('keuangan.export.pdf');
    Route::get('/keuangan/export/excel', [KwitansiController::class, 'exportKeuanganExcel'])->name('keuangan.export.excel');

    Route::get('/pengeluaran', [App\Http\Controllers\PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::get('/pengeluaran/create', [App\Http\Controllers\PengeluaranController::class, 'create'])->name('pengeluaran.create');
    Route::post('/pengeluaran', [App\Http\Controllers\PengeluaranController::class, 'store'])->name('pengeluaran.store');
    Route::get('/pengeluaran/{pengeluaran}/edit', [App\Http\Controllers\PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
    Route::put('/pengeluaran/{pengeluaran}', [App\Http\Controllers\PengeluaranController::class, 'update'])->name('pengeluaran.update');
    Route::delete('/pengeluaran/{pengeluaran}', [App\Http\Controllers\PengeluaranController::class, 'destroy'])->name('pengeluaran.destroy');
});

require __DIR__ . '/auth.php';
