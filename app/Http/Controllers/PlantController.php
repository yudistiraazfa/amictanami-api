<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function index()
    {
        $plants = Plant::with('category')->orderBy('nama_umum', 'asc')->get();

        $data = $plants->map(function ($plant) {
            return [
                'id' => $plant->id,
                'nama_umum' => $plant->nama_umum,
                'nama_latin' => $plant->nama_latin,
                'deskripsi' => $plant->deskripsi,
                'gambar_url' => $plant->gambar_url,
                'gambar_full_url' => $plant->gambar_full_url,
                'kategori_id' => $plant->kategori_id,
                'nama_kategori' => $plant->category?->nama_kategori,
            ];
        });

        if ($data->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No data found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function show(Request $request)
    {
        $id = $request->query('id', $request->route('id'));

        if (empty($id)) {
            return response()->json([
                'success' => false,
                'message' => 'ID parameter is required',
            ], 200);
        }

        $plant = Plant::with('category')->find($id);

        if (!$plant) {
            return response()->json([
                'success' => false,
                'message' => 'Tanaman not found with ID: ' . $id,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $plant->id,
                'nama_umum' => $plant->nama_umum,
                'nama_latin' => $plant->nama_latin,
                'deskripsi' => $plant->deskripsi,
                'gambar_url' => $plant->gambar_url,
                'gambar_full_url' => $plant->gambar_full_url,
                'kategori_id' => $plant->kategori_id,
                'created_at' => $plant->created_at,
                'updated_at' => $plant->updated_at,
                'nama_kategori' => $plant->category?->nama_kategori,
            ],
        ], 200);
    }

    public function byCategory(Request $request)
    {
        $kategoriId = $request->query('kategori_id', $request->route('kategori_id'));

        $plants = Plant::with('category')
            ->where('kategori_id', $kategoriId)
            ->orderBy('nama_umum', 'asc')
            ->get();

        $data = $plants->map(function ($plant) {
            return [
                'id' => $plant->id,
                'nama_umum' => $plant->nama_umum,
                'nama_latin' => $plant->nama_latin,
                'deskripsi' => $plant->deskripsi,
                'gambar_url' => $plant->gambar_url,
                'gambar_full_url' => $plant->gambar_full_url,
                'kategori_id' => $plant->kategori_id,
                'nama_kategori' => $plant->category?->nama_kategori,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function search(Request $request)
    {
        $query = $request->query('query', '');

        $plants = Plant::with('category')
            ->where('nama_umum', 'LIKE', "%{$query}%")
            ->orWhere('nama_latin', 'LIKE', "%{$query}%")
            ->orderBy('nama_umum', 'asc')
            ->get();

        $data = $plants->map(function ($plant) {
            return [
                'id' => $plant->id,
                'nama_umum' => $plant->nama_umum,
                'nama_latin' => $plant->nama_latin,
                'deskripsi' => $plant->deskripsi,
                'gambar_url' => $plant->gambar_url,
                'gambar_full_url' => $plant->gambar_full_url,
                'kategori_id' => $plant->kategori_id,
                'nama_kategori' => $plant->category?->nama_kategori,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function detail(Request $request)
    {
        $id = $request->query('id', $request->route('id'));

        $plant = Plant::with(['category', 'bibitMedia', 'penyiraman', 'pemupukan', 'perawatan', 'masaPanen'])->find($id);

        if (!$plant) {
            return response()->json([
                'success' => false,
                'message' => 'Tanaman not found',
            ], 404);
        }

        $tanamanData = [
            'id' => $plant->id,
            'nama_umum' => $plant->nama_umum,
            'nama_latin' => $plant->nama_latin,
            'deskripsi' => $plant->deskripsi,
            'gambar_url' => $plant->gambar_url,
            'gambar_full_url' => $plant->gambar_full_url,
            'kategori_id' => $plant->kategori_id,
            'created_at' => $plant->created_at,
            'updated_at' => $plant->updated_at,
            'nama_kategori' => $plant->category?->nama_kategori,
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'tanaman' => $tanamanData,
                'bibit_media' => $plant->bibitMedia,
                'penyiraman' => $plant->penyiraman,
                'pemupukan' => $plant->pemupukan,
                'perawatan' => $plant->perawatan,
                'masa_panen' => $plant->masaPanen,
            ],
        ], 200);
    }
}
