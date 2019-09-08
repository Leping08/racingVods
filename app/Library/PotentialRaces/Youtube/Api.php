<?php


namespace App\Library\PotentialRaces\Youtube;


use Alaouy\Youtube\Youtube;
use App\Library\PotentialRaces\Track\GuessTrack;
use App\Season;
use App\Series;
use Carbon\CarbonInterval;
use Illuminate\Support\Collection;

class Api
{
    public static function getRacesForSeries(Series $series): Collection
    {
        $youtube = new Youtube(config('youtube.key'));

        //Get the uploads playlist for the series youtube chanel
        $chanelUploads = $youtube->getChannelByName($series->youtube_chanel_name)->contentDetails->relatedPlaylists->uploads;

        //Get the last config('youtube.races_per_series') videos in the uploads playlist for a youtube chanel
        $newVideos = $youtube->getPlaylistItemsByPlaylistId($chanelUploads, '', config('youtube.races_per_series'));

        $potentialNewRaces = collect();

        //Loop over the latest videos and return the video if it's longer then the min_race_time
        foreach ($newVideos['results'] as $vid) {
            $ISOvidDuration = $youtube->getVideoInfo($vid->contentDetails->videoId)->contentDetails->duration;
            $carbonDuration = CarbonInterval::create($ISOvidDuration);
            $vidDurationInMin = $carbonDuration->__get('minutes') + (60 * $carbonDuration->__get('hours'));
            if ($vidDurationInMin >= $series->min_race_time) {
                $vid->series_id = $series->id;
                $vid->season_id = Season::current();
                $vid->track_id = GuessTrack::handle($vid->snippet->title);
                $potentialNewRaces->push($vid);
            }
        }
        return $potentialNewRaces;
    }
}