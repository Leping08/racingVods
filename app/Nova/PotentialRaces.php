<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class PotentialRaces extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\PotentialRaces::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $json = [
            "name" => $this->title,
            "track_id" => $this->track_id ?? null,
            "series_id" => $this->series_id ?? null,
            "season_id" => $this->season_id ?? null
        ];

        return [
            ID::make()->sortable(),
            Text::make('Title'),
            Text::make('Youtube Id', function ($json){
                return view('partials.link', [
                    'link' => "https://www.youtube.com/watch?v=".$this->youtube_id,
                    'text' => $this->youtube_id,
                    'new_tab' => true
                ])->render();
            })->asHtml()->hideFromIndex(),
            DateTime::make('Created At')->onlyOnDetail(),
            DateTime::make('Updated At')->onlyOnDetail(),
            BelongsTo::make('Series', 'series', \App\Nova\Series::class)->hideFromIndex(),
            BelongsTo::make('Season', 'season', \App\Nova\Season::class)->hideFromIndex(),
            BelongsTo::make('Track', 'track', \App\Nova\Track::class)->hideFromIndex(),
            Text::make('Create Race', function ($json){
                return view('partials.link', [
                    'link' => "/nova/resources/races/new?viaRelationship=".json_encode($json),
                    'text' => 'Create Race',
                    'new_tab' => false
                ])->render();
            })->asHtml()->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
