<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VideosController extends Controller
{
    public function store(Request $request) //TODO Not needed with nova
    {
        $video = $request->validate([
            'youtube_id' => 'required|max:255',
            'youtube_start_time' => 'required|numeric',
            'race_id' => 'required|numeric'
        ]);

        $newVideo = Video::create($video);
        Log::info("Video ID: $newVideo->id was created.");
        return $newVideo;
    }
}
