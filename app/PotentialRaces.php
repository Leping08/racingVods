<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PotentialRaces extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'youtube_id'];
}
