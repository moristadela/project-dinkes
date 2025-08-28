<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bidang extends Model
{
    use HasFactory;

    protected $table = 'bidang'; // Pastikan nama tabelnya benar

    protected $fillable = [
        'nama_bidang',
    ];

    /**
     * Get the seksis for the bidang.
     * Menggunakan eksplisit foreign key untuk keandalan.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}