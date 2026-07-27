<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perawatan extends Model
{
    protected $table = 'perawatan';

    protected $fillable = [
        'tanaman_id',
        'jenis_perawatan',
        'frekuensi',
        'cara_perawatan',
        'waktu_pelaksanaan',
        'peralatan',
    ];

    public function plant()
    {
        return $this->belongsTo(Plant::class, 'tanaman_id');
    }
}
