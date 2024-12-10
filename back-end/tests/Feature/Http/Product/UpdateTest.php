<?php

declare(strict_types=1);

use App\Models\Product;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('can update a product', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create()->fresh();

    Sanctum::actingAs($user);

    $response = $this->putJson('/api/products/' . $product->id, [
        'name' => 'Product 1',
        'description' => 'Description 1',
        'unit' => 'Unit 1',
        'price' => '100.00',
        'active' => 1,
    ]);

    $response->assertStatus(200);

    expect($response->json()['message'])->toBe('Product updated successfully');
});

it('can not update a product without authentication', function () {
    $product = Product::factory()->create()->fresh();

    $response = $this->putJson('/api/products/' . $product->id, [
        'name' => 'Product 1',
        'description' => 'Description 1',
        'unit' => 'Unit 1',
        'price' => '100.00',
        'active' => 1,
    ]);

    $response->assertStatus(401);

    expect($response->json()['message'])->toBe('Unauthenticated.');
});

it('can not update a product with invalid data', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create()->fresh();

    Sanctum::actingAs($user);

    $response = $this->putJson('/api/products/' . $product->id, [
        'name' => '',
        'description' => 'Description 1',
        'unit' => 'Unit 1',
        'price' => '100.00',
        'active' => 1,
    ]);

    $response->assertStatus(422);

    expect($response->json()['message'])->toBe('The name field is required.');
});
