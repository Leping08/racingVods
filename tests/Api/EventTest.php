<?php

namespace Tests\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index()
    {
        $races = factory(\App\Race::class, 2)->create();

        $response = $this->json('GET', '/api/races');

        $response->assertStatus(200)
            ->assertJsonFragment($races[0]->toArray())
            ->assertJsonFragment($races[0]->track->toArray())
            ->assertJsonFragment($races[0]->series->toArray())
            ->assertJsonFragment($races[0]->season->toArray())
            ->assertJsonFragment($races[1]->toArray())
            ->assertJsonFragment($races[1]->track->toArray())
            ->assertJsonFragment($races[1]->series->toArray())
            ->assertJsonFragment($races[1]->season->toArray());
    }
}