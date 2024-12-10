<?php

declare(strict_types=1);

use App\Models\Product;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('can get product', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create()->fresh();

    Sanctum::actingAs($user);

    $response = $this->getJson('/api/products/' . $product->id);

    $response->assertStatus(200);

    $response->assertJsonStructure([
        'id',
        'name',
        'description',
        'unit',
        'price',
        'active',
        'created_at',
        'updated_at',
    ]);
});

it('cannot get product', function () {
    $user = User::factory()->create();
    Product::factory()->create();
    Sanctum::actingAs($user);

    $response = $this->getJson('/api/products/99999999');

    $response->assertStatus(404);
});
