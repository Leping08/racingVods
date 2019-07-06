<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Nova\Actions\Actionable;

/**
 * An Eloquent Model: 'Series'
 *
 * @property integer $id
 * @property string $name
 * @property string $full_name
 * @property string $image
 * @property string $website
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Race $races
 */

class Series extends Model
{
    use Actionable;

    protected $fillable = ['name', 'full_name', 'image', 'website', 'description'];

    /**
     * @return HasMany
     */
    public function races()
    {
        return $this->hasMany(Race::class)->with('season')->orderBy('race_date', 'asc');
    }
}
