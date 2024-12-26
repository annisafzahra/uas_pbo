<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsulanBuku;

class ShowUsulanBuku extends Controller
{
    public function index()
    {
        // Mengambil semua data usulan buku dari database
        $usulanBuku = UsulanBuku::all();

        // Mengirim data ke view
        return view('usulan-buku', compact('usulanBuku'));
    }

}
