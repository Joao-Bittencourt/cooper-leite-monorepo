<?php

declare(strict_types=1);

use App\Models\Cooperative;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('can get all cooperatives', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    Cooperative::factory()->create();

    $response = $this->getJson(route('cooperatives.index'));

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'name',
                'email',
                'created_at',
                'updated_at',
                'active',
            ]
        ]
    ]);
});
