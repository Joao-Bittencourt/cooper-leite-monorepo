<?php

declare(strict_types=1);

use App\Models\Cooperative;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\HasMany;

test('to array', function () {
    $cooperative = Cooperative::factory()->create()->fresh();

    expect(array_keys($cooperative->toArray()))
        ->toEqual([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
            'active',
        ]);
});

test('Cooperative has transactions', function () {
    $cooperative = Cooperative::factory()->create()->fresh();
    $transaction = Transaction::factory()->create([
        'cooperative_id' => $cooperative->id,
    ]);

    expect($cooperative->transactions()->count())->toBe(1);
    expect($cooperative->transactions())->toBeInstanceOf(HasMany::class);
    expect($cooperative->transactions()->first()->id)->toBe($transaction->id);
});
