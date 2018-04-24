<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'youtube_id',
        'youtube_start_time',
        'race_id'
    ];

    public function race()
    {
        return $this->belongsTo(Race::class);
    }
}
