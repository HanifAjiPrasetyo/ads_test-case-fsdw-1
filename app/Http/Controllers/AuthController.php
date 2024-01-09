<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return back()->with('error', 'Login gagal');
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        if ($token) {
            return redirect('/api/karyawan')->with('success', 'Berhasil login');
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return redirect('/')->with('success', 'Berhasil logout');
    }
}
