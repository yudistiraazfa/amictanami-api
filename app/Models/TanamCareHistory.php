<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TanamCareHistory extends Model
{
    protected $table = 'tanamcare_history';

    protected $fillable = [
        'user_id',
        'title',
        'date',
        'explanation',
        'solution',
        'image_path',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if (empty($this->image_path)) {
            return null;
        }

        return url($this->image_path);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
