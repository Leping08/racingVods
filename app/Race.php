<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Race extends Model
{
    use Actionable;
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

    public function scopeThisSeason($query)
    {
        return $query->where('season_id', $this->season->id);
    }

    public function scopeThisSeries($query)
    {
        return $query->where('series_id', $this->series->id);
    }

    public function next()
    {
        $collection = $this->thisSeason()
                            ->thisSeries()
                            ->orderBy('race_date', 'asc')
                            ->get();

        $index = $collection->search(function($collection) {
            return $collection->id === $this->id;
        });

        return $collection->get($index + 1);
    }

    public function previous()
    {
        $collection = $this->thisSeason()
                            ->thisSeries()
                            ->orderBy('race_date', 'asc')
                            ->get();

        $index = $collection->search(function($collection) {
            return $collection->id === $this->id;
        });

        return $collection->get($index - 1);
    }
}
