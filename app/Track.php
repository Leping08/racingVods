<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = ['name', 'length', 'image', 'website', 'numberOfCorners', 'description'];

    public function races()
    {
        return $this->hasMany(Race::class)->orderBy('race_date');
    }
}
