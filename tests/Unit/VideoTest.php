<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_race()
    {
        $race = factory(\App\Race::class)->create();
        $video = factory(\App\Video::class)->create([
            'race_id' => $race->id
        ]);

        $this->assertInstanceOf(\App\Race::class, $video->race);
    }
}
