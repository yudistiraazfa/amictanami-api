<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BibitMedia extends Model
{
    protected $table = 'bibit_media';

    protected $fillable = [
        'tanaman_id',
        'jenis_bibit',
        'sumber_bibit',
        'jenis_media',
        'rasio_media',
        'drainase',
        'ukuran_pot',
    ];

    public function plant()
    {
        return $this->belongsTo(Plant::class, 'tanaman_id');
    }
}
