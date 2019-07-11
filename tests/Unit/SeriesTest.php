<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_many_races()
    {
        $series = factory(\App\Series::class)->create();
        $race1 = factory(\App\Race::class)->create([
            'series_id' => $series->id
        ]);
        $race2 = factory(\App\Race::class)->create([
            'series_id' => $series->id
        ]);

        $this->assertInstanceOf(\App\Race::class, $series->races->first());
        $this->assertCount(2, $series->races);
    }
}
