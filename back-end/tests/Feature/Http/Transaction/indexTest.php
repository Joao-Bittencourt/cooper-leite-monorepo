<?php

declare(strict_types=1);

use App\Models\Transaction;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('can get transactions', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    Transaction::factory()->create()->fresh();

    $response = $this->getJson(route('transactions.index'));

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'product_id',
                'cooperative_id',
                'type',
                'amount',
                'created_at',
                'updated_at',
            ]
        ]
    ]);
});
