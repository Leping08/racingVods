<?php

namespace App\Http\Controllers;

use App\Race;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Race::orderBy('id', 'desc')->with(['track', 'season', 'series'])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        Log::info("$newRace->name was created.");
        return $newRace;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Race::with(['track', 'season', 'series'])->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function latest()
    {
        return Race::orderBy('id', 'desc')->take(5)->with(['track', 'season', 'series'])->get();
    }
}
