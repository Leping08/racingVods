<?php

namespace App\Http\Controllers;

use App\Race;
use App\Season;
use App\Series;
use App\Track;
use App\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RacesController extends Controller
{
    public function index()
    {
        return Race::orderBy('id', 'desc')->with(['track', 'season', 'series', 'videos'])->get();
    }

    public function store(Request $request)
    {
        $race = $request->validate([
            'name' => 'required|max:255',
            'series_id' => 'required|integer',
            'track_id' =>  'required|integer',
            'season_id' => 'required|integer',
            'race_date' => 'required|date',
            'youtube_id' => 'required|max:20',
            'youtube_start_time' => 'required|integer',
            'duration' => 'required|max:255'
        ]);

        $race['race_date'] = Carbon::parse($race['race_date']);

        $newRace = Race::create($race);
        Log::info("Race ID: $newRace->id was created. Name: $newRace->id");

        $video = Video::create([
            'youtube_id' => $request->youtube_id,
            'youtube_start_time' => $request->youtube_start_time,
            'race_id' => $newRace->id
        ]);
        Log::info("Video ID: $video->id was created and associated to Race ID: $newRace->id. Name: $newRace->id");

        return $newRace;
    }

    public function show($id)
    {
        return Race::with(['track', 'season', 'series', 'videos'])->find($id);
    }

    public function latest()
    {
        return Race::orderBy('id', 'desc')->take(5)->with(['track', 'season', 'series', 'videos'])->get();
    }
}
