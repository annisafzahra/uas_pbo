<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsulanBuku extends Model
{
    use HasFactory;

    protected $table = 'usulan_buku';

    protected $fillable = [
        'judul', 
        'isbn', 
        'penulis', 
        'penerbit', 
        'tahun_terbit', 
        'kategori', 
        'pengusul_email',
    ];
}
