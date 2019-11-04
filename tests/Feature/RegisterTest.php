<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
/*     public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    } */

    public function testRegistersSuccessfully()
    {
        $payload = [
            'name' => 'JohnTest',
            'email' => 'johntest@test.te',
            'password' => 'toptal123',
            'password_confirmation' => 'toptal123',
        ];

        $this->json('POST', 'api/register', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);
    }

    public function testRequiresPasswordEmailAndName()
    {
        $this->json('POST', 'api/register')
            ->assertStatus(422)
            ->assertJson([
                'name' => ['The name field is required.'],
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]);
    }

    public function testRequirePasswordConfirmation()
    {
        $payload = [
            'name' => 'JohnTest',
            'email' => 'johntest@toptal.com',
            'password' => 'toptal123',
        ];

        $this->json('POST', 'api/register', $payload)
            ->assertStatus(422)
            ->assertJsonStructure([
                'password' => ['The password confirmation does not match.'],
            ]);
    }
}
