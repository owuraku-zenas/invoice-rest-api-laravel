<?php

use App\Models\User;

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

it('can create an item', function () {
    $response = $this->postJson('/api/v1/items', [
        'unit_price' => 10.99,
        'quantity' => 5,
        'description' => 'Sample item',
    ]);

    $response->assertStatus(201);
});

it('cannot create an item without required fields', function () {
    $response = $this->postJson('/api/v1/items', []);

    $response->assertStatus(422);

    $errors = $response->json('errors');

    $this->assertArrayHasKey('unit_price', $errors);
    $this->assertArrayHasKey('quantity', $errors);
    $this->assertArrayHasKey('description', $errors);
});

it('can list items', function () {
    $response = $this->getJson('/api/v1/items');

    $response->assertStatus(200);
});


it('can calculate the amount of an item', function () {
    $response = $this->postJson('/api/v1/items', [
        'unit_price' => 10.99,
        'quantity' => 5,
        'description' => 'Sample item',
    ]);

    $response->assertStatus(201);
    $item = $response->json('data');
    $this->assertEquals(10.99 * 5, $item['amount']);
});

