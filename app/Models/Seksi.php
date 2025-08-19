<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seksi extends Model {
    use HasFactory;

    protected $fillable = [
        'bidang_id',
        'nama_seksi',
    ];

    // Relasi: Satu Seksi hanya milik satu Bidang
    public function bidang() {
        return $this->belongsTo(Bidang::class);
    }
}
