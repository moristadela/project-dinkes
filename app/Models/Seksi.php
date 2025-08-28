<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seksi extends Model
{
    use HasFactory;
    
    protected $table = 'seksi'; 
    protected $guarded = ['id'];
    
    /**
     * Relasi ke Bidang.
     * Menggunakan eksplisit foreign key untuk keandalan.
     */
    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class, 'bidang_id', 'id');
    }
}