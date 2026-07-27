<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can get user profile by id', function () {
    $user = User::create([
        'nama' => 'User Profile Test',
        'email' => 'profile@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->postJson('/api/get_profile.php', [
        'id' => $user->id,
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'nama' => 'User Profile Test',
                'email' => 'profile@example.com',
            ],
        ]);
});

test('can update user profile name and email', function () {
    $user = User::create([
        'nama' => 'Old Name',
        'email' => 'old@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->postJson('/api/update_profile.php', [
        'id' => $user->id,
        'nama' => 'New Name',
        'email' => 'new@example.com',
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'Profil berhasil diperbarui',
        ]);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'nama' => 'New Name',
        'email' => 'new@example.com',
    ]);
});

test('cannot update profile if email is taken by another user', function () {
    User::create([
        'nama' => 'Existing User',
        'email' => 'taken@example.com',
        'password' => bcrypt('password123'),
    ]);

    $user = User::create([
        'nama' => 'My Profile',
        'email' => 'myprofile@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->postJson('/api/update_profile.php', [
        'id' => $user->id,
        'nama' => 'My Profile Updated',
        'email' => 'taken@example.com',
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => false,
            'message' => 'Email sudah digunakan oleh akun lain',
        ]);
});
