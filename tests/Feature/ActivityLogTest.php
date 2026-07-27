<?php

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can add activity log', function () {
    $user = User::create([
        'nama' => 'Test User',
        'email' => 'loguser@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->postJson('/api/add_log.php', [
        'user_id' => $user->id,
        'judul' => 'Penyiraman Manual',
        'jam' => '18:44',
        'tanggal' => '27 Juli 2026',
        'tipe' => 'MANUAL',
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'Log aktivitas berhasil ditambahkan.',
        ]);

    $this->assertDatabaseHas('activity_logs', [
        'user_id' => $user->id,
        'judul' => 'Penyiraman Manual',
        'tipe' => 'MANUAL',
    ]);
});

test('user can fetch their activity logs', function () {
    $user = User::create([
        'nama' => 'Test User',
        'email' => 'loguser@example.com',
        'password' => bcrypt('password123'),
    ]);

    ActivityLog::create([
        'user_id' => $user->id,
        'judul' => 'Pemupukan NPK',
        'jam' => '09:00',
        'tanggal' => '28 Juli 2026',
        'tipe' => 'PUPUK',
    ]);

    $response = $this->postJson('/api/get_logs.php', [
        'user_id' => $user->id,
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => [
                [
                    'judul' => 'Pemupukan NPK',
                    'jam' => '09:00',
                    'tanggal' => '28 Juli 2026',
                    'tipe' => 'PUPUK',
                ]
            ]
        ]);
});
