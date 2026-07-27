<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $nama = $request->input('nama');
        $email = $request->input('email');
        $password = $request->input('password');
        $passwordConfirmation = $request->input('password_confirmation');

        if (empty($nama) || empty($email) || empty($password) || empty($passwordConfirmation)) {
            return response()->json([
                'success' => false,
                'message' => 'Incomplete data.',
            ], 200);
        }

        if ($password !== $passwordConfirmation) {
            return response()->json([
                'success' => false,
                'message' => 'Password confirmation does not match.',
            ], 200);
        }

        if (User::where('email', $email)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Email already exists.',
            ], 200);
        }

        $user = User::create([
            'nama' => $nama,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User was created.',
            'data' => [
                'id' => $user->id,
                'nama' => $user->nama,
                'email' => $user->email,
            ],
        ], 200);
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (empty($email) || empty($password)) {
            return response()->json([
                'success' => false,
                'message' => 'Incomplete data.',
            ], 200);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email not found.',
            ], 200);
        }

        if (!Hash::check($password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid password.',
            ], 200);
        }

        $token = Str::random(64);
        $user->update(['token' => $token]);

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'data' => [
                'id' => $user->id,
                'nama' => $user->nama,
                'email' => $user->email,
                'token' => $token,
            ],
        ], 200);
    }
}
