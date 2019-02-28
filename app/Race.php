<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'race_date' => 'datetime:Y-m-d',
    ];

    protected $fillable = ['name', 'race_date', 'season_id', 'series_id', 'track_id', 'youtube_id', 'youtube_start_time', 'duration'];

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
