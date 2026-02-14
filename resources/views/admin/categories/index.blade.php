@extends('layouts.admin')

@section('content')
<div class="header">
    <h2>Kelola Kategori</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
</div>

@if(session('success'))
    <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem;">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem;">
        {{ $errors->first() }}
    </div>
@endif

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Nama Kategori</th>
                <th>Slug</th>
                <th>Jumlah Produk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td><strong>{{ $category->name }}</strong></td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->products->count() }} Produk</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn" style="background: #e2e8f0; color: var(--text-main); font-size: 0.875rem;">Edit</a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin hapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="font-size: 0.875rem;">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; color: var(--text-muted);">Belum ada kategori.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
