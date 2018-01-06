<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    public function seasons()
    {
        return $this->belongsToMany(Season::class)->orderBy('id', 'desc');
    }

    public function races()
    {
        return $this->hasMany(Race::class)->orderBy('race_date', 'asc');
    }
}
