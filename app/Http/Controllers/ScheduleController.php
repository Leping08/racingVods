<?php

namespace App\Http\Controllers;

use App\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ScheduleController extends Controller
{
    public function index()
    {
        return Cache::remember('schedule_index', config('cache.time'), function () {
            return Race::with('series', 'track', 'season')->get();
        });
    }
}
