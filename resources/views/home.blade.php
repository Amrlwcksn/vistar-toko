@extends('layouts.app')

@section('styles')
<style>
    /* Hero Section - Balanced & Professional */
    .hero { 
        background: linear-gradient(135deg, var(--bg-accent) 0%, var(--bg-primary) 60%);
        padding: var(--space-2xl) 0; 
        position: relative; 
        overflow: hidden;
    }
    .hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 60%;
        height: 200%;
        background: linear-gradient(135deg, rgba(30, 64, 175, 0.06) 0%, transparent 70%);
        transform: rotate(-12deg);
        pointer-events: none;
    }
    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 680px;
    }
    .hero h1 { 
        font-family: 'Inter', sans-serif;
        font-size: 3rem; 
        font-weight: 800; 
        color: var(--text-primary); 
        margin-bottom: var(--space-md); 
        line-height: 1.15;
        letter-spacing: -0.02em;
    }
    .hero h1 .highlight {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .hero p { 
        font-size: 1.0625rem; 
        color: var(--text-secondary); 
        margin-bottom: var(--space-xl); 
        line-height: 1.6;
    }
    .hero-actions {
        display: flex;
        gap: var(--space-md);
        flex-wrap: wrap;
    }
    
    /* Services - Simple & Clean */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: var(--space-lg);
    }
    .service-card { 
        background: var(--bg-primary);
        padding: var(--space-lg);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        transition: all 0.2s ease;
        text-align: center;
        border: 1px solid var(--border-light);
    }
    .service-card:hover { 
        box-shadow: var(--shadow-md);
        border-color: var(--primary);
    }
    .service-card.highlighted {
        border: 2px solid var(--primary);
        background: var(--bg-accent);
    }
    .service-card h3 {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: var(--space-sm);
        line-height: 1.3;
    }
    .service-card p {
        color: var(--text-secondary);
        margin-bottom: var(--space-md);
        line-height: 1.5;
        font-size: 0.9375rem;
    }
    .service-price {
        font-size: 1.375rem;
        font-weight: 800;
        color: var(--primary);
        font-family: 'Inter', sans-serif;
    }
    .highlight-badge { 
        display: inline-block;
        background: var(--secondary);
        color: white;
        padding: 0.25rem 0.625rem;
        border-radius: var(--radius-sm);
        font-size: 0.6875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        margin-bottom: var(--space-sm);
    }

    /* Products - Balanced Grid */
    .products-section {
        background: var(--bg-primary);
    }
    .product-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); 
        gap: var(--space-lg); 
    }
    .product-card { 
        background: var(--bg-primary);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: all 0.2s ease;
        border: 1px solid var(--border-light);
        display: flex;
        flex-direction: column;
    }
    .product-card:hover { 
        transform: translateY(-2px); 
        box-shadow: var(--shadow-md);
        border-color: var(--primary-light);
    }
    .product-img { 
        width: 100%; 
        height: 200px; 
        object-fit: cover; 
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }
    .product-body { 
        padding: var(--space-md); 
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .product-category { 
        font-size: 0.6875rem; 
        color: var(--primary); 
        font-weight: 700; 
        text-transform: uppercase; 
        letter-spacing: 0.05em;
        margin-bottom: 0.375rem;
    }
    .product-title { 
        font-size: 1rem; 
        font-weight: 700; 
        margin-bottom: var(--space-sm); 
        color: var(--text-primary);
        line-height: 1.4;
    }
    .product-price { 
        font-size: 1.25rem; 
        font-weight: 800; 
        color: var(--text-primary);
        font-family: 'Inter', sans-serif;
        margin-top: auto;
    }
    .product-card .btn {
        margin-top: var(--space-md);
        width: 100%;
        justify-content: center;
        font-size: 0.875rem;
        padding: 0.625rem 1rem;
    }

    /* CTA Section - Balanced */
    .cta-section {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        padding: var(--space-2xl) 0;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }
    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -20%;
        width: 140%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
        pointer-events: none;
    }
    .cta-section h2 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: var(--space-sm);
        color: white;
        position: relative;
        z-index: 1;
    }
    .cta-section p {
        font-size: 1.0625rem;
        margin-bottom: var(--space-lg);
        opacity: 0.95;
        position: relative;
        z-index: 1;
    }
    .cta-section .btn-outline {
        border-color: white;
        color: white;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(8px);
    }
    .cta-section .btn-outline:hover {
        background: white;
        color: var(--primary);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero h1 { font-size: 2rem; }
        .hero p { font-size: 1rem; }
        .hero-actions { flex-direction: column; }
        .hero-actions .btn { width: 100%; justify-content: center; }
        .product-grid { grid-template-columns: repeat(2, 1fr); gap: var(--space-md); }
        .product-img { height: 160px; }
        .product-body { padding: var(--space-sm); }
        .product-title { font-size: 0.9375rem; }
        .services-grid { grid-template-columns: 1fr; }
        .cta-section h2 { font-size: 1.75rem; }
    }
</style>
@endsection

@section('content')
    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>
                    <span class="highlight">Solusi Lengkap</span><br>
                    Cetak & ATK Terbaik
                </h1>
                <p>Kami menyediakan layanan fotokopi berkualitas tinggi, pass foto instan, dan perlengkapan ATK lengkap untuk kebutuhan pribadi maupun bisnis Anda.</p>
                <div class="hero-actions">
                    <a href="https://wa.me/{{ $setting->whatsapp_number ?? '' }}?text=Halo%20Admin,%20saya%20ingin%20bertanya%20tentang%20layanan..." class="btn btn-primary">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.592 2.654-.696c1.005.572 1.913.846 3.037.847 3.197 0 5.775-2.587 5.775-5.776.001-3.187-2.605-5.77-5.908-5.77zm0 10.156c-1.02 0-1.894-.286-2.756-.757l-1.996.524.536-1.942c-1.637-2.977-.871-6.72 2.128-8.455.986-.572 2.083-.872 3.208-.872 3.486 0 6.3 2.834 6.3 6.301 0 3.39-2.73 6.19-5.419 6.202l-.001-.001z"/>
                        </svg>
                        Pesan Sekarang
                    </a>
                    <a href="#layanan" class="btn btn-outline">
                        Lihat Layanan
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section id="layanan" class="section-padding">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title">Layanan Kami</h2>
                <p class="section-subtitle">Pilihan layanan terbaik dengan kualitas premium dan harga yang kompetitif untuk memenuhi kebutuhan Anda.</p>
            </div>
            
            <div class="services-grid">
                @foreach($services as $service)
                <div class="service-card {{ $service->is_highlight ? 'highlighted' : '' }}">
                    <h3>{{ $service->name }}</h3>
                    <p>{{ $service->description }}</p>
                    <div class="service-price">Rp {{ number_format($service->price, 0, ',', '.') }}</div>
                </div>
                @endforeach
                
                @foreach($all_services as $s)
                    @if(!$services->contains($s))
                    <div class="service-card">
                        <h3>{{ $s->name }}</h3>
                        <p>{{ $s->description }}</p>
                        <div class="service-price">Rp {{ number_format($s->price, 0, ',', '.') }}</div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- Products -->
    <section id="produk" class="section-padding products-section">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title">Produk kami lainnya</h2>
                <p class="section-subtitle">Perlengkapan alat tulis kantor berkualitas dengan harga terjangkau.</p>
            </div>
            
            <div class="product-grid">
                @foreach($products->take(8) as $product)
                <div class="product-card">
                    <img src="{{ $product->image_url ?? 'https://via.placeholder.com/220x200/eff6ff/1e40af?text='.urlencode($product->name) }}" alt="{{ $product->name }}" class="product-img">
                    <div class="product-body">
                        <span class="product-category">{{ $product->category->name ?? 'ATK' }}</span>
                        <h3 class="product-title">{{ $product->name }}</h3>
                        <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <a href="https://wa.me/{{ $setting->whatsapp_number ?? '' }}?text=Halo%20Admin,%20saya%20mau%20pesan%20{{ urlencode($product->name) }}" class="btn btn-outline">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.592 2.654-.696c1.005.572 1.913.846 3.037.847 3.197 0 5.775-2.587 5.775-5.776.001-3.187-2.605-5.77-5.908-5.77zm0 10.156c-1.02 0-1.894-.286-2.756-.757l-1.996.524.536-1.942c-1.637-2.977-.871-6.72 2.128-8.455.986-.572 2.083-.872 3.208-.872 3.486 0 6.3 2.834 6.3 6.301 0 3.39-2.73 6.19-5.419 6.202l-.001-.001z"/>
                            </svg>
                            Pesan
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center" style="margin-top: var(--space-xl);">
                <a href="{{ route('products.index') }}" class="btn btn-primary" style="padding: 0.875rem 2rem;">
                    Lihat Semua Produk
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Siap Berbelanja?</h2>
            <p>Hubungi kami sekarang untuk konsultasi gratis dan dapatkan penawaran terbaik!</p>
            <a href="https://wa.me/{{ $setting->whatsapp_number ?? '' }}" class="btn btn-outline" style="padding: 0.875rem 2rem;">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.592 2.654-.696c1.005.572 1.913.846 3.037.847 3.197 0 5.775-2.587 5.775-5.776.001-3.187-2.605-5.77-5.908-5.77zm0 10.156c-1.02 0-1.894-.286-2.756-.757l-1.996.524.536-1.942c-1.637-2.977-.871-6.72 2.128-8.455.986-.572 2.083-.872 3.208-.872 3.486 0 6.3 2.834 6.3 6.301 0 3.39-2.73 6.19-5.419 6.202l-.001-.001z"/>
                </svg>
                Hubungi Kami Sekarang
            </a>
        </div>
    </section>
@endsection
