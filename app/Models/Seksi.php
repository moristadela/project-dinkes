<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seksi extends Model
{
    use HasFactory;
    protected $table = 'seksi'; // Pastikan nama tabel benar
    protected $guarded = ['id'];
    
    // Relasi ke Bidang
    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }
}