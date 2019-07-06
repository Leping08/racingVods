<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;

/**
 * An Eloquent Model: 'Season'
 *
 * @property integer $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property-read Race $races
 */

class Season extends Model
{
    use Actionable, SoftDeletes;

    /**
     * @return HasMany
     */
    public function races()
    {
        return $this->hasMany(Race::class);
    }
}
