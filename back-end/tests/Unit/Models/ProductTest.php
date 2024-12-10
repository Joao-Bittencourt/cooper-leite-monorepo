<?php

declare(strict_types=1);

use App\Models\Product;

test('to array', function () {
    $product = Product::factory()->create()->fresh();

    expect(array_keys($product->toArray()))
        ->toEqual([
            'id',
            'name',
            'description',
            'unit',
            'price',
            'created_at',
            'updated_at',
            'active',
        ]);
});
