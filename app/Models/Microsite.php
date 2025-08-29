<?php
// FILE: App/Models/Microsite.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Microsite extends Model
{
    use HasFactory;

    protected $table = 'microsites';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'shortlink',
        'title',
        'links',
        'bidang_id',
        'seksi_id',
        'users_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'links' => 'array',
    ];

    /**
     * Get the user that owns the microsite.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Get the bidang that owns the microsite.
     */
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }

    /**
     * Get the seksi that owns the microsite.
     */
    public function seksi()
    {
        return $this->belongsTo(Seksi::class, 'seksi_id');
    }

    // Microsite.php
    public function daftarLinks()
    {
        return $this->hasMany(DaftarLink::class, 'microsite_id', 'id');
    }



    
}
