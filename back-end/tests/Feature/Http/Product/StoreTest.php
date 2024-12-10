<?php

declare(strict_types=1);

use App\Models\Product;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('can store a product', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);
    $response = $this
        ->postJson('/api/products', [
            'name' => 'Product 1',
            'description' => 'Description 1',
            'unit' => 'Unit 1',
            'price' => '100.00',
            'active' => 1,
        ]);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'data' => [
            'id',
            'name',
            'description',
            'unit',
            'price',
            'created_at',
            'updated_at'
        ]
    ]);

    $products = Product::all();
    expect($products)
        ->toHaveCount(1)
        ->and($products->first()->name)->toBe('Product 1')
        ->and($products->first()->description)->toBe('Description 1')
        ->and($products->first()->unit)->toBe('Unit 1')
        ->and($products->first()->price)->toBe('100.00');
});

it('can not store a product without authentication', function () {
    $response = $this
        ->postJson('/api/products', [
            'name' => 'Product 1',
            'description' => 'Description 1',
            'unit' => 'Unit 1',
            'price' => '100.00',
            'active' => 1,
        ]);

    $response->assertStatus(401);

    expect($response->json()['message'])->toBe('Unauthenticated.');
});
