@extends('layouts.admin')

@section('content')
<div class="header">
    <h2>Tambah Layanan</h2>
    <a href="{{ route('admin.services.index') }}" class="btn" style="background: #e2e8f0; color: var(--text-main);">Kembali</a>
</div>

<div class="card" style="max-width: 600px;">
    <form action="{{ route('admin.services.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 1rem;">
            <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Nama Layanan</label>
            <input type="text" name="name" required style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Harga (Rp)</label>
            <input type="number" name="price" required style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Deskripsi</label>
            <textarea name="description" rows="3" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;"></textarea>
        </div>

        <div style="margin-bottom: 2rem;">
            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                <input type="checkbox" name="is_highlight" value="1">
                <span style="color: #64748b;">Tampilkan di Landing Page (Highlight)</span>
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Layanan</button>
    </form>
</div>
@endsection
