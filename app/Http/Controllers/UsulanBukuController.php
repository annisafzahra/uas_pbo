<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\UsulanBukuRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsulanBukuController extends Controller
{
    protected $repository;

    public function __construct(UsulanBukuRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isbn' => 'required|string|unique:usulan_buku|max:13',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'kategori' => 'required|string|max:100',
            'pengusul_email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $usulan = $this->repository->store($request->all());

            return redirect()->route('index');
            // return response()->json([
            //     'message' => 'Usulan buku berhasil disimpan.',
            //     'data' => $usulan,
            // ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat menyimpan data.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
}