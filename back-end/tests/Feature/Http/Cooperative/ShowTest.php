<?php

declare(strict_types=1);

use App\Models\Cooperative;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('can get cooperative', function () {
    $user = User::factory()->create();
    $cooperative = Cooperative::factory()->create()->fresh();

    Sanctum::actingAs($user);

    $response = $this->getJson(route('cooperatives.show', $cooperative));

    $response->assertStatus(200);

    $response->assertJsonStructure([
        'id',
        'name',
        'email',
        'created_at',
        'updated_at',
        'active',
    ]);
});
