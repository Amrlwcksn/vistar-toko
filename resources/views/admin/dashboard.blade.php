@extends('layouts.admin')

@section('content')
<div class="header">
    <h2 class="title">Dashboard Overview</h2>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem;">
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
            <div>
                <p style="color: var(--text-muted); font-size: 0.875rem; font-weight: 600;">Total Layanan</p>
                <h3 style="font-size: 2.5rem; font-weight: 800; color: var(--text-main); line-height: 1.2;">{{ \App\Models\Service::count() }}</h3>
            </div>
            <div style="background: var(--primary); padding: 0.75rem; border-radius: 0.75rem; color: var(--accent);">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
        </div>
        <p style="font-size: 0.875rem; color: #16a34a; display: flex; align-items: center; gap: 0.25rem;">
            <span style="font-weight: 600;">Aktif</span> di website
        </p>
    </div>
    
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
            <div>
                <p style="color: var(--text-muted); font-size: 0.875rem; font-weight: 600;">Total Produk</p>
                <h3 style="font-size: 2.5rem; font-weight: 800; color: var(--text-main); line-height: 1.2;">{{ \App\Models\Product::count() }}</h3>
            </div>
             <div style="background: var(--primary); padding: 0.75rem; border-radius: 0.75rem; color: var(--accent);">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
        </div>
        <p style="font-size: 0.875rem; color: #16a34a; display: flex; align-items: center; gap: 0.25rem;">
            <span style="font-weight: 600;">{{ \App\Models\Product::where('status', 'active')->count() }}</span> produk aktif
        </p>
    </div>

    <div class="card" style="display: flex; flex-direction: column; justify-content: center;">
         <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <div style="background: #fffbeb; padding: 0.75rem; border-radius: 0.75rem; color: #f59e0b;">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </div>
            <div>
                <h3 style="font-weight: 700;">Lihat Website</h3>
                <p style="font-size: 0.875rem; color: var(--text-muted);">Cek tampilan pengunjung</p>
            </div>
         </div>
        <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary" style="justify-content: center; width: 100%;">
            Buka VistarToko →
        </a>
    </div>
</div>

<div style="margin-top: 2rem; display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
    <!-- Recent Products Table -->
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.1rem; font-weight: 700;">Produk Terbaru</h3>
            <a href="{{ route('admin.products.index') }}" style="font-size: 0.875rem; color: var(--primary); text-decoration: none; font-weight: 600;">Lihat Semua</a>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\Product::with('category')->latest()->take(5)->get() as $product)
                    <tr>
                        <td style="display: flex; align-items: center; gap: 0.75rem;">
                            <div style="width: 40px; height: 40px; background: #f3f4f6; border-radius: 6px; overflow: hidden;">
                                <img src="{{ $product->image_url ?? 'https://via.placeholder.com/40' }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <span style="font-weight: 500;">{{ $product->name }}</span>
                        </td>
                        <td>{{ $product->category->name }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            <span style="padding: 0.25rem 0.5rem; border-radius: 99px; font-size: 0.75rem; font-weight: 600; background: {{ $product->status == 'active' ? '#dcfce7' : '#f3f4f6' }}; color: {{ $product->status == 'active' ? '#166534' : '#6b7280' }};">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1.5rem;">Aksi Cepat</h3>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
             <a href="{{ route('admin.products.create') }}" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border: 1px solid var(--border); border-radius: 0.75rem; text-decoration: none; color: var(--text-main); transition: 0.2s;">
                <div style="background: #eef2ff; padding: 0.5rem; border-radius: 0.5rem; color: var(--primary);">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                </div>
                <div>
                    <span style="font-weight: 600;">Tambah Produk</span>
                    <p style="font-size: 0.75rem; color: var(--text-muted);">Upload barang baru</p>
                </div>
            </a>
            
            <a href="{{ route('admin.services.create') }}" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border: 1px solid var(--border); border-radius: 0.75rem; text-decoration: none; color: var(--text-main); transition: 0.2s;">
                <div style="background: #f0fdf4; padding: 0.5rem; border-radius: 0.5rem; color: #16a34a;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                </div>
                 <div>
                    <span style="font-weight: 600;">Tambah Layanan</span>
                    <p style="font-size: 0.75rem; color: var(--text-muted);">Buat layanan jasa</p>
                </div>
            </a>

             <a href="{{ route('admin.settings.index') }}" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border: 1px solid var(--border); border-radius: 0.75rem; text-decoration: none; color: var(--text-main); transition: 0.2s;">
                <div style="background: #fff7ed; padding: 0.5rem; border-radius: 0.5rem; color: #ea580c;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                </div>
                 <div>
                    <span style="font-weight: 600;">Pengaturan Toko</span>
                    <p style="font-size: 0.75rem; color: var(--text-muted);">Ubah kontak & jam</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
