@extends('layouts.admin')

@section('content')
<div class="header">
    <h2>Edit Produk</h2>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>
</div>

<div class="card" style="max-width: 800px;">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div>
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Nama Produk</label>
                    <input type="text" name="name" value="{{ $product->name }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
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
                    <input type="number" name="price" value="{{ $product->price }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
                </div>
            </div>
            
            <div>
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Foto Produk</label>
                    @if($product->image_url)
                        <div style="margin-bottom: 0.5rem;">
                            <img src="{{ $product->image_url }}" alt="Current Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 0.5rem;">
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
                    <small style="color: var(--text-muted)">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Status</label>
                    <select name="status" required style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
                        <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Deskripsi</label>
            <textarea name="description" rows="4" style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">{{ $product->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Produk</button>
    </form>
</div>
@endsection
