<?php


namespace App\Library;


use App\Video;
use GuzzleHttp\Client;


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

        //TODO: Write a test for this class
        try{
            $res = $client->get($this->video->thumbnail);
            if($res->getStatusCode() == 200){
                $this->save(true);
            } else {
                $this->save(false);
            }
        } catch (\Exception $exception) {
            $this->save(false);
        }
    }

    private function save(bool $bool){
        $this->video->valid_thumbnail = $bool;
        $this->video->save();
    }
}