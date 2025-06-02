<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PemilikKosan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('pages.auth.register.index');
    }

    public function register(Request $request)
    {
        // Validasi umum
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:admin,penyewa,pemilik',
        ]);

        // Validasi tambahan untuk role pemilik
        if ($request->role === 'pemilik') {
            $request->validate([
                'nama'   => 'required|string|max:255',
                'kontak' => 'required|string|max:20',
            ]);
        }

        // Simpan user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        // Simpan data pemilik jika role adalah pemilik
        if ($user->role === 'pemilik') {
            PemilikKosan::create([
                'nama'    => $request->nama,
                'kontak'  => $request->kontak,
                'user_id' => $user->id,
            ]);
        }

        // Login dan redirect
        Auth::login($user);

        return match ($user->role) {
            'admin'   => redirect()->route('admin.dashboard'),
            'pemilik' => redirect()->route('pemilik.dashboard'),
            'penyewa' => redirect()->route('penyewa.dashboard'),
        };
    }
}
