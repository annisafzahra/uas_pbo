<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowUsulanBuku;
use App\Http\Controllers\UsulanBukuController;
use Illuminate\Http\Request;


Route::get('/', [ShowUsulanBuku::class, 'index'])->name('index');

Route::post('/usulan-buku-store', [UsulanBukuController::class, 'store'])->name('store');
Route::get('/usulan-buku/{id}', [UsulanBukuController::class, 'show'])->name('show');
Route::put('/usulan-buku/{id}', [UsulanBukuController::class, 'update'])->name('update');
Route::delete('/usulan-buku/{id}', [UsulanBukuController::class, 'destroy'])->name('destroy');

Route::get('/usulans/{filename}', function ($filename) {
    $path = storage_path('app/public/usulans/' . $filename);

    // Memastikan file ada
    if (!file_exists($path)) {
        abort(404, 'File not found');
    }

    return response()->json(json_decode(file_get_contents($path)));
});

Route::post('/usulans', function (Request $request) {
    $request->validate([
        'filename' => 'required|string',
        'data' => 'required|array'
    ]);

    $filename = $request->filename;
    $path = storage_path('app/public/usulans/' . $filename);

    // Menyimpan data ke file JSON
    try {
        file_put_contents($path, json_encode($request->data, JSON_PRETTY_PRINT));
        return response()->json(['message' => 'File created and data saved successfully'], 201);
    } catch (Exception $e) {
        return response()->json(['error' => 'Failed to save data: ' . $e->getMessage()], 500);
    }
});

Route::put('/usulans/{filename}', function (Request $request, $filename) {
    $path = storage_path('app/public/usulans/' . $filename);

    // Memastikan file ada
    if (!file_exists($path)) {
        return response()->json(['error' => 'File not found'], 404);
    }

    // Mengambil data yang ada dan menggabungkannya dengan data baru
    try {
        $currentData = json_decode(file_get_contents($path), true);

        // Gabungkan data yang lama dengan data baru
        $updatedData = array_merge($currentData, $request->all());

        // Menyimpan data yang diperbarui
        file_put_contents($path, json_encode($updatedData, JSON_PRETTY_PRINT));

        return response()->json(['message' => 'File updated successfully'], 200);
    } catch (Exception $e) {
        return response()->json(['error' => 'Failed to update data: ' . $e->getMessage()], 500);
    }
});

Route::delete('/usulans/{filename}', function ($filename) {
    $path = storage_path('app/public/usulans/' . $filename);

    // Memastikan file ada
    if (!file_exists($path)) {
        return response()->json(['error' => 'File not found'], 404);
    }

    // Menghapus file
    try {
        unlink($path);  // Menghapus file
        return response()->json(['message' => 'File deleted successfully'], 200);
    } catch (Exception $e) {
        return response()->json(['error' => 'Failed to delete file: ' . $e->getMessage()], 500);
    }
});

