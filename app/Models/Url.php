<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'url'; // Pastikan ini sesuai dengan nama tabel di migrasi

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'short_url',
        'original_url',
        'bidang_id',
        'seksi_id',
    ];

    /**
     * Mendapatkan data bidang yang memiliki URL ini.
     */
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }

    public function seksi()
    {
        return $this->belongsTo(Seksi::class, 'seksi_id');
    }

}