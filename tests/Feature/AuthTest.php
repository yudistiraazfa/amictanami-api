<?php

use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can register successfully', function () {
    $response = $this->postJson('/api/register', [
        'nama' => 'Tanami User',
        'email' => 'tanami@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'User was created.',
        ]);

    $this->assertDatabaseHas('users', [
        'email' => 'tanami@example.com',
        'nama' => 'Tanami User',
    ]);
});

test('user registration fails when password confirmation does not match', function () {
    $response = $this->postJson('/api/register', [
        'nama' => 'Tanami User',
        'email' => 'tanami@example.com',
        'password' => 'password123',
        'password_confirmation' => 'wrongpassword',
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => false,
            'message' => 'Password confirmation does not match.',
        ]);
});

test('user registration fails when email exists', function () {
    User::create([
        'nama' => 'Existing User',
        'email' => 'tanami@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->postJson('/api/register', [
        'nama' => 'Tanami User',
        'email' => 'tanami@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => false,
            'message' => 'Email already exists.',
        ]);
});

test('user can login successfully', function () {
    $user = User::create([
        'nama' => 'Tanami User',
        'email' => 'tanami@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->postJson('/api/login', [
        'email' => 'tanami@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'Login successful.',
            'data' => [
                'id' => $user->id,
                'nama' => 'Tanami User',
                'email' => 'tanami@example.com',
            ],
        ]);
});

test('user login fails with invalid password', function () {
    User::create([
        'nama' => 'Tanami User',
        'email' => 'tanami@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->postJson('/api/login', [
        'email' => 'tanami@example.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => false,
            'message' => 'Invalid password.',
        ]);
});

test('user can request forgot password verification code', function () {
    User::create([
        'nama' => 'Tanami User',
        'email' => 'tanami@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->postJson('/api/forgot_password.php', [
        'email' => 'tanami@example.com',
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'Verification code generated.',
        ]);

    $this->assertDatabaseHas('password_resets', [
        'email' => 'tanami@example.com',
    ]);
});

test('user can verify password reset code', function () {
    User::create([
        'nama' => 'Tanami User',
        'email' => 'tanami@example.com',
        'password' => bcrypt('password123'),
    ]);

    PasswordReset::create([
        'email' => 'tanami@example.com',
        'code' => '123456',
        'token' => '123456',
        'expires_at' => now()->addMinutes(15),
    ]);

    $response = $this->postJson('/api/verify_code.php', [
        'email' => 'tanami@example.com',
        'code' => '123456',
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'Code verified.',
        ]);
});

test('user can reset password with reset token', function () {
    User::create([
        'nama' => 'Tanami User',
        'email' => 'tanami@example.com',
        'password' => bcrypt('oldpassword'),
    ]);

    PasswordReset::create([
        'email' => 'tanami@example.com',
        'code' => '123456',
        'token' => 'myresettoken123',
        'expires_at' => now()->addMinutes(15),
    ]);

    $response = $this->postJson('/api/reset_password.php', [
        'email' => 'tanami@example.com',
        'reset_token' => 'myresettoken123',
        'password' => 'newpassword123',
        'password_confirmation' => 'newpassword123',
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'Password has been reset.',
        ]);
});
