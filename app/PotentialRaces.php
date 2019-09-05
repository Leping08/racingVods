<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;

/**
 * An Eloquent Model: 'Potential Races'
 *
 * @property integer $id
 * @property string $title
 * @property string $youtube_id
 * @property boolean $email_sent
 * @property integer $series_id
 * @property integer $track_id
 * @property integer $season_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property-read Series $series
 * @property-read Track $track
 * @property-read Season $season
 */

class PotentialRaces extends Model
{
    use SoftDeletes, Actionable;

    protected $fillable = ['title', 'youtube_id', 'series_id', 'track_id', 'season_id'];

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
}
