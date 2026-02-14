@extends('layouts.admin')

@section('content')
<div class="header">
    <h2>Tambah Produk</h2>
    <a href="{{ route('admin.products.index') }}" class="btn" style="background: #e2e8f0; color: var(--text-main);">Kembali</a>
</div>

<div class="card" style="max-width: 800px;">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div>
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Nama Produk</label>
                    <input type="text" name="name" required style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Kategori</label>
                    <select name="category_id" required style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Harga (Rp)</label>
                    <input type="number" name="price" required style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
                </div>
            </div>
            
            <div>
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Foto Produk</label>
                    <input type="file" name="image" accept="image/*" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Status</label>
                    <select name="status" required style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                </div>
            </div>
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Deskripsi</label>
            <textarea name="description" rows="4" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Produk</button>
    </form>
</div>
@endsection
