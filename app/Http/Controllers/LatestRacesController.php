<?php

namespace App\Http\Controllers;

use App\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LatestRacesController extends Controller
{
    public function index()
    {
        return Cache::remember('race_latest', config('cache.time'), function () {
            return Race::orderBy('id', 'desc')->take(5)->with(['track', 'season', 'series', 'videos'])->get();
        });
    }
}
