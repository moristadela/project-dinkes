<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bidang extends Model
{
    use HasFactory;

    protected $table = 'bidang'; 

    protected $fillable = [
        'nama_bidang',
    ];

    /**
     * Get the seksis for the bidang.
     * Menggunakan eksplisit foreign key untuk keandalan.
     */
    public function seksi(): HasMany
    {
        return $this->hasMany(Seksi::class, 'bidang_id', 'id');
    }
}