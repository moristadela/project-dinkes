<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Microsite extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shortlink',
        'title',
        'bidang_id',
        'seksi_id',
    ];

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

    /**
     * Get the links for the microsite.
     */
    public function links()
    {
        return $this->hasMany(DaftarLink::class);
    }
}
