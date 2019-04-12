<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Nova\Actions\Actionable;

/**
 * An Eloquent Model: 'Video'
 *
 * @property integer $id
 * @property string $youtube_id
 * @property string $youtube_start_time
 * @property int $race_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Race $race
 */

class Video extends Model
{
    use Actionable;

    protected $appends = ['thumbnail'];

    protected $fillable = [
        'youtube_id',
        'youtube_start_time',
        'race_id'
    ];

    /**
     * @return BelongsTo
     */
    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    /**
     * @return string
     */
    public function getThumbnailAttribute()
    {
        return 'https://img.youtube.com/vi/' . $this->youtube_id . '/maxresdefault.jpg';
    }
}
