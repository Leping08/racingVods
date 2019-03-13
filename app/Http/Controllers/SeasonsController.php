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

    public function races($seriesID, $seasonID)
    {
        return Race::where('season_id', $seasonID)->with(['track', 'series', 'season', 'videos'])->where('series_id', $seriesID)->orderBy('race_date', 'asc')->get();
    }
}
