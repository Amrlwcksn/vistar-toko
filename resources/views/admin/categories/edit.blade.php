@extends('layouts.admin')

@section('content')
<div class="header">
    <h2>Edit Kategori</h2>
    <a href="{{ route('admin.categories.index') }}" class="btn" style="background: #e2e8f0; color: var(--text-main);">Kembali</a>
</div>

<div class="card" style="max-width: 600px;">
    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div style="margin-bottom: 1rem;">
            <label style="display: block; margin-bottom: 0.5rem; color: #64748b;">Nama Kategori</label>
            <input type="text" name="name" value="{{ $category->name }}" required style="width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
            @error('name')
                <small style="color: #ef4444; margin-top: 0.25rem; display: block;">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Kategori</button>
    </form>
</div>
@endsection
