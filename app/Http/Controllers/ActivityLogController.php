<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function store(Request $request)
    {
        $userId = $request->input('user_id');
        $judul = $request->input('judul');
        $jam = $request->input('jam');
        $tanggal = $request->input('tanggal');
        $tipe = $request->input('tipe');

        if (empty($userId) || empty($judul) || empty($jam) || empty($tanggal) || empty($tipe)) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak lengkap.',
            ], 200);
        }

        ActivityLog::create([
            'user_id' => $userId,
            'judul' => $judul,
            'jam' => $jam,
            'tanggal' => $tanggal,
            'tipe' => $tipe,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Log aktivitas berhasil ditambahkan.',
        ], 200);
    }

    public function index(Request $request)
    {
        $userId = $request->input('user_id');

        if (empty($userId)) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak lengkap.',
            ], 200);
        }

        $logs = ActivityLog::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        $data = $logs->map(function ($log) {
            return [
                'id' => $log->id,
                'judul' => $log->judul,
                'jam' => $log->jam,
                'tanggal' => $log->tanggal,
                'tipe' => $log->tipe,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }
}
