<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrackTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_many_races()
    {
        $track = factory(\App\Track::class)->create();
        $race1 = factory(\App\Race::class)->create([
            'track_id' => $track->id
        ]);
        $race2 = factory(\App\Race::class)->create([
            'track_id' => $track->id
        ]);

        $this->assertInstanceOf(\App\Race::class, $track->races->first());
        $this->assertCount(2, $track->races);
    }
}
