<?php

declare(strict_types=1);

use App\Models\Product;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('count active products', function () {
    $user = User::factory()->create();
    Product::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->getJson(route('products.activeCount'));

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'count'
    ]);

    expect($response->json()['count'])->toBe(1);
});
