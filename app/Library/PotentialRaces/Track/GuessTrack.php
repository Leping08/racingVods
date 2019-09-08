<?php


namespace App\Library\PotentialRaces\Track;


use App\Track;

class GuessTrack
{
    public static function handle(string $string)
    {
        //Search text in race title for track name
        $string = strtolower($string);

        // split on 1+ whitespace & ignore empty (eg. trailing space)
        $searchValues = collect(preg_split('/\s+/', $string, -1, PREG_SPLIT_NO_EMPTY));

        //Exclude these values from the search
        $exclude = [
            'to',
            'the',
            'of',
            'at',
            'st.',
            'raceway',
            'international',
            'speedway',
            'streets',
            'fast',
            'forward',
            'forward:',
            'grand',
            'prix',
            'motorsports',
            'motorsport',
            'motor',
            'road',
            'circuit'
        ];

        //Remove any strings that are in the $exclude array
        $filteredValues = $searchValues->reject(function ($item) use ($exclude) {
            return in_array($item, $exclude);
        });

        //Loop over tracks and search
        $tracks = Track::where(function ($query) use ($filteredValues) {
            foreach ($filteredValues as $value) {
                $query->orWhere('name', 'like', "%{$value}%");
            }
        })->get();

        //Return the first track id if the system found any
        return $tracks->count() ? $tracks->first()->id : null;
        //TODO Use ML to scan the video
    }
}