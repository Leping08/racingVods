<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Season extends Model
{
    use Actionable;

    public function series()  //TODO: Remove this relationship
    {
        return $this->belongsToMany(Series::class);
    }

    public function races()
    {
        return $this->hasMany(Race::class);
    }
}
