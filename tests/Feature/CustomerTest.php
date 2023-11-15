<?php

use App\Models\User;

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

it('can create a customer', function () {
    $response = $this->postJson('/api/v1/customers', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone_number' => '233559616904'
    ]);

    $response->assertStatus(201);
});

it('cannot create a customer without required fields', function () {
    $response = $this->postJson('/api/v1/customers', []);

    $response->assertStatus(422);

    $errors = $response->json('errors');

    $this->assertArrayHasKey('name', $errors);
    $this->assertArrayHasKey('email', $errors);
    $this->assertArrayHasKey('phone_number', $errors);
});
