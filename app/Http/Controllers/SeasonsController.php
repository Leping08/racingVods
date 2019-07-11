<?php

namespace App\Http\Controllers;

use App\Season;
use App\Race;
use App\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SeasonsController extends Controller
{
    public function index()
    {
        return Cache::remember('season_index', config('cache.time'), function () {
            return Season::all();
        });
    }
}
