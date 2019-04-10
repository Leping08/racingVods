<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;

class PotentialRaces extends Model
{
    use SoftDeletes, Actionable;

    protected $fillable = ['title', 'youtube_id'];
}
