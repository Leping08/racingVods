<?php

namespace App\Nova;

use App\Nova\Actions\ValidateThumbnail;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Video extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Video::class;

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
        'youtube_id'
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
            Text::make('Youtube Id'),
            Text::make('Video Link', function () {
                return view('vendor.nova.partials.link', [
                    'text' => 'https://www.youtube.com/watch?v=' . $this->youtube_id . '&t=' . $this->youtube_start_time . 's',
                    'link' => 'https://www.youtube.com/watch?v=' . $this->youtube_id . '&t=' . $this->youtube_start_time . 's',
                    'new_tab' => true
                ])->render();
            })->asHtml()->exceptOnForms(),
            Number::make('Start Time (Seconds)', 'youtube_start_time'),
            BelongsTo::make('Race')->searchable(),
            Boolean::make('Valid Thumbnail', 'valid_thumbnail')->hideWhenCreating(),
            Text::make('Thumbnail', function () {
                return view('vendor.nova.partials.image', [
                    'src' => "https://img.youtube.com/vi/{$this->youtube_id}/maxresdefault.jpg"
                ])->render();
            })->asHtml(),
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
        return [
            new ValidateThumbnail()
        ];
    }
}
