<?php

declare(strict_types=1);

it('can register', function () {
    $response = $this->postJson(route('register.register'), [
        'name' => 'test',
        'email' => 'd0G1K@example.com',
        'password' => 'password',
        'c_password' => 'password',
    ]);

    $response->assertStatus(200);

    expect($response->json()['message'])->toBe('User register successfully.')
        ->and($response->json()['data']['token'])->not()->toBeNull()
        ->and($response->json()['data']['name'])->toBe('test');
});

it('can not register with invalid data', function () {
    $response = $this->postJson(route('register.register'), [
        'name' => '',
        'email' => 'd0G1K@example.com',
        'password' => 'password',
        'c_password' => 'password',
    ]);

    $response->assertStatus(422);

    expect($response->json()['message'])->toBe('The name field is required.');
});

it('can not register with invalid email', function () {
    $response = $this->postJson(route('register.register'), [
        'name' => 'test',
        'email' => 'test',
        'password' => 'password',
        'c_password' => 'password',
    ]);

    $response->assertStatus(422);

    expect($response->json()['message'])->toBe('The email field must be a valid email address.');
});

it('can not register with invalid password', function () {
    $response = $this->postJson(route('register.register'), [
        'name' => 'test',
        'email' => 'd0G1K@example.com',
        'password' => 'password',
        'c_password' => 'test',
    ]);

    $response->assertStatus(422);

    expect($response->json()['message'])->toBe('The c password field must match password.');
});
