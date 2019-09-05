<?php


namespace App\Library\PotentialRaces;


use App\Library\PotentialRaces\Youtube\Api;
use App\Mail\NewRacesReport;
use App\PotentialRaces;
use App\Series;
use App\Video;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class FindPotentialRaces
{
    /**
     *  Get the latest races from the youtube API
     */
    public static function handel()
    {
        $videos = collect();

        foreach (Series::all()->unique('youtube_chanel_name') as $series) {
            Log::info("Getting races for $series->full_name");
            $videos->push(Api::getRacesForSeries($series));
        }

        $newestYoutubeVideos = $videos->flatten(1);
        Log::info("Found {$newestYoutubeVideos->count()} races");
        $alreadyStoredRaces = Video::pluck('youtube_id');
        $alreadyStoredPotentialRaces = PotentialRaces::withTrashed()->pluck('youtube_id');

        foreach ($newestYoutubeVideos as $vid) {
            //Check if this race is already in the races table
            if (!$alreadyStoredRaces->contains($vid->contentDetails->videoId)) {
                //Check if this race is already in the PotentialRaces table
                if (!$alreadyStoredPotentialRaces->contains($vid->contentDetails->videoId)) {
                    //Make sure the video title does not contain any black listed words
                    if (!Str::contains($vid->snippet->title, config('youtube.excluded_key_words'))) {
                        Log::info("New video is being added to the DB. ID:{$vid->contentDetails->videoId} Title: {$vid->snippet->title}");
                        PotentialRaces::create([
                            'title' => $vid->snippet->title,
                            'youtube_id' => $vid->contentDetails->videoId,
                            'series_id' => $vid->series_id,
                            'season_id' => $vid->season_id,
                            'track_id' => $vid->track_id
                        ]);
                    }
                }
            }
        }
    }


    /**
     *  Send new races email report to admin
     *  This report has the last 7 days of potential races
     */
    public static function sendReport()
    {
        $races = PotentialRaces::where('email_sent', false)->get();

        Mail::to(config('mail.adminEmail'))
            ->send(new NewRacesReport($races));
        Log::info("Sent New Races Report email");

        foreach ($races as $race) {
            $race->email_sent = true;
            $race->save();
        }
    }
}