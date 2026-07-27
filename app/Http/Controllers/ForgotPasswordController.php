<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function sendCode(Request $request)
    {
        $email = $request->input('email');

        if (empty($email)) {
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

        $code = (string) rand(100000, 999999);
        $expiresAt = now()->addMinutes(15);

        PasswordReset::where('email', $email)->delete();

        PasswordReset::create([
            'email' => $email,
            'code' => $code,
            'token' => $code,
            'expires_at' => $expiresAt,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Verification code generated.',
            'data' => [
                'code' => $code,
            ],
        ], 200);
    }

    public function verifyCode(Request $request)
    {
        $email = $request->input('email');
        $code = $request->input('code');

        if (empty($email) || empty($code)) {
            return response()->json([
                'success' => false,
                'message' => 'Incomplete data.',
            ], 200);
        }

        $reset = PasswordReset::where('email', $email)
            ->where(function ($query) use ($code) {
                $query->where('code', $code)->orWhere('token', $code);
            })
            ->first();

        if (!$reset) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid code.',
            ], 200);
        }

        if (now()->greaterThan($reset->expires_at)) {
            return response()->json([
                'success' => false,
                'message' => 'Code expired.',
            ], 200);
        }

        $resetToken = Str::random(64);
        $reset->update([
            'reset_token' => $resetToken,
            'token' => $resetToken,
            'is_verified' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Code verified.',
            'reset_token' => $resetToken,
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        $email = $request->input('email');
        $resetToken = $request->input('reset_token');
        $password = $request->input('password');
        $passwordConfirmation = $request->input('password_confirmation');

        if (empty($email) || empty($resetToken) || empty($password) || empty($passwordConfirmation)) {
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

        $reset = PasswordReset::where('email', $email)
            ->where(function ($query) use ($resetToken) {
                $query->where('reset_token', $resetToken)->orWhere('token', $resetToken);
            })
            ->first();

        if (!$reset) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid reset token.',
            ], 200);
        }

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->update([
                'password' => Hash::make($password),
            ]);
        }

        PasswordReset::where('email', $email)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Password has been reset.',
        ], 200);
    }
}
