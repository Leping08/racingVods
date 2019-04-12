<?php

namespace App\Http\Controllers;

use App\Track;
use App\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TracksController extends Controller
{
    public function index()
    {
        return Cache::remember('track_index', config('cache.time'), function () {
            return Track::orderBy('fullName', 'asc')->get();
        });
    }

    public function store(Request $request) //TODO Not needed with nova
    {
        $track = $request->validate([
            'name' => 'required|max:255',
            'length' => 'required|numeric',
            'image' =>  'required',
            'website' => 'required',
            'numberOfCorners' => 'required|numeric'
        ]);

        $newTrack = Track::create($track);
        Log::info("$newTrack->name was created.");
        return $newTrack;
    }

    public function show(Track $track)
    {
        return Cache::remember("track_show_{$track->id}", config('cache.time'), function () use ($track) {
            return $track->load('races.videos', 'races.series', 'races.season');
        });
    }
}
