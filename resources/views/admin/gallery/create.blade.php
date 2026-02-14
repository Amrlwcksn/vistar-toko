@extends('layouts.admin')

@section('content')
<div class="header">
    <h2>Upload Gallery</h2>
    <a href="{{ route('admin.gallery.index') }}" class="btn" style="background: #e2e8f0; color: var(--text-main);">Kembali</a>
</div>

<div class="card" style="max-width: 600px;">
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="margin-bottom: 1rem;">
            <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Pilih Layanan</label>
            <select name="service_id" required style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
                <option value="">-- Pilih Layanan --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Foto</label>
            <input type="file" name="image" accept="image/*" required style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Caption (Opsional)</label>
            <input type="text" name="caption" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
        </div>

        <button type="submit" class="btn btn-primary">Upload Foto</button>
    </form>
</div>
@endsection
