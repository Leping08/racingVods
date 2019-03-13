<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public function series()  //TODO: Remove this relationship
    {
        return $this->belongsToMany(Series::class);
    }

    public function races()
    {
        return $this->hasMany(Race::class);
    }
}
