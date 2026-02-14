@extends('layouts.admin')

@section('content')
<div class="header">
    <h2>Pengaturan Toko</h2>
</div>

@if(session('success'))
    <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem;">
        {{ session('success') }}
    </div>
@endif

<div class="card" style="max-width: 800px;">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div>
                <h3 style="margin-bottom: 1rem; color: var(--primary);">Kontak & Lokasi</h3>
                
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Nomor WhatsApp (628xxx)</label>
                    <input type="text" name="whatsapp_number" value="{{ $setting->whatsapp_number }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Telepon Toko (Opsional)</label>
                    <input type="text" name="store_phone" value="{{ $setting->store_phone }}" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Jam Buka</label>
                    <input type="text" name="opening_hours" value="{{ $setting->opening_hours }}" required placeholder="Contoh: Senin - Sabtu, 08:00 - 21:00" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Alamat Lengkap</label>
                    <textarea name="address" rows="3" required style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">{{ $setting->address }}</textarea>
                </div>
            </div>

            <div>
                <h3 style="margin-bottom: 1rem; color: var(--primary);">Website & Embed</h3>
                
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Tagline Website</label>
                    <input type="text" name="tagline" value="{{ $setting->tagline }}" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Google Maps Embed (Iframe src link only)</label>
                    <input type="text" name="maps_embed" value="{{ $setting->maps_embed }}" placeholder="https://www.google.com/maps/embed?..." style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
                    <small style="color: var(--text-muted)">Paste link yang ada di dalam src="..." dari kode embed maps.</small>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top: 1rem;">Simpan Pengaturan</button>
    </form>
</div>
@endsection
