<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RaceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_track()
    {
        $race = factory(\App\Race::class)->create();

        $this->assertInstanceOf(\App\Track::class, $race->track);
    }

    /** @test */
    public function it_belongs_to_a_series()
    {
        $race = factory(\App\Race::class)->create();

        $this->assertInstanceOf(\App\Series::class, $race->series);
    }

    /** @test */
    public function it_belongs_to_a_season()
    {
        $race = factory(\App\Race::class)->create();

        $this->assertInstanceOf(\App\Season::class, $race->season);
    }

    /** @test */
    public function it_has_many_videos()
    {
        $race = factory(\App\Race::class)->create();
        $video1 = factory(\App\Video::class)->create([
            'race_id' => $race->id
        ]);
        $video2 = factory(\App\Video::class)->create([
            'race_id' => $race->id
        ]);

        $this->assertInstanceOf(\App\Video::class, $race->videos->first());
        $this->assertCount(2, $race->videos);
    }

    /** @test */
    public function it_can_be_new()
    {
        $race = factory(\App\Race::class)->create();
        $this->assertIsBool($race->new);
    }

    /** @test */
    public function it_is_not_new_a_week_after_being_created()
    {
        $race = factory(\App\Race::class)->create();
        $this->assertTrue($race->new);
        $race->created_at = Carbon::now()->subDays(8);
        $race->save();
        $this->assertNotTrue($race->new);
    }

    /** @test */
    public function it_has_a_next_race_in_the_season()
    {
        $series = factory(\App\Series::class)->create();
        $season = factory(\App\Season::class)->create();
        $race1 = factory(\App\Race::class)->create([
            'series_id' => $series->id,
            'season_id' => $season->id,
            'race_date' => Carbon::now()->subDays(3)
        ]);
        $race2 = factory(\App\Race::class)->create([
            'series_id' => $series->id,
            'season_id' => $season->id,
            'race_date' => Carbon::now()->subDays(3)
        ]);

        $this->assertInstanceOf(\App\Race::class, $race1->next());
        $this->assertEquals($race1->next()->id, $race2->id);
    }

    /** @test */
    public function it_has_a_previous_race_in_the_season()
    {
        $series = factory(\App\Series::class)->create();
        $season = factory(\App\Season::class)->create();
        $race1 = factory(\App\Race::class)->create([
            'series_id' => $series->id,
            'season_id' => $season->id,
            'race_date' => Carbon::now()->subDays(3)
        ]);
        $race2 = factory(\App\Race::class)->create([
            'series_id' => $series->id,
            'season_id' => $season->id,
            'race_date' => Carbon::now()->subDays(3)
        ]);

        $this->assertInstanceOf(\App\Race::class, $race2->previous());
        $this->assertEquals($race2->previous()->id, $race1->id);
    }
}
