<?php


namespace App\Library;


use App\Video;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;


class Thumbnail
{
    private $video;

    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    public function validate()
    {
        $client = new Client();

        try {
            $res = $client->get("https://img.youtube.com/vi/{$this->video->youtube_id}/maxresdefault.jpg");
            if ($res->getStatusCode() == 200) {
                Log::info("The video thumbnail for video id: {$this->video->id} is good");
                $this->save(true);
            } else {
                Log::info("The http status for the thumbnail of video id: {$this->video->id} is {$res->getStatusCode()}");
                $this->save(false);
            }
        } catch (\Exception $exception) {
            Log::info("An exception was thrown trying to get the video thumbnail for video id: {$this->video->id}");
            Log::info($exception->getMessage());
            $this->save(false);
        }
    }

    private function save(bool $bool)
    {
        $this->video->valid_thumbnail = $bool;
        $this->video->save();
    }
}