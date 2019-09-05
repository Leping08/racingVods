<?php

/*
|--------------------------------------------------------------------------
| Laravel PHP Facade/Wrapper for the Youtube Data API v3
|--------------------------------------------------------------------------
|
| Here is where you can set your key for Youtube API. In case you do not
| have it, it can be acquired from: https://console.developers.google.com
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Youtube API Key
    |--------------------------------------------------------------------------
    |
    | This is the API key that will be used in all api calls to youtube.
    | You can get a key from here: https://console.developers.google.com/
    |
    */

    'key' => env('YOUTUBE_API_KEY', 'YOUR_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Number Of Videos Pulled From The API For A Series
    |--------------------------------------------------------------------------
    |
    | This is the number of videos that will be selected from a youtube
    | chanel for each series.
    |
    */

    'races_per_series' => 5,

    /*
    |--------------------------------------------------------------------------
    | Video Title Black List
    |--------------------------------------------------------------------------
    |
    | If a video contains any of these words in the title it will be ignored.
    |
    */

    'excluded_key_words' => [
        'sim',
        'qualifying',
        'practice'
    ]
];
