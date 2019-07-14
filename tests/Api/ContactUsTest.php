<?php

namespace Tests\Api;

use App\ContactUs;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactUsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function store()
    {
        $contact = factory(ContactUs::class)->make();

        $response = $this->json('POST', '/api/contact-us', $contact->toArray());

        $response->assertStatus(201)
            ->assertJsonFragment($contact->toArray());

        $this->assertDatabaseHas('contact_us', $contact->toArray());
    }
}