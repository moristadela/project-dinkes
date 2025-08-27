<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Microsite extends Model
{
    use HasFactory;

    protected $fillable = [
        'shortlink',
        'title',
        'bidang',
        'seksi',
        // Kolom 'links' dihilangkan karena sekarang disimpan di tabel terpisah
    ];

    /**
     * Relasi ke model DaftarLink
     */
    public function links()
    {
        return $this->hasMany(DaftarLink::class);
    }
}

