@extends('layouts.app')

@section('styles')
<style>
    /* Page Header - Balanced */
    .page-header { 
        background: linear-gradient(135deg, #eff6ff 0%, #ffffff 100%);
        padding: 2rem 0; 
        margin-bottom: 2.5rem; 
    }
    .breadcrumbs { 
        color: var(--text-muted); 
        font-size: 0.875rem; 
        margin-bottom: 0.625rem; 
    }
    .breadcrumbs a { 
        color: var(--text-secondary); 
        text-decoration: none; 
        transition: color 0.2s;
    }
    .breadcrumbs a:hover { color: var(--primary); }
    .page-title {
        font-family: 'Inter', sans-serif;
        font-size: 2rem;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.02em;
    }
    
    .layout-grid { 
        display: grid; 
        grid-template-columns: 280px 1fr; 
        gap: 2rem; 
        align-items: start; 
    }
    
    /* Sidebar Filter - Balanced */
    .sidebar-filter { 
        background: #ffffff;
        padding: 1.5rem; 
        border-radius: 0.75rem;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);
        position: sticky; 
        top: 100px;
        border: 1px solid #e2e8f0;
    }
    .filter-group { margin-bottom: 2rem; }
    .filter-group:last-child { margin-bottom: 0; }
    .filter-title { 
        font-family: 'Inter', sans-serif;
        font-size: 1rem; 
        font-weight: 700; 
        margin-bottom: 1rem; 
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .filter-title::before {
        content: '';
        width: 4px;
        height: 18px;
        background: linear-gradient(180deg, #1e40af 0%, #1e3a8a 100%);
        border-radius: 2px;
    }
    .category-link { 
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 1rem; 
        color: var(--text-secondary); 
        text-decoration: none; 
        transition: all 0.2s; 
        border-radius: var(--radius-sm);
        margin-bottom: 0.375rem;
    }
    .category-link:hover { 
        background: var(--bg-accent);
        color: var(--primary); 
        transform: translateX(4px);
    }
    .category-link.active { 
        background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
        color: white; 
        font-weight: 600;
    }
    .category-link.active .category-count {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }
    .category-count { 
        background: var(--bg-secondary);
        padding: 0.25rem 0.625rem; 
        border-radius: var(--radius-sm);
        font-size: 0.75rem; 
        font-weight: 600;
        color: var(--text-muted);
    }
    
    /* Toolbar */
    .toolbar { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: var(--space-lg); 
        flex-wrap: wrap; 
        gap: 1rem; 
        background: var(--bg-primary);
        padding: 1.25rem 1.5rem;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-light);
    }
    .search-box { 
        position: relative; 
        flex: 1;
        max-width: 400px; 
    }
    .search-box input { 
        width: 100%; 
        padding: 0.875rem 1.125rem 0.875rem 3rem; 
        border: 2px solid var(--border-light);
        border-radius: var(--radius-md);
        font-size: 0.9375rem;
        transition: all 0.2s;
    }
    .search-box input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
    }
    .search-icon { 
        position: absolute; 
        left: 1.125rem; 
        top: 50%; 
        transform: translateY(-50%); 
        color: var(--text-muted); 
        width: 18px; 
    }
    
    .sort-select { 
        padding: 0.875rem 1.125rem; 
        border: 2px solid var(--border-light);
        border-radius: var(--radius-md);
        background: var(--bg-primary);
        cursor: pointer; 
        font-size: 0.9375rem;
        font-weight: 500;
        color: var(--text-secondary);
        transition: all 0.2s;
    }
    .sort-select:focus {
        outline: none;
        border-color: var(--primary);
    }

    /* Product Grid - Balanced */
    .product-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fill, minmax(210px, 1fr)); 
        gap: 1.25rem; 
    }
    .product-card { 
        background: #ffffff;
        border-radius: 0.75rem;
        overflow: hidden; 
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
        border: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
    }
    .product-card:hover { 
        transform: translateY(-2px); 
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);
        border-color: #3b82f6;
    }
    
    .product-img { 
        width: 100%; 
        aspect-ratio: 1/1;
        object-fit: cover; 
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }
    
    .product-body { 
        padding: 1rem; 
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .product-category { 
        font-size: 0.6875rem; 
        color: #1e40af; 
        text-transform: uppercase; 
        letter-spacing: 0.05em; 
        margin-bottom: 0.375rem; 
        font-weight: 700;
    }
    .product-title { 
        font-size: 1rem; 
        font-weight: 700; 
        margin-bottom: 0.625rem; 
        color: #0f172a;
        display: -webkit-box; 
        -webkit-line-clamp: 2; 
        -webkit-box-orient: vertical; 
        overflow: hidden; 
        line-height: 1.4;
        min-height: 2.8em;
    }
    .product-price { 
        font-family: 'Inter', sans-serif;
        font-size: 1.25rem; 
        font-weight: 800; 
        color: #0f172a;
        margin-top: auto;
        margin-bottom: 0.75rem;
    }
    
    .btn-cart { 
        width: 100%; 
        background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
        color: white; 
        padding: 0.625rem; 
        border: none; 
        border-radius: 0.5rem;
        cursor: pointer; 
        font-weight: 600; 
        font-size: 0.875rem;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    .btn-cart:hover { 
        transform: translateY(-1px);
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--bg-primary);
        border-radius: var(--radius-lg);
        border: 2px dashed var(--border-medium);
    }
    .empty-state svg {
        width: 80px;
        height: 80px;
        color: var(--text-muted);
        margin-bottom: 1.5rem;
    }
    .empty-state h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--secondary-dark);
        margin-bottom: 0.75rem;
    }
    .empty-state p {
        color: var(--text-secondary);
        font-size: 1.0625rem;
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .layout-grid { 
            grid-template-columns: 1fr; 
            gap: var(--space-lg);
        }
        .sidebar-filter { 
            position: static; 
            margin-bottom: var(--space-lg);
        }
    }
    
    @media (max-width: 768px) {
        .page-title { font-size: 2rem; }
        .product-grid { 
            grid-template-columns: repeat(2, 1fr); 
            gap: 1rem; 
        }
        .product-body { padding: 1rem; }
        .product-title { font-size: 0.9375rem; }
        .toolbar {
            flex-direction: column;
            align-items: stretch;
        }
        .search-box {
            max-width: 100%;
        }
    }
    /* Pagination - Premium Aesthetics */
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        gap: 0.5rem;
        justify-content: center;
        margin-top: 2.5rem;
    }
    .pagination li .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
        height: 44px;
        padding: 0 0.5rem;
        background: white;
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        color: var(--text-secondary);
        font-weight: 600;
        font-size: 0.9375rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        box-shadow: var(--shadow-sm);
    }
    .pagination li.active .page-link {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white !important;
        border-color: transparent;
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.25);
    }
    .pagination li:not(.active):not(.disabled) .page-link:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    .pagination li.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
        background: var(--bg-secondary);
        box-shadow: none;
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Beranda</a> / <span>Produk</span>
        </div>
        <h1 class="page-title">Katalog Produk</h1>
    </div>
</section>

<div class="container">
    <div class="layout-grid">
        <!-- Sidebar Filter -->
        <aside class="sidebar-filter">
            <div class="filter-group">
                <span class="filter-title">Kategori</span>
                <a href="{{ route('products.index') }}" class="category-link {{ !request('category') ? 'active' : '' }}">
                    <span>Semua Produk</span>
                    <span class="category-count">{{ $products->total() }}</span>
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('products.index', ['category' => $cat->slug]) }}" 
                   class="category-link {{ request('category') == $cat->slug ? 'active' : '' }}">
                    <span>{{ $cat->name }}</span>
                    <span class="category-count">{{ $cat->products->count() }}</span>
                </a>
                @endforeach
            </div>
        </aside>

        <!-- Main Content -->
        <main>
            <!-- Toolbar -->
            <div class="toolbar">
                <div class="search-box">
                    <svg class="search-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" id="searchInput" placeholder="Cari produk..." value="{{ request('search') }}">
                </div>
                <select class="sort-select" id="sortSelect">
                    <option value="">Urutkan</option>
                    <option value="name_asc">Nama A-Z</option>
                    <option value="name_desc">Nama Z-A</option>
                    <option value="price_asc">Harga Terendah</option>
                    <option value="price_desc">Harga Tertinggi</option>
                </select>
            </div>

            <!-- Product Grid -->
            @if($products->count() > 0)
            <div class="product-grid">
                @foreach($products as $product)
                <div class="product-card">
                    <img src="{{ $product->image_url ?? 'https://via.placeholder.com/240/f0fdfa/0d9488?text='.urlencode($product->name) }}" 
                         alt="{{ $product->name }}" 
                         class="product-img">
                    <div class="product-body">
                        <span class="product-category">{{ $product->category->name ?? 'ATK' }}</span>
                        <h3 class="product-title">{{ $product->name }}</h3>
                        <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <a href="https://wa.me/{{ $setting->whatsapp_number ?? '' }}?text=Halo%20Admin,%20saya%20mau%20pesan%20{{ urlencode($product->name) }}" 
                           class="btn-cart">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.592 2.654-.696c1.005.572 1.913.846 3.037.847 3.197 0 5.775-2.587 5.775-5.776.001-3.187-2.605-5.77-5.908-5.77zm0 10.156c-1.02 0-1.894-.286-2.756-.757l-1.996.524.536-1.942c-1.637-2.977-.871-6.72 2.128-8.455.986-.572 2.083-.872 3.208-.872 3.486 0 6.3 2.834 6.3 6.301 0 3.39-2.73 6.19-5.419 6.202l-.001-.001z"/>
                            </svg>
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div style="margin-top: var(--space-xl);">
                {{ $products->links() }}
            </div>
            @else
            <div class="empty-state">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"></path>
                </svg>
                <h3>Produk Tidak Ditemukan</h3>
                <p>Maaf, tidak ada produk yang sesuai dengan pencarian Anda.</p>
            </div>
            @endif
        </main>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const sortSelect = document.getElementById('sortSelect');
    
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            const url = new URL(window.location.href);
            if (this.value) {
                url.searchParams.set('search', this.value);
            } else {
                url.searchParams.delete('search');
            }
            window.location.href = url.toString();
        }, 500);
    });
    
    sortSelect.addEventListener('change', function() {
        const url = new URL(window.location.href);
        if (this.value) {
            url.searchParams.set('sort', this.value);
        } else {
            url.searchParams.delete('sort');
        }
        window.location.href = url.toString();
    });
</script>
@endsection
