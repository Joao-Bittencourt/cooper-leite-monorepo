<?php

declare(strict_types=1);

use App\Models\Cooperative;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('count active cooperatives', function () {
    $user = User::factory()->create();
    Cooperative::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->getJson(route('cooperatives.activeCount'));

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'count'
    ]);

    expect($response->json()['count'])->toBe(1);
});
