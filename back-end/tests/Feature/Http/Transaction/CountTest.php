<?php

declare(strict_types=1);

use App\Models\Transaction;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('count active transactions', function () {
    $user = User::factory()->create();
    Transaction::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->getJson(route('transactions.activeCount'));

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'count'
    ]);

    expect($response->json()['count'])->toBe(1);
});
