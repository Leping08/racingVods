<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $fillable = ['name', 'fullName', 'image', 'website', 'description'];

    public function races()
    {
        return $this->hasMany(Race::class)->with('season')->orderBy('race_date', 'asc');
    }
}
