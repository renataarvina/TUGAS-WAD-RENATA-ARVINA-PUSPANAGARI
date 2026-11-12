<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanController;

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

});


Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    Route::middleware('role:admin,staff')->group(function () {

        // Beranda
        Route::get('/', [BahanController::class, 'index'])
            ->name('home');

        // Melihat data bahan
        Route::get('/bahan', [BahanController::class, 'bahan'])
            ->name('bahan.index');

        // Menambah data bahan
        Route::post('/bahan', [BahanController::class, 'store'])
            ->name('bahan.store');

        // Form edit bahan
        Route::get('/bahan/{id}/edit', [BahanController::class, 'edit'])
            ->name('bahan.edit');

        // Memperbarui data bahan
        Route::put('/bahan/{id}', [BahanController::class, 'update'])
            ->name('bahan.update');

    });


    Route::middleware('role:admin')->group(function () {

        // Menghapus data bahan
        Route::delete('/bahan/{id}', [BahanController::class, 'destroy'])
            ->name('bahan.destroy');

    });

});
