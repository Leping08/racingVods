<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Track extends Model
{
    use Actionable;

    //TODO: Remove the description column
    //TODO: Update the name of the numberOfCorners column
    protected $fillable = ['name', 'length', 'image', 'website', 'numberOfCorners', 'description'];

    public function races()
    {
        return $this->hasMany(Race::class)->orderBy('race_date');
    }
}
