<?php

namespace App\Nova\Metrics;

use App\View;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;

class ViewsValue extends Value
{
    public $model;

    public function __construct($model = null, $component = null)
    {
        parent::__construct($component);

        $this->model = $model;
    }

    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        if($this->model) {
            return $this->count($request, View::where('viewable_id', $request->segment(3))->where('viewable_type', $this->model));
        } else {
            return $this->count($request, View::class);
        }
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            30 => '30 Days',
            60 => '60 Days',
            365 => '365 Days',
            'TODAY' => 'Today',
            'MTD' => 'Month To Date',
            'QTD' => 'Quarter To Date',
            'YTD' => 'Year To Date',
        ];
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
        return 'new-views';
    }
}
