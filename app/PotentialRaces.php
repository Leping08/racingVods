<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;

/**
 * An Eloquent Model: 'Potential Races'
 *
 * @property integer $id
 * @property string $title
 * @property string $youtube_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */

class PotentialRaces extends Model
{
    use SoftDeletes, Actionable;

    protected $fillable = ['title', 'youtube_id'];
}
