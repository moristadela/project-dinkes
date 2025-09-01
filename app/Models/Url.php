<?php
// FILE: App/Models/Url.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;
    protected $table = 'url'; // Pastikan nama tabel benar

    protected $fillable = [
        'title',
        'original_url',
        'short_url',
        'bidang_id',
        'seksi_id', // Tambahkan seksi_id ke fillable
        'users_id'
    ];

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Relasi ke model Bidang.
     */
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }
    
    /**
     * Relasi ke model Seksi.
     */
    public function seksi()
    {
        return $this->belongsTo(Seksi::class, 'seksi_id');
    }
}
