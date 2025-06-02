<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kosan extends Model
{
   protected $fillable = [
    'nama',
    'alamat',
    'fasilitas',
    'harga',
    'deskripsi',
    'gambar',
    'pemilik_kosan_id',
];

    public function pemilikkosan()
    {
        return $this->belongsTo(PemilikKosan::class, 'pemilik_kosan_id');
    }
}

