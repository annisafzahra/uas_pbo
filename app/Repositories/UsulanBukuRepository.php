<?php

namespace App\Repositories;

use Exception;
use App\Models\UsulanBuku;
use Illuminate\Support\Facades\Log;
use App\Repositories\Contracts\UsulanBukuRepositoryInterface;

class UsulanBukuRepository implements UsulanBukuRepositoryInterface
{
    public function store(array $data): UsulanBuku
    {
        $usulan = UsulanBuku::create($data);
        $this->storeOrderJson($usulan);
        return $usulan;
    }

    protected function storeOrderJson(UsulanBuku $usulan)
    {
        try {
            $usulanData = $usulan->toArray();
            $jsonPath = storage_path('app/public/usulans/usulans' . $usulan->id . '.json');

            // Pastikan direktori ada, jika tidak maka buat
            $directory = dirname($jsonPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            // Menulis data usulan ke file JSON
            if (file_put_contents($jsonPath, json_encode($usulanData, JSON_PRETTY_PRINT)) === false) {
                throw new Exception('Failed to write usulan data to JSON file.');
            }

            Log::info("Usulan data saved to JSON at: " . $jsonPath);
        } catch (Exception $e) {
            Log::error('Error saving usulan data to JSON: ' . $e->getMessage());
            throw new Exception('Unable to save usulan data to JSON file.');
        }
    }
}
