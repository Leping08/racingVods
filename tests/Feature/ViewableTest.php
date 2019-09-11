<?php


namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_view_is_recorded_when_a_race_is_viewed()
    {
        $race = factory(\App\Race::class)->create();

        $response = $this->json('GET', '/api/race/' . $race->id);

        $response->assertStatus(200)
            ->assertJsonFragment($race->toArray());

        $this->assertDatabaseHas('views', [
            'viewable_id' => $race->id,
            'viewable_type' => 'App\Race'
        ]);

        $response = $this->json('GET', '/api/race/' . $race->id);

        $response->assertStatus(200)
            ->assertJsonFragment($race->toArray());

        $this->assertEquals(2, \App\Race::find($race->id)->views->count());
    }

    /** @test */
    public function a_view_is_recorded_when_a_track_is_viewed()
    {
        $track = factory(\App\Track::class)->create([
            'length' => 10
        ]);

        $response = $this->json('GET', '/api/track/' . $track->id);

        $response->assertStatus(200)
            ->assertJsonFragment($track->toArray());

        $this->assertDatabaseHas('views', [
            'viewable_id' => $track->id,
            'viewable_type' => 'App\Track'
        ]);

        $response = $this->json('GET', '/api/track/' . $track->id);

        $response->assertStatus(200)
            ->assertJsonFragment($track->toArray());

        $this->assertEquals(2, \App\Track::find($track->id)->views->count());
    }

    /** @test */
    public function a_view_is_recorded_when_a_series_is_viewed()
    {
        $series = factory(\App\Series::class)->create();

        $response = $this->json('GET', '/api/series/' . $series->id);

        $response->assertStatus(200)
            ->assertJsonFragment($series->toArray());

        $this->assertDatabaseHas('views', [
            'viewable_id' => $series->id,
            'viewable_type' => 'App\Series'
        ]);

        $response = $this->json('GET', '/api/series/' . $series->id);

        $response->assertStatus(200)
            ->assertJsonFragment($series->toArray());

        $this->assertEquals(2, \App\Series::find($series->id)->views->count());
    }
}