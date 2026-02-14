@extends('layouts.admin')

@section('content')
<div class="header">
    <h1 class="title">Profil & Keamanan</h1>
</div>

@if(session('success'))
<div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; border: 1px solid #86efac;">
    {{ session('success') }}
</div>
@endif

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
    <!-- Update Profile -->
    <div class="card">
        <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: var(--text-main);">Informasi Profil</h3>
        
        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 1.25rem;">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 1.25rem;">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                Simpan Perubahan
            </button>
        </form>
    </div>

    <!-- Change Password -->
    <div class="card">
        <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: var(--text-main);">Ubah Password</h3>
        
        <form action="{{ route('admin.profile.password') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 1.25rem;">
                <label for="current_password">Password Saat Ini</label>
                <input type="password" id="current_password" name="current_password" required>
                @error('current_password')
                    <span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 1.25rem;">
                <label for="password">Password Baru</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                @enderror
                <small style="color: var(--text-muted); font-size: 0.75rem; margin-top: 0.25rem; display: block;">Minimal 8 karakter</small>
            </div>

            <div style="margin-bottom: 1.25rem;">
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                Ubah Password
            </button>
        </form>
    </div>
</div>

<!-- Account Info -->
<div class="card" style="margin-top: 2rem;">
    <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem; color: var(--text-main);">Informasi Akun</h3>
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
        <div>
            <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 0.25rem;">Terdaftar Sejak</p>
            <p style="font-weight: 600;">{{ $user->created_at->format('d M Y') }}</p>
        </div>
        <div>
            <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 0.25rem;">Terakhir Diperbarui</p>
            <p style="font-weight: 600;">{{ $user->updated_at->format('d M Y, H:i') }}</p>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        div[style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection
