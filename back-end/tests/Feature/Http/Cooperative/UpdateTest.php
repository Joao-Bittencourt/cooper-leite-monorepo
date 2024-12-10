<?php

declare(strict_types=1);

use App\Models\Cooperative;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('can update cooperative', function () {
    $user = User::factory()->create();
    $cooperative = Cooperative::factory()->create()->fresh();

    Sanctum::actingAs($user);

    $response = $this->putJson(route('cooperatives.update', $cooperative), [
        'name' => 'Cooperative 1',
        'email' => 'jg4b8@example.com',
    ]);

    $response->assertStatus(200);

    expect($response->json()['message'])->toBe('Cooperative updated successfully');
});
