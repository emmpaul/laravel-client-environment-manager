<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ClientStoreTest extends TestCase
{
    use RefreshDatabase;

    private User $authenticatedUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->authenticatedUser = User::factory()->create();
        $this->actingAs($this->authenticatedUser);
    }

    #[Test]
    public function create_a_new_client_successfully()
    {
        $clientData = [
            'name' => 'Test Client',
        ];

        $response = $this->postJson(route('clients.store'), $clientData);

        $response->assertOk();
        $this->assertDatabaseHas('clients', $clientData);
    }

    #[Test]
    public function requires_a_name_to_create_a_client()
    {
        $response = $this->postJson(route('clients.store'), []);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors('name');
        $response->assertJsonFragment([
            'errors' => [
                'name' => ['The name field is required.']
            ]
        ]);
    }

    #[Test]
    public function prevents_creating_a_client_with_duplicate_name()
    {
        Client::create(['name' => 'Existing Client']);

        $duplicateClientData = [
            'name' => 'Existing Client',
        ];

        $response = $this->postJson(route('clients.store'), $duplicateClientData);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors('name');
        $response->assertJsonFragment([
            'errors' => [
                'name' => ['This client name is already taken.']
            ]
        ]);
    }

    #[Test]
    public function prevents_creating_a_client_with_non_string_name()
    {
        $invalidClientData = [
            'name' => 12345,
        ];

        $response = $this->postJson(route('clients.store'), $invalidClientData);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors('name');
        $response->assertJsonFragment([
            'errors' => [
                'name' => ['The name must be a string.']
            ]
        ]);
    }
}
