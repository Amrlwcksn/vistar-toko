<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'current_password.current_password' => 'Password saat ini tidak sesuai.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.profile.index')
            ->with('success', 'Password berhasil diubah!');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}
