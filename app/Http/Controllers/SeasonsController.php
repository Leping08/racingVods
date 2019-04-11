<?php

namespace App\Http\Controllers;

use App\Season;
use App\Race;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index()
    {
        return Season::all();
    }

    public function races($series, $season)
    {
        return Race::where('season_id', $series->id)
                    ->where('series_id', $season->id)
                    ->with(['track', 'series', 'season', 'videos'])
                    ->orderBy('race_date', 'asc')
                    ->get();
    }
}
