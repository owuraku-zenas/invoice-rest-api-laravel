<?php

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


it('can authenticate a user', function () {
    $user = Factory::factoryForModel(User::class)->create();

    $response = $this->actingAs($user)->getJson('/api/user');

    $response->assertStatus(200);
});

it('cannot access protected routes without authentication', function () {
    $response = $this->getJson('/api/v1/items');

    $response->assertStatus(401);
});
