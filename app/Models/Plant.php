<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    protected $table = 'tanaman';

    protected $fillable = [
        'nama_umum',
        'nama_latin',
        'deskripsi',
        'gambar_url',
        'kategori_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function bibitMedia()
    {
        return $this->hasOne(BibitMedia::class, 'tanaman_id');
    }

    public function penyiraman()
    {
        return $this->hasOne(Penyiraman::class, 'tanaman_id');
    }

    public function pemupukan()
    {
        return $this->hasOne(Pemupukan::class, 'tanaman_id');
    }

    public function perawatan()
    {
        return $this->hasMany(Perawatan::class, 'tanaman_id');
    }

    public function masaPanen()
    {
        return $this->hasOne(MasaPanen::class, 'tanaman_id');
    }
}
