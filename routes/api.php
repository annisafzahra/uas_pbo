<?php

use App\Http\Controllers\UsulanBukuController;
use App\Http\Controllers\ShowUsulanBuku;
use Illuminate\Support\Facades\Route;

Route::post('/usulan-buku', [UsulanBukuController::class, 'store']);
Route::get('/usulan-buku', [UsulanBukuController::class, 'index']);
Route::get('/usulan-buku/{id}', [UsulanBukuController::class, 'show']);
Route::put('/usulan-buku/{id}', [UsulanBukuController::class, 'update']);
Route::delete('/usulan-buku/{id}', [UsulanBukuController::class, 'destroy']);
Route::get('/', [ShowUsulanBuku::class, 'index'])->name('index');
