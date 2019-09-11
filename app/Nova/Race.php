<?php

namespace App\Nova;

use App\Nova\Metrics\Views;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Race extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Race::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $json = json_decode($request->input('viaRelationship')) ?? null;

        return [
            ID::make()->sortable(),
            Text::make('Name')->withMeta(["value" => $json->title ?? $this->name]),
            Date::make('Race Date'),
            Text::make('Duration')->withMeta(["value" => $json->duration ?? $this->duration]),
            BelongsTo::make('Track')->withMeta(["belongsToId" => $json->track_id ?? $this->track_id])->searchable(),
            BelongsTo::make('Series')->withMeta(["belongsToId" => $json->series_id ?? $this->series_id])->searchable(),
            BelongsTo::make('Season')->withMeta(["belongsToId" => $json->season_id ?? $this->season_id]),
            HasMany::make('Videos'),
            DateTime::make('Created At')->onlyOnDetail(),
            DateTime::make('Updated At')->onlyOnDetail(),
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
        return [
            (new Views('App\Race'))->width('2/3')->onlyOnDetail()
        ];
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
