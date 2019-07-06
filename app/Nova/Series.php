<?php

namespace App\Nova;

use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Series extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Series::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'full_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'full_name',
        'website',
        'description',
        'youtube_chanel_name'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Acronym', 'name'),
            Text::make('Name', 'full_name'),
            Text::make('Website')->onlyOnForms(),
            Text::make('Website', function () {
                return view('vendor.nova.partials.link', [
                    'text' => $this->website,
                    'link' => $this->website,
                    'new_tab' => true
                ])->render();
            })->asHtml()->exceptOnForms(),
            Text::make('Image File', 'image')->hideFromIndex(),
            Text::make('Description')->hideFromIndex(),
            Text::make('Youtube Chanel Name'),
            Text::make('Image', function () {
                return view('vendor.nova.partials.image', [
                    'src' => '/img/series/'.$this->image,
                ])->render();
            })->asHtml()->onlyOnDetail(), //TODO: Make it so this can be uploaded
            HasMany::make('Races'),
            DateTime::make('Created At')->onlyOnDetail(),
            DateTime::make('Updated At')->onlyOnDetail()
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
