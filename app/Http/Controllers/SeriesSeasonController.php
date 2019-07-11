<?php

namespace App\Http\Controllers;

use App\Race;
use App\Season;
use App\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SeriesSeasonController extends Controller
{
    public function index(Series $series, Season $season)
    {
        return Cache::remember("season_{$season->id}_series_{$series->id}", config('cache.time'), function () use ($series, $season) {
            return Race::where('season_id', $season->id)
                ->where('series_id', $series->id)
                ->with(['track', 'series', 'season', 'videos'])
                ->orderBy('race_date', 'asc')
                ->get();
        });
    }
}
