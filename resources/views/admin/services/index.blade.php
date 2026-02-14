@extends('layouts.admin')

@section('content')
<div class="header">
    <h2>Kelola Layanan</h2>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">+ Tambah Layanan</a>
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
                <th>Nama Layanan</th>
                <th>Harga</th>
                <th>Highlight</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
            <tr>
                <td>
                    <strong>{{ $service->name }}</strong><br>
                    <small style="color: var(--text-muted)">{{ Str::limit($service->description, 50) }}</small>
                </td>
                <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                <td>
                    @if($service->is_highlight)
                        <span style="background: #dbeafe; color: #1e40af; padding: 0.25rem 0.5rem; border-radius: 99px; font-size: 0.75rem;">Utama</span>
                    @else
                        <span style="color: var(--text-muted); font-size: 0.75rem;">-</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.services.edit', $service) }}" class="btn" style="background: #e2e8f0; color: var(--text-main); font-size: 0.875rem;">Edit</a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="font-size: 0.875rem;">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; color: var(--text-muted);">Belum ada layanan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
