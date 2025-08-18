<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    // Tentukan kolom mana yang boleh diisi massal
    protected $fillable = [
        'nama_bidang',
        'deskripsi',
    ];

    // Relasi: satu bidang memiliki banyak seksi
    public function seksi()
    {
        return $this->hasMany(Seksi::class);
    }
}
