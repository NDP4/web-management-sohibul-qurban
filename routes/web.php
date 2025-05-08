<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SohibulQurbanController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\KwitansiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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
});

require __DIR__ . '/auth.php';
