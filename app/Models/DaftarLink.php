<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarLink extends Model
{
    use HasFactory;

    protected $table = 'daftar_link'; // kasih tau nama tabel

    protected $fillable = [
        'microsite_id',
        'shortlink',
        'original_link',
        'title',
    ];

    // Microsites
    public function microsite()
    {
        // foreign key = microsites_id, owner key = id
        return $this->belongsTo(Microsite::class, 'microsites_id', 'id');
    }

}
