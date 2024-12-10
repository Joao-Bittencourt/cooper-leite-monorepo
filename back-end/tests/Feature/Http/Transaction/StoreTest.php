<?php

declare(strict_types=1);

use App\Models\Cooperative;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('can store transaction', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $product = Product::factory()->create();

    $cooperative = Cooperative::factory()->create();
    $amount = number_format(fake()->randomFloat(4, 1, 30), 4, '.', '');

    $response = $this->postJson(route('transactions.store'), [
        'product_id' => $product->id,
        'cooperative_id' => $cooperative->id,
        'type' => 'I',
        'amount' => $amount,
        'created_by' => $user->id,
        'active' => 1,
    ]);

    $response->assertStatus(201);
    $response->assertJson([
        'data' => [
            'product_id' => $product->id,
            'cooperative_id' => $cooperative->id,
            'type' => 'I',
            'amount' => $amount,
            'created_by' => $user->id,
            'active' => 1,
            'created_at' => $response->json('data.created_at'),
            'updated_at' => $response->json('data.updated_at'),
        ]
    ]);

    $transactions = Transaction::all();
    expect($transactions)
        ->toHaveCount(1)
        ->and($transactions->first()->product_id)->toBe($product->id)
        ->and($transactions->first()->cooperative_id)->toBe($cooperative->id)
        ->and($transactions->first()->type)->toBe('I')
        ->and((string) $transactions->first()->amount)->toBe($amount)
        ->and($transactions->first()->created_by)->toBe($user->id)
        ->and($transactions->first()->active)->toBe(1);
});
