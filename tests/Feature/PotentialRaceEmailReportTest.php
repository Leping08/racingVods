<?php

namespace Tests\Unit;

use App\Library\PotentialRaces\FindPotentialRaces;
use App\Mail\NewRacesReport;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PotentialRaceEmailReportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_potential_race_is_marked_as_sent_once_the_email_has_been_sent()
    {
        Mail::fake();
        Mail::assertNothingSent();

        $potentialRace = factory(\App\PotentialRace::class)->create([
            'email_sent' => false
        ]);

        FindPotentialRaces::sendReport();

        $potentialRace->fresh();

        $this->assertEquals(1, $potentialRace->first()->email_sent);

        Mail::assertSent(NewRacesReport::class);
    }
}