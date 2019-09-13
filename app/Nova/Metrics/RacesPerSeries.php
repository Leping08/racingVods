<?php

namespace App\Nova\Metrics;

use App\Race;
use App\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Metrics\Partition;

class RacesPerSeries extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        //return \App\Series::withCount('races')->orderBy('races_count', 'desc')->pluck('races_count', 'name');
        return $this->count($request, Race::class, 'series_id')
            ->label(function ($value) {
                return Series::find($value)->name;
            });
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'races-per-series';
    }
}
