<?php

namespace App\Http\Controllers;

use App\Race;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return Race::with('series', 'track', 'season')->get();
    }
}
