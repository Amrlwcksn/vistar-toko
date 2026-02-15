@extends('layouts.admin')

@section('styles')
<style>
    .search-form {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        max-width: 400px;
    }
    .pagination {
        margin-top: 1.5rem;
        display: flex;
        list-style: none;
        padding: 0;
        gap: 0.25rem;
        justify-content: center;
    }
    .pagination li .page-link {
        padding: 0.5rem 0.875rem;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        text-decoration: none;
        color: var(--text-primary);
        font-size: 0.875rem;
        transition: all 0.2s;
        background: white;
    }
    .pagination li.active .page-link {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }
    .pagination li.disabled .page-link {
        color: var(--text-muted);
        cursor: not-allowed;
        background: #f8fafc;
    }
    .pagination li:not(.active):not(.disabled) .page-link:hover {
        background: var(--bg-body);
        border-color: var(--primary-light);
    }
</style>
@endsection

@section('content')
<div class="header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1 style="font-size: 1.875rem; font-weight: 800; color: var(--text-primary); letter-spacing: -0.02em;">Manajemen Produk</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Tambah Produk</a>
</div>

@if(session('success'))
    <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem;">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <form action="{{ route('admin.products.index') }}" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Cari nama produk atau kategori..." value="{{ request('search') }}" style="flex: 1;">
        <button type="submit" class="btn btn-secondary">Cari</button>
        @if(request('search'))
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary" style="background: #f1f5f9;">Reset</a>
        @endif
    </form>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th width="80">Gambar</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="img" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                        @else
                            <div style="width: 50px; height: 50px; background: #f1f5f9; border-radius: 4px;"></div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $product->name }}</strong><br>
                        <small style="color: var(--text-muted)">{{ Str::limit($product->description, 50) }}</small>
                    </td>
                    <td>{{ $product->category->name ?? '-' }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>
                        @if($product->status == 'active')
                            <span style="background: #e0f2fe; color: #0369a1; padding: 0.25rem 0.5rem; border-radius: 99px; font-size: 0.75rem; font-weight: 600;">Aktif</span>
                        @else
                            <span style="background: #f1f5f9; color: #64748b; padding: 0.25rem 0.5rem; border-radius: 99px; font-size: 0.75rem; font-weight: 600;">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-secondary" style="padding: 0.5rem 0.75rem; font-size: 0.8125rem;">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 0.5rem 0.75rem; font-size: 0.8125rem;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 3rem;">Belum ada produk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="pagination">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
