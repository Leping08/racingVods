<?php


namespace App\Library;


use App\Library\Youtube\YoutubeVideos;
use App\Mail\NewRacesReport;
use App\PotentialRaces;
use App\Race;
use App\Series;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FindPotentialRaces
{
    /**
     *
     */
    public function handel()
    {
        $youtubeChanelNames = Series::pluck('youtube_chanel_name')->unique();

        $videos = collect();

        foreach ($youtubeChanelNames as $name) {
            Log::info("Getting races for {$name}");
            $videos->push((new YoutubeVideos())->getRacesForSeries($name));
        }

        $newestYoutubeVideos = $videos->flatten(1);
        $alreadyStoredRaces = Race::pluck('youtube_id');
        $alreadyStoredPotentialRaces = PotentialRaces::withTrashed()->pluck('youtube_id');

        foreach ($newestYoutubeVideos as $vid){
            //Check if this race is already in the races table
            if(! $alreadyStoredRaces->contains($vid->contentDetails->videoId)){
                //Check if this race is already in the PotentialRaces table
                if(! $alreadyStoredPotentialRaces->contains($vid->contentDetails->videoId)){
                    //Make sure the video title does not contain the word qualifying
                    if(! str_contains($vid->snippet->title, ['qualifying', 'Qualifying'])){
                        Log::info("New video is being added to the DB. ID:{$vid->contentDetails->videoId} Title: {$vid->snippet->title}");
                        PotentialRaces::create([
                            'title' => $vid->snippet->title,
                            'youtube_id' => $vid->contentDetails->videoId
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
    public function sendReport()
    {
        $date = Carbon::today()->subDays(7);
        $races = PotentialRaces::where('created_at', '>=', $date)->get();

        Mail::to(config('mail.adminEmail'))
            ->send(new NewRacesReport($races));
    }
}