<?php

use App\Models\Category;
use App\Models\Plant;
use App\Models\BibitMedia;
use App\Models\Penyiraman;
use App\Models\Pemupukan;
use App\Models\Perawatan;
use App\Models\MasaPanen;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can get all plants', function () {
    $category = Category::create([
        'nama_kategori' => 'Sayuran',
    ]);

    Plant::create([
        'nama_umum' => 'Cabai',
        'nama_latin' => 'Capsicum annum',
        'deskripsi' => 'Tanaman cabai merah',
        'kategori_id' => $category->id,
    ]);

    $response = $this->getJson('/api/get_all_tanaman.php');

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => [
                [
                    'nama_umum' => 'Cabai',
                    'nama_kategori' => 'Sayuran',
                ]
            ]
        ]);
});

test('can get plant by id', function () {
    $category = Category::create([
        'nama_kategori' => 'Sayuran',
    ]);

    $plant = Plant::create([
        'nama_umum' => 'Tomat',
        'nama_latin' => 'Solanum lycopersicum',
        'kategori_id' => $category->id,
    ]);

    $response = $this->getJson('/api/get_tanaman_by_id.php?id=' . $plant->id);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => [
                'id' => $plant->id,
                'nama_umum' => 'Tomat',
                'nama_kategori' => 'Sayuran',
            ]
        ]);
});

test('can get plants by category id', function () {
    $cat1 = Category::create(['nama_kategori' => 'Sayuran']);
    $cat2 = Category::create(['nama_kategori' => 'Hias']);

    Plant::create(['nama_umum' => 'Bayam', 'kategori_id' => $cat1->id]);
    Plant::create(['nama_umum' => 'Mawar', 'kategori_id' => $cat2->id]);

    $response = $this->getJson('/api/get_tanaman_by_kategori.php?kategori_id=' . $cat1->id);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => [
                ['nama_umum' => 'Bayam']
            ]
        ]);
});

test('can search plants by query', function () {
    $category = Category::create(['nama_kategori' => 'Sayuran']);

    Plant::create(['nama_umum' => 'Cabai Rawit', 'nama_latin' => 'Capsicum frutescens', 'kategori_id' => $category->id]);
    Plant::create(['nama_umum' => 'Wortel', 'nama_latin' => 'Daucus carota', 'kategori_id' => $category->id]);

    $response = $this->getJson('/api/search_tanaman.php?query=Cabai');

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => [
                ['nama_umum' => 'Cabai Rawit']
            ]
        ]);
});

test('can get full plant details including care guidelines', function () {
    $category = Category::create(['nama_kategori' => 'Sayuran']);

    $plant = Plant::create([
        'nama_umum' => 'Cabai Merah',
        'kategori_id' => $category->id,
    ]);

    BibitMedia::create(['tanaman_id' => $plant->id, 'jenis_bibit' => 'Biji cabai']);
    Penyiraman::create(['tanaman_id' => $plant->id, 'frekuensi' => '1-2 kali sehari']);
    Pemupukan::create(['tanaman_id' => $plant->id, 'jenis_pupuk' => 'Kompos']);
    Perawatan::create(['tanaman_id' => $plant->id, 'jenis_perawatan' => 'Penyiangan']);
    MasaPanen::create(['tanaman_id' => $plant->id, 'durasi_tanam' => '90 hari']);

    $response = $this->getJson('/api/get_detail_tanaman.php?id=' . $plant->id);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => [
                'tanaman' => [
                    'id' => $plant->id,
                    'nama_umum' => 'Cabai Merah',
                ],
                'bibit_media' => [
                    'jenis_bibit' => 'Biji cabai',
                ],
                'penyiraman' => [
                    'frekuensi' => '1-2 kali sehari',
                ],
                'pemupukan' => [
                    'jenis_pupuk' => 'Kompos',
                ],
                'perawatan' => [
                    ['jenis_perawatan' => 'Penyiangan']
                ],
                'masa_panen' => [
                    'durasi_tanam' => '90 hari',
                ]
            ]
        ]);
});
