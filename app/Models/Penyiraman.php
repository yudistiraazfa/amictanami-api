<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyiraman extends Model
{
    protected $table = 'penyiraman';

    protected $fillable = [
        'tanaman_id',
        'frekuensi',
        'waktu_penyiraman',
        'cara_penyiraman',
        'kondisi_khusus',
    ];

    public function plant()
    {
        return $this->belongsTo(Plant::class, 'tanaman_id');
    }
}
