<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;

/**
 * An Eloquent Model: 'Series'
 *
 * @property integer $id
 * @property string $name
 * @property string $full_name
 * @property string $image
 * @property string $description
 * @property string $website
 * @property string $youtube_chanel_name
 * @property integer $min_race_time
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property-read Race $races
 */

class Series extends Model
{
    use Actionable, SoftDeletes;

    protected $fillable = ['name', 'full_name', 'image', 'website', 'description', 'min_race_time'];

    /**
     * @return HasMany
     */
    public function races()
    {
        return $this->hasMany(Race::class)->with('season')->orderBy('race_date', 'asc');
    }

    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }
}
