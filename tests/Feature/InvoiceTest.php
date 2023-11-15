<?php

use App\Models\Customer;
use App\Models\Item;
use App\Models\User;

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $this->customer = Customer::factory()->create();
    $this->item1 = Item::factory()->create();
    $this->item2 = Item::factory()->create();
});

// Create invoice
it('can create an invoice', function () {
    $response = $this->postJson('/api/v1/invoices', [
        'customer_id' => $this->customer->id,
        'due_date' => now()->addDays(30),
        'items' => [
            [
                'item_id' => $this->item1->id,
                'quantity' => 1,
            ],
            [
                'item_id' => $this->item2->id,
                'quantity' => 1,
            ],
        ],
    ]);

    $response->assertStatus(201);
});

// Check required fields
it('cannot create an invoice without required fields', function () {
    $response = $this->postJson('/api/v1/invoices', []);

    $response->assertStatus(422);

    $errors = $response->json('errors');

    $this->assertArrayHasKey('customer_id', $errors);
    $this->assertArrayHasKey('due_date', $errors);
    $this->assertArrayHasKey('items', $errors);
});

// Check whether customer exists
it('cannot create an invoice with invalid customer id', function () {
    $response = $this->postJson('/api/v1/invoices', [
        'customer_id' => 20,
        'issue_date' => now(),
        'due_date' => now()->addDays(30),
        'items' => [
            [
                'item_id' => $this->item1->id,
                'quantity' => 1,
            ],
            [
                'item_id' => $this->item2->id,
                'quantity' => 1,
            ],
        ],
    ]);

    $response->assertStatus(422);

    $errors = $response->json('errors');

    // Assert that the 'customer_id' key exists in the errors array
    $this->assertArrayHasKey('customer_id', $errors);

    // Assert the error message
    $this->assertEquals(['The selected customer id is invalid.'], $errors['customer_id']);
});

// Item exists
it('cannot create an invoice with invalid item id', function () {
    $response = $this->postJson('/api/v1/invoices', [
        'customer_id' => $this->customer->id,
        'issue_date' => now(),
        'due_date' => now()->addDays(30),
        'items' => [
            [
                'item_id' => 100,
                'quantity' => 1,
            ],
        ],
    ]);

    $response->assertStatus(422);

    $errors = $response->json('errors');

    // Assert that the "items.0.item_id" key exists in the errors array
    $this->assertArrayHasKey('items.0.item_id', $errors);

    // Assert the error message
    $this->assertEquals(['The selected items.0.item_id is invalid.'], $errors['items.0.item_id']);
});

// invoice amount calculated properly
it('can calculate the correct invoice price', function () {
    $response = $this->postJson('/api/v1/invoices', [
        'customer_id' => $this->customer->id,
        'due_date' => now()->addDays(30),
        'items' => [
            [
                'item_id' => $this->item1->id,
                'quantity' => 1,
            ],
            [
                'item_id' => $this->item2->id,
                'quantity' => 1,
            ],
        ],
    ]);

    $response->assertStatus(201);
    $invoice = $response->json('data');

    $this->assertEquals($this->item1->unit_price * 1 + $this->item2->unit_price * 1, $invoice['amount']);
});

// Not enough items
it('cannot create an invoice with requested item quantity not available', function () {
    $response = $this->postJson('/api/v1/invoices', [
        'customer_id' => $this->customer->id,
        'issue_date' => now(),
        'due_date' => now()->addDays(30),
        'items' => [
            [
                'item_id' => $this->item1->id,
                'quantity' => $this->item1->quantity+1,
            ],
        ],
    ]);

    $response->assertStatus(422);

    $errors = $response->json('errors');

    error_log($errors['message']);

    $this->assertEquals('Item ' . $this->item1->id . ' is insufficient', $errors['message']);
});



