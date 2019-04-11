<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Nova\Actions\Actionable;

/**
 * An Eloquent Model: 'Race'
 *
 * @property integer $id
 * @property string $name
 * @property integer $season_id
 * @property integer $series_id
 * @property integer $track_id
 * @property string $duration
 * @property bool $new
 * @property Carbon race_date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Series $series
 * @property-read Track $track
 * @property-read Season $season
 * @property-read Video $videos
 */

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

    protected $appends = ['new'];

    protected $fillable = ['name', 'race_date', 'season_id', 'series_id', 'track_id', 'duration'];

    /**
     * @return BelongsTo
     */
    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    /**
     * @return BelongsTo
     */
    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    /**
     * @return BelongsTo
     */
    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    /**
     * @return HasMany
     */
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    /**
     * @return bool
     */
    public function getNewAttribute()
    {
        return $this->created_at > Carbon::now()->subDays(7);
    }

    /**
     * @param $query
     * @return Series
     */
    public function scopeThisSeason($query)
    {
        return $query->where('season_id', $this->season->id);
    }

    /**
     * @param $query
     * @return Series
     */
    public function scopeThisSeries($query)
    {
        return $query->where('series_id', $this->series->id);
    }

    /**
     * @return Race
     */
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

    /**
     * @return Race
     */
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
