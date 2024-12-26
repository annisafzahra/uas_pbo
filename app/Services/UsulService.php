<?php

namespace App\Services;

use Exception;
use App\Models\Order;
use App\Models\UsulanBuku;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsulService
{

    public function storeOrderJson(UsulanBuku $usul)
    {
        try {
            $orderData = $usul->toArray();
            $jsonPath = storage_path('app/public/usulans/usulans' . $usul->id . '.json');
            
            // Check if directory exists, create if it doesn't
            $directory = dirname($jsonPath);
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }
            
            // Write order data to JSON file
            if (file_put_contents($jsonPath, json_encode($orderData, JSON_PRETTY_PRINT)) === false) {
                throw new Exception('Failed to write order data to JSON file.');
            }

            Log::info("Order data saved to JSON at: " . $jsonPath);
        } catch (Exception $e) {
            Log::error('Error saving order data to JSON: ' . $e->getMessage());
            throw new Exception('Unable to save order data to JSON file.');
        }
    }
}
