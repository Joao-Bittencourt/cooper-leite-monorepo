<?php

declare(strict_types=1);

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('can store cooperative', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->postJson(route('cooperatives.store'), [
        'name' => 'Cooperative 1',
        'email' => 'jg4b8@example.com',
    ]);

    $response->assertStatus(201);

    $response->assertJsonStructure([
        'data' => [
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
        ]
    ]);
});
