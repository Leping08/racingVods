<?php

namespace Tests\Api;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeasonTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index()
    {
        $season1 = factory(\App\Season::class)->create([
            'name' => '2019'
        ]);

        $season2 = factory(\App\Season::class)->create([
            'name' => '2020'
        ]);

        $response = $this->json('GET', '/api/seasons');

        $response->assertStatus(200)
            ->assertJsonFragment($season1->toArray())
            ->assertJsonFragment($season2->toArray());
    }

    /** @test */
    public function series_id_season_id()
    {
        $series1 = factory(\App\Series::class)->create();
        $season1 = factory(\App\Season::class)->create();

        $race1 = factory(\App\Race::class)->create([
            'season_id' => $season1->id,
            'series_id' => $series1->id,
            'race_date' => Carbon::now()->subDays(1)
        ]);

        $race2 = factory(\App\Race::class)->create([
            'season_id' => $season1->id,
            'series_id' => $series1->id,
            'race_date' => Carbon::now()->subDays(2)
        ]);

        $race3 = factory(\App\Race::class)->create([
            'season_id' => $season1->id,
            'series_id' => $series1->id,
            'race_date' => Carbon::now()->subDays(3)
        ]);


        //Set up a different series and season to check if its in the json response
        $series2 = factory(\App\Series::class)->create();
        $season2 = factory(\App\Season::class)->create();

        $race4 = factory(\App\Race::class)->create([
            'season_id' => $season2->id,
            'series_id' => $series2->id,
            'race_date' => Carbon::now()->subDays(1)
        ]);


        $response = $this->json('GET', "/api/series/{$series1->id}/season/{$season1->id}");

        $response->assertStatus(200)
            ->assertJsonFragment($race1->toArray())
            ->assertJsonFragment($race2->toArray())
            ->assertJsonFragment($race3->toArray())
            ->assertDontSee($race4->name);
    }
}