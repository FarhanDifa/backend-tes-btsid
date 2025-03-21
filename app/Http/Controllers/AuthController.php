<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    // LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'name' => ['required']
        ]);
 
        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user tidak ditemukan atau password salah
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah',
                'status' => 401
            ]);
        }

        // Buat token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'status' => 200
        ]);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        if ($request->user()) {
            // Hapus token yang dipakai
            $tokenId = $request->user()->currentAccessToken()->id;
            $request->user()->tokens()->where('id', $tokenId)->delete();
    
            return response()->json([
                'message' => 'Logout berhasil',
                'status' => 200
            ]);
        }
    
        return response()->json([
            'message' => 'User tidak ditemukan atau sudah logout',
            'status' => 401
        ]);
    }
}
