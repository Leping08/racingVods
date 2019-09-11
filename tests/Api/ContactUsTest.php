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

    /** @test */
    public function email_validation()
    {
        $contact = factory(ContactUs::class)->make([
            'email' => 'not_valid_email'
        ]);

        $response = $this->json('POST', '/api/contact-us', $contact->toArray());

        $response->assertStatus(422);


        $contact2 = factory(ContactUs::class)->make([
            'email' => ''
        ]);

        $response = $this->json('POST', '/api/contact-us', $contact2->toArray());

        $response->assertStatus(422);
    }

    /** @test */
    public function name_validation()
    {
        $contact = factory(ContactUs::class)->make([
            'name' => ''
        ]);

        $response = $this->json('POST', '/api/contact-us', $contact->toArray());

        $response->assertStatus(422);
    }

    /** @test */
    public function message_validation()
    {
        $contact = factory(ContactUs::class)->make([
            'message' => ''
        ]);

        $response = $this->json('POST', '/api/contact-us', $contact->toArray());

        $response->assertStatus(422);

    }
}