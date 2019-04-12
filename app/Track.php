<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Nova\Actions\Actionable;

/**
 * An Eloquent Model: 'Tracks'
 *
 * @property integer $id
 * @property string $name
 * @property float $length
 * @property string $image
 * @property string $website
 * @property string $numberOfCorners
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Race $races
 */

class Track extends Model
{
    use Actionable;

    //TODO: Remove the description column
    //TODO: Update the name of the numberOfCorners column
    protected $fillable = ['name', 'length', 'image', 'website', 'numberOfCorners', 'description'];

    /**
     * @return HasMany
     */
    public function races()
    {
        return $this->hasMany(Race::class)->orderBy('race_date');
    }
}
