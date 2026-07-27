<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasaPanen extends Model
{
    protected $table = 'masa_panen';

    protected $fillable = [
        'tanaman_id',
        'durasi_tanam',
        'ciri_siap_panen',
        'cara_panen',
        'frekuensi_panen',
        'hasil_panen',
    ];

    public function plant()
    {
        return $this->belongsTo(Plant::class, 'tanaman_id');
    }
}
