@extends('layouts.admin')

@section('content')
<div class="header">
    <h2>Kelola Gallery</h2>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">+ Upload Foto</a>
</div>

@if(session('success'))
    <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem;">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <table>
        <thead>
            <tr>
                <th width="100">Foto</th>
                <th>Layanan</th>
                <th>Caption</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($galleries as $gallery)
            <tr>
                <td>
                    <img src="{{ $gallery->image_url }}" alt="img" style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
                </td>
                <td>{{ $gallery->service->name ?? '-' }}</td>
                <td>{{ $gallery->caption ?? '-' }}</td>
                <td>
                    <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin hapus foto ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="font-size: 0.875rem;">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; color: var(--text-muted);">Belum ada foto gallery.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
