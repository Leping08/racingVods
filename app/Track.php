<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;

/**
 * An Eloquent Model: 'Tracks'
 *
 * @property integer $id
 * @property string $name
 * @property float $length
 * @property string $image
 * @property string $website
 * @property string $number_of_corners
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property-read Race $races
 */

class Track extends Model
{
    use Actionable, SoftDeletes;

    protected $fillable = ['name', 'length', 'image', 'website', 'number_of_corners'];

    protected $casts = [
        'length' => 'float',
        'number_of_corners' => 'int'
    ];

    /**
     * @return HasMany
     */
    public function races()
    {
        return $this->hasMany(Race::class)->orderBy('race_date');
    }

    public function views()
    {
        return $this->morphMany('App\View', 'viewable');
    }
}
