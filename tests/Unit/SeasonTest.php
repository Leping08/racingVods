<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeasonTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_many_races()
    {
        $season = factory(\App\Season::class)->create();
        $race1 = factory(\App\Race::class)->create([
            'season_id' => $season->id
        ]);
        $race2 = factory(\App\Race::class)->create([
            'season_id' => $season->id
        ]);

        $this->assertInstanceOf(\App\Race::class, $season->races->first());
        $this->assertCount(2, $season->races);
    }
}
