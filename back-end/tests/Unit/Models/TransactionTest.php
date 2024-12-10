<?php

declare(strict_types=1);

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

test('to array', function () {
    $transaction = Transaction::factory()->create()->fresh();

    expect(array_keys($transaction->toArray()))
        ->toEqual([
            'id',
            'product_id',
            'cooperative_id',
            'type',
            'amount',
            'created_by',
            'created_at',
            'updated_at',
            'active',
        ]);
});

test('Transaction belongs to product', function () {
    $transaction = Transaction::factory()->create()->fresh();
    $product = $transaction->product;

    expect($product->id)->toBe($transaction->product_id);
    expect($transaction->product())->toBeInstanceOf(BelongsTo::class);
    expect($transaction->product()->count())->toBe(1);
});

test('Transaction belongs to cooperative', function () {
    $transaction = Transaction::factory()->create()->fresh();
    $cooperative = $transaction->cooperative;

    expect($cooperative->id)->toBe($transaction->cooperative_id);
    expect($transaction->cooperative())->toBeInstanceOf(BelongsTo::class);
    expect($transaction->cooperative()->count())->toBe(1);
});

test('Transaction belongs to user', function () {
    $transaction = Transaction::factory()->create()->fresh();
    $user = $transaction->user;

    expect($user->id)->toBe($transaction->created_by);
    expect($transaction->user())->toBeInstanceOf(BelongsTo::class);
    expect($transaction->user()->count())->toBe(1);
});
