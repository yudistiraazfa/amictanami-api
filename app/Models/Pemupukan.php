<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemupukan extends Model
{
    protected $table = 'pemupukan';

    protected $fillable = [
        'tanaman_id',
        'jenis_pupuk',
        'dosis',
        'frekuensi',
        'cara_aplikasi',
        'catatan',
    ];

    public function plant()
    {
        return $this->belongsTo(Plant::class, 'tanaman_id');
    }
}
