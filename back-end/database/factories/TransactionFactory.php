<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Cooperative;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first() ?? Product::factory()->create();
        $cooperative = Cooperative::inRandomOrder()->first() ?? Cooperative::factory()->create();
        $user = User::inRandomOrder()->first() ?? User::factory()->create();

        return [
            'product_id' => $product->id,
            'cooperative_id' => $cooperative->id,
            'amount' => fake()->randomFloat(2, 1, 30),
            'type' => fake()->randomElement(['I', 'O']),
            'created_by' => $user->id,
            'active' => 1,
        ];
    }
}
