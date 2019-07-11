<?php

namespace Tests\Unit;

use App\Library\Thumbnail;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThumbnailImageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_video_thumbnail_can_be_validated()
    {
        $race = factory(\App\Race::class)->create();
        $video = factory(\App\Video::class)->create([
            'youtube_id' => 'EMBJ9jUQyH4',
            'race_id' => $race->id
        ]);

        $this->assertFalse($video->valid_thumbnail);
        (new Thumbnail($video))->validate();
        $video->fresh();
        $this->assertFalse($video->valid_thumbnail);


        $race2 = factory(\App\Race::class)->create();
        $video2 = factory(\App\Video::class)->create([
            'youtube_id' => '-ESdkdJFrDs',
            'race_id' => $race2->id
        ]);

        $this->assertTrue($video2->valid_thumbnail);
        (new Thumbnail($video2))->validate();
        $video2->fresh();
        $this->assertTrue($video2->valid_thumbnail);


        $race3 = factory(\App\Race::class)->create();
        $video3 = factory(\App\Video::class)->create([
            'youtube_id' => '4Q58LQolqrs',
            'race_id' => $race2->id
        ]);

        $this->assertTrue($video3->valid_thumbnail);
        $video3->valid_thumbnail = false;
        $video3->save();
        $this->assertFalse($video3->valid_thumbnail);
        (new Thumbnail($video3))->validate();
        $video3->fresh();
        $this->assertTrue($video3->valid_thumbnail);
    }
}