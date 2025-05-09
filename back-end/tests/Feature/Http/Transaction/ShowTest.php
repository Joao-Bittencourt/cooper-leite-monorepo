<?php

declare(strict_types=1);

use App\Models\Transaction;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('can get transaction', function () {
    $user = User::factory()->create();
    $transaction = Transaction::factory()->create()->fresh();

    Sanctum::actingAs($user);

    $response = $this->getJson('/api/transactions/' . $transaction->id);

    $response->assertStatus(200);

    $response->assertJsonStructure([
        'id',
        'product_id',
        'cooperative_id',
        'type',
        'amount',
        'created_by',
        'created_at',
        'updated_at',
        'active',
        'product' => [
            'id',
            'name',
            'description',
            'unit',
            'price',
            'created_at',
            'updated_at',
            'active',
        ],
        'cooperative' => [
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
            'active',
        ]
    ]);
});

it('cannot get transaction', function () {
    $user = User::factory()->create();
    Transaction::factory()->create();
    Sanctum::actingAs($user);

    $response = $this->getJson('/api/transactions/99999999');

    $response->assertStatus(404);
});
