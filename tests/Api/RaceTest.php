<?php

namespace Tests\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RaceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index()
    {
        $race = factory(\App\Race::class)->create();

        $response = $this->json('GET', '/api/races');

        $response->assertStatus(200)
            ->assertJsonFragment($race->toArray())
            ->assertJsonFragment($race->track->toArray())
            ->assertJsonFragment($race->series->toArray())
            ->assertJsonFragment($race->season->toArray());
    }

    /** @test */
    public function show()
    {
        $race = factory(\App\Race::class)->create();

        $response = $this->json('GET', "/api/race/{$race->id}");

        $response->assertStatus(200)
            ->assertJsonFragment($race->toArray())
            ->assertJsonFragment($race->track->toArray())
            ->assertJsonFragment($race->series->toArray())
            ->assertJsonFragment($race->season->toArray());
    }

    /** @test */
    public function latest()
    {
        $races = factory(\App\Race::class, 10)->create();

        $response = $this->json('GET', '/api/races/latest');

        $response->assertStatus(200)
            ->assertJsonFragment($races[9]->toArray())
            ->assertJsonFragment($races[8]->toArray())
            ->assertJsonFragment($races[7]->toArray())
            ->assertJsonFragment($races[6]->toArray())
            ->assertJsonFragment($races[5]->toArray())
            ->assertDontSee($races[4]->name)
            ->assertDontSee($races[3]->name)
            ->assertDontSee($races[2]->name)
            ->assertDontSee($races[1]->name)
            ->assertDontSee($races[0]->name);
    }
}
