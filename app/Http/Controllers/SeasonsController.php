<?php

namespace App\Http\Controllers;

use App\Season;
use App\Race;
use App\Series;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index()
    {
        return Season::all();
    }

    public function races(Series $series, Season $season)
    {
        return Race::where('season_id', $season->id)
                    ->where('series_id', $series->id)
                    ->with(['track', 'series', 'season', 'videos'])
                    ->orderBy('race_date', 'asc')
                    ->get();
    }
}
