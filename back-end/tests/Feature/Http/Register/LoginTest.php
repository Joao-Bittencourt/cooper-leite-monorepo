<?php

declare(strict_types=1);

use App\Models\User;

it('can login', function () {
    $user = User::factory()->create(['password' => 'password']);

    $response = $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertStatus(200);

    expect($response->json()['message'])->toBe('User login successfully.')
        ->and($response->json()['data']['token'])->not()->toBeNull()
        ->and($response->json()['data']['name'])->toBe($user->name);
});

it('can not login with invalid data', function () {
    $response = $this->postJson('/api/login', [
        'email' => 'd0G1K@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(401);

    expect($response->json()['message'])->toBe('Unauthenticated.')
        ->and($response->json()['error'])->toBe('Unauthenticated');
});
