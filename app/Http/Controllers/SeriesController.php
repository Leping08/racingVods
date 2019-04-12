<?php

namespace App\Http\Controllers;

use App\Race;
use App\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SeriesController extends Controller
{
    public function index()
    {
        return Cache::remember('series_index', config('cache.time'), function () {
            return Series::orderBy('fullName', 'asc')->get();
        });
    }

    public function store(Request $request) //TODO Not needed with nova
    {
        $series = $request->validate([
            'name' => 'required|max:5',
            'fullName' => 'required|max:255',
            'image' =>  'required',
            'website' => 'required',
            'description' => 'required|max:5000'
        ]);


        $path = $request->file('image')->store('series');

        $series['image'] = $path;

        $newSeries = Series::create($series);
        Log::info("$newSeries->fullName was created.");
        return $newSeries;
    }

    public function show(Series $series)
    {
        return Cache::remember("series_show_{$series->id}", config('cache.time'), function () use ($series) {
            $series->load('races');
            $series['seasons'] = $series->races->unique('season_id')->pluck('season');
            unset($series->races);
            return $series;
        });
    }
}
