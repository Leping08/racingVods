<?php

namespace Tests\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrackTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index()
    {
        $tracks = factory(\App\Track::class, 2)->create([
            'length' => 10
        ]);

        $response = $this->json('GET', '/api/tracks');

        $response->assertStatus(200)
            ->assertJsonFragment($tracks[0]->toArray())
            ->assertJsonFragment($tracks[1]->toArray());
    }

    /** @test */
    public function show()
    {
        $track = factory(\App\Track::class)->create([
            'length' => 10
        ]);
        $race = factory(\App\Race::class)->create([
            'track_id' => $track->id
        ]);

        $response = $this->json('GET', "/api/track/{$track->id}");

        $response->assertStatus(200)
            ->assertJsonFragment($track->toArray())
            ->assertJsonFragment($race->toArray());
    }
}