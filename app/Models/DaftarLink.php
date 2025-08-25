<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DaftarLink extends Model
{
    use HasFactory;

    /**
     * Menentukan nama tabel secara eksplisit.
     */
    protected $table = 'daftar_link';

    /**
     * Atribut yang bisa diisi secara massal.
     */
    protected $fillable = [
        'microsite_id',
        'shortlink',
        'original_link',
        'title',
    ];

    /**
     * Mendefinisikan relasi "milik" ke model Microsite.
     * Setiap DaftarLink dimiliki oleh satu Microsite.
     */
    public function microsite(): BelongsTo
    {
        return $this->belongsTo(Microsite::class);
    }
}