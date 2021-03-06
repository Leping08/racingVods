<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;

/**
 * An Eloquent Model: 'Video'
 *
 * @property integer $id
 * @property string $youtube_id
 * @property string $youtube_start_time
 * @property int $race_id
 * @property bool $valid_thumbnail
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property-read Race $race
 */

class Video extends Model
{
    use Actionable, SoftDeletes;

    protected $appends = ['thumbnail'];

    protected $fillable = [
        'youtube_id',
        'youtube_start_time',
        'race_id',
        'valid_thumbnail'
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
        return $this->valid_thumbnail ? "https://img.youtube.com/vi/{$this->youtube_id}/maxresdefault.jpg" : "/img/home/nurbur-night.jpg";
    }
}
