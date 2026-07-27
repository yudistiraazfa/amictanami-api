<?php

use App\Models\User;
use App\Models\TanamCareHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('user can save tanamcare history without image', function () {
    $user = User::create([
        'nama' => 'Test User',
        'email' => 'tanamcare@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->postJson('/api/add_tanamcare_history.php', [
        'user_id' => $user->id,
        'title' => 'Hama Ulat Daun',
        'explanation' => 'Daun berlubang',
        'solution' => 'Semprot minyak nimba',
        'date' => '2026-07-28 00:00:00',
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'History saved successfully.',
        ]);

    $this->assertDatabaseHas('tanamcare_history', [
        'user_id' => $user->id,
        'title' => 'Hama Ulat Daun',
    ]);
});

test('user can save tanamcare history with base64 image', function () {
    Storage::fake('public');

    $user = User::create([
        'nama' => 'Test User',
        'email' => 'tanamcare2@example.com',
        'password' => bcrypt('password123'),
    ]);

    // 1x1 transparent GIF base64 string
    $base64Image = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=';

    $response = $this->postJson('/api/add_tanamcare_history.php', [
        'user_id' => $user->id,
        'title' => 'Bercak Daun Tomat',
        'explanation' => 'Bercak cokelat pada daun',
        'solution' => 'Kurangi penyiraman dan gunakan fungisida',
        'image_base64' => $base64Image,
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'History saved successfully.',
        ]);

    $history = TanamCareHistory::where('user_id', $user->id)->first();
    expect($history)->not->toBeNull();
    expect($history->image_path)->not->toBeNull();
});

test('user can get tanamcare history list with image_url', function () {
    $user = User::create([
        'nama' => 'Test User',
        'email' => 'tanamcare3@example.com',
        'password' => bcrypt('password123'),
    ]);

    TanamCareHistory::create([
        'user_id' => $user->id,
        'title' => 'Kutu Daun Cabai',
        'date' => '2026-07-28 00:00:00',
        'explanation' => 'Daun menggulung',
        'solution' => 'Gunakan sabun pencuci piring encer',
        'image_path' => 'uploads/tanamcare/test.jpg',
    ]);

    $response = $this->postJson('/api/get_tanamcare_history.php', [
        'user_id' => $user->id,
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => [
                [
                    'title' => 'Kutu Daun Cabai',
                    'image_path' => 'uploads/tanamcare/test.jpg',
                ]
            ]
        ]);
});
