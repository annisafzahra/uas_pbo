<?php

namespace App\Repositories\Contracts;

use App\Models\UsulanBuku;

interface UsulanBukuRepositoryInterface
{
    public function store(array $data): UsulanBuku;
}
