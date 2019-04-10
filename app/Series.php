<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Series extends Model
{
    use Actionable;

    //TODO: Update column name of fullName
    protected $fillable = ['name', 'fullName', 'image', 'website', 'description'];

    public function races()
    {
        return $this->hasMany(Race::class)->with('season')->orderBy('race_date', 'asc');
    }
}
