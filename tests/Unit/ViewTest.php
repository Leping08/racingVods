<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_race_is_viewable()
    {
        $race = factory(\App\Race::class)->create();
        $this->json('GET', '/api/race/' . $race->id);

        $this->assertInstanceOf(\App\Race::class, \App\View::first()->viewable);
    }

    /** @test */
    public function a_track_is_viewable()
    {
        $track = factory(\App\Track::class)->create();
        $this->json('GET', '/api/track/' . $track->id);

        $this->assertInstanceOf(\App\Track::class, \App\View::first()->viewable);
    }

    /** @test */
    public function a_series_is_viewable()
    {
        $series = factory(\App\Series::class)->create();
        $this->json('GET', '/api/series/' . $series->id);

        $this->assertInstanceOf(\App\Series::class, \App\View::first()->viewable);
    }
}
