<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $id = $request->input('id');

        if (empty($id)) {
            return response()->json([
                'success' => false,
                'message' => 'User ID required.',
            ], 200);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 200);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'nama' => $user->nama,
                'email' => $user->email,
                'created_at' => $user->created_at,
            ],
        ], 200);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $nama = $request->input('nama');
        $email = $request->input('email');
        $password = $request->input('password');

        if (empty($id) || empty($nama) || empty($email)) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak lengkap',
            ], 200);
        }

        $emailCheck = User::where('email', $email)->where('id', '!=', $id)->exists();

        if ($emailCheck) {
            return response()->json([
                'success' => false,
                'message' => 'Email sudah digunakan oleh akun lain',
            ], 200);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 200);
        }

        $updateData = [
            'nama' => $nama,
            'email' => $email,
        ];

        if (!empty($password)) {
            $updateData['password'] = Hash::make($password);
        }

        $user->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui',
        ], 200);
    }
}
