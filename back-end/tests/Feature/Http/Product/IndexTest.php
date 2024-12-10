<?php

declare(strict_types=1);

use App\Models\Product;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('can get products', function () {
    $user = User::factory()->create();
    Product::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->getJson('/api/products');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'name',
                'description',
                'unit',
                'price',
                'active',
                'created_at',
                'updated_at',
            ]
        ]
    ]);
});
