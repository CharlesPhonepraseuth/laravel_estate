<?php

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertyTest extends TestCase
{

    use RefreshDatabase;


    public function test_send_not_found_on_unkown_property(): void
    {
        $response = $this->get('/biens/maison-test-25');

        $response->assertStatus(404);
    }

    public function test_redirect_on_wrong_property(): void
    {
        /** @var Property $property */
        $property = Property::factory()->create();
        $response = $this->get('/biens/maison-test-' . $property->id);
        $response->assertRedirectToRoute('property.show', ['property' => $property->id, 'slug' => $property->getSlug()]);
    }

    public function test_ok_on_property(): void
    {
        /** @var Property $property */
        $property = Property::factory()->create();
        $response = $this->get("/biens/{$property->getSlug()}-{$property->id}");
        $response->assertOk();
        $response->assertSee($property->title);
    }

    public function test_error_on_contact(): void
    {
        /** @var Property $property */
        $property = Property::factory()->create();
        $response = $this->post("/biens/{$property->id}/contact", [
            "firstname" => "John",
            "lastname" => "Doe",
            "phone" => "0600000000",
            "email" => "doe", // error
            "message" => "Pouvez-vous me recontacter ?",
        ]);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['email']);
        $response->assertSessionHasInput('email', 'doe');
    }

    public function test_ok_on_contact(): void
    {
        /** @var Property $property */
        $property = Property::factory()->create();
        $response = $this->post("/biens/{$property->id}/contact", [
            "firstname" => "John",
            "lastname" => "Doe",
            "phone" => "0600000000",
            "email" => "john@doe.fr",
            "message" => "Pouvez-vous me recontacter ?",
        ]);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');
    }
}
