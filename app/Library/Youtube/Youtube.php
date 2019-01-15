<?php


namespace App\Library\Youtube;


use Alaouy\Youtube\Youtube;
use Carbon\CarbonInterval;
use Illuminate\Support\Collection;

class YoutubeVideos
{
    public function getRacesForSeries(string $youtubeChanelName, int $minRaceLengthInMinutes = 60) : Collection
    {
        $youtube = new Youtube(config('youtube.key'));

        //Get the uploads playlist for a youtube chanel
        $chanelUploads = $youtube->getChannelByName($youtubeChanelName)->contentDetails->relatedPlaylists->uploads;

        //Get the last config('youtube.racesPerSeries') videos in the uploads playlist for a youtube chanel
        $newVideos = $youtube->getPlaylistItemsByPlaylistId($chanelUploads, '', config('youtube.racesPerSeries'));

        $longVideos = collect();

        //Loop over the last 50 videos and return the video if it's longer then 60 min
        foreach ($newVideos['results'] as $vid){
            $ISOvidDuration = $youtube->getVideoInfo($vid->contentDetails->videoId)->contentDetails->duration;
            $carbonDuration = CarbonInterval::create($ISOvidDuration);
            $vidDurationInMin = $carbonDuration->__get('minutes') + (60 * $carbonDuration->__get('hours'));
            if($vidDurationInMin >= $minRaceLengthInMinutes){
                $longVideos->push($vid);
            }
        }

        return $longVideos;
    }
}