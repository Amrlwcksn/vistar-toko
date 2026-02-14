<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.svg') }}">
    <title>{{ $setting->tagline ?? 'VistarToko' }} - Layanan Fotokopi & ATK Terlengkap</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* Design System - Printing & Stationery Theme */
        :root {
            /* Primary Colors - Blue (Paper, Ink, Professional Documents) */
            --primary: #1e40af;
            --primary-dark: #1e3a8a;
            --primary-light: #3b82f6;
            
            /* Secondary - Red (Urgent, Important, Highlight) */
            --secondary: #dc2626;
            --secondary-dark: #991b1b;
            --secondary-light: #ef4444;
            
            /* Accent - Amber (Stationery, Highlighter) */
            --accent: #f59e0b;
            --accent-dark: #d97706;
            
            /* Neutrals - Black/Gray (Text, Printing) */
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #64748b;
            
            /* Background Colors */
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-accent: #eff6ff;
            
            /* Borders & Shadows */
            --border-light: #e2e8f0;
            --border-medium: #cbd5e1;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 2px 4px 0 rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 4px 8px 0 rgba(0, 0, 0, 0.12);
            
            /* Balanced Spacing */
            --space-xs: 0.5rem;
            --space-sm: 0.75rem;
            --space-md: 1rem;
            --space-lg: 1.5rem;
            --space-xl: 2.5rem;
            --space-2xl: 4rem;
            
            /* Border Radius */
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { 
            font-family: -apple-system, BlinkMacSystemFont, 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary); 
            background: var(--bg-secondary); 
            line-height: 1.6; 
            display: flex; 
            flex-direction: column; 
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            font-size: 16px;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: var(--bg-secondary); }
        ::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 5px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary-dark); }

        /* Utilities */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 var(--space-lg); }
        
        /* Buttons - Balanced Sizing */
        .btn { 
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem; 
            border-radius: var(--radius-md); 
            font-weight: 600; 
            font-size: 0.9375rem;
            text-decoration: none; 
            transition: all 0.2s ease; 
            cursor: pointer; 
            border: none;
            line-height: 1.5;
        }
        
        .btn-primary { 
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white; 
            box-shadow: var(--shadow-md);
        }
        .btn-primary:hover { 
            transform: translateY(-1px); 
            box-shadow: var(--shadow-lg);
        }
        
        .btn-outline { 
            border: 2px solid var(--primary); 
            color: var(--primary); 
            background: transparent; 
        }
        .btn-outline:hover { 
            background: var(--primary); 
            color: white; 
        }
        
        .text-center { text-align: center; }
        .section-padding { padding: var(--space-2xl) 0; }
        
        /* Balanced Typography */
        .section-title { 
            font-family: 'Inter', sans-serif;
            font-size: 2.25rem; 
            font-weight: 800; 
            color: var(--text-primary); 
            margin-bottom: var(--space-md); 
            letter-spacing: -0.02em;
            line-height: 1.2;
        }
        .section-subtitle { 
            color: var(--text-secondary); 
            font-size: 1.0625rem; 
            margin-bottom: var(--space-xl); 
            max-width: 600px; 
            margin-left: auto; 
            margin-right: auto;
            line-height: 1.6;
        }

        /* Navbar - Professional & Balanced */
        .navbar { 
            background: rgba(255, 255, 255, 0.98); 
            backdrop-filter: blur(12px); 
            position: sticky; 
            top: 0; 
            z-index: 1000; 
            padding: 1rem 0; 
            border-bottom: 1px solid var(--border-light);
            box-shadow: var(--shadow-sm);
        }
        .nav-container { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }
        .logo { 
            font-family: 'Inter', sans-serif;
            font-size: 1.375rem; 
            font-weight: 800; 
            color: var(--text-primary); 
            text-decoration: none; 
            display: flex; 
            align-items: center; 
            gap: 0.625rem;
            letter-spacing: -0.01em;
        }
        .compass-logo { 
            width: 32px; 
            height: 32px; 
            color: var(--primary);
        }
        .nav-links { 
            display: flex; 
            gap: 2rem; 
            align-items: center;
        }
        .nav-links a { 
            text-decoration: none; 
            color: var(--text-secondary); 
            font-weight: 500; 
            font-size: 0.9375rem;
            transition: color 0.2s; 
            position: relative;
            padding: 0.25rem 0;
        }
        .nav-links a:hover { color: var(--primary); }
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.2s ease;
        }
        .nav-links a:hover::after { width: 100%; }

        /* Footer - Balanced Layout */
        .footer { 
            background: linear-gradient(135deg, var(--text-primary) 0%, #1e293b 100%);
            color: white; 
            padding: var(--space-2xl) 0 var(--space-lg); 
            margin-top: auto; 
        }
        .footer h3 { 
            font-family: 'Inter', sans-serif;
            font-size: 1.125rem; 
            font-weight: 700;
            margin-bottom: var(--space-md);
            color: var(--primary-light);
        }
        .footer p { 
            color: #94a3b8; 
            margin-bottom: 0.5rem;
            line-height: 1.6;
            font-size: 0.9375rem;
        }
        .footer-grid { 
            display: grid; 
            grid-template-columns: 2fr 1fr 1fr 1.5fr; 
            gap: var(--space-xl); 
            margin-bottom: var(--space-lg); 
        }
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: var(--space-md);
            text-align: center;
            color: #94a3b8;
            font-size: 0.875rem;
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
        
        @media (max-width: 768px) {
            .nav-links { display: none; }
            .section-title { font-size: 1.75rem; }
            .section-subtitle { font-size: 1rem; }
            .footer-grid { grid-template-columns: 1fr; gap: var(--space-lg); }
            .container { padding: 0 var(--space-md); }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container nav-container">
            <a href="{{ route('home') }}" class="logo">
                <svg class="compass-logo" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
                </svg>
                <span>VistarToko</span>
            </a>
            <div class="nav-links">
                <a href="{{ route('home') }}#layanan">Layanan</a>
                <a href="{{ route('products.index') }}">Produk</a>
                <a href="{{ route('home') }}#kontak">Kontak</a>
            </div>
            <a href="https://wa.me/{{ $setting->whatsapp_number ?? '' }}" class="btn btn-primary">
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.592 2.654-.696c1.005.572 1.913.846 3.037.847 3.197 0 5.775-2.587 5.775-5.776.001-3.187-2.605-5.77-5.908-5.77zm0 10.156c-1.02 0-1.894-.286-2.756-.757l-1.996.524.536-1.942c-1.637-2.977-.871-6.72 2.128-8.455.986-.572 2.083-.872 3.208-.872 3.486 0 6.3 2.834 6.3 6.301 0 3.39-2.73 6.19-5.419 6.202l-.001-.001z"/>
                </svg>
                Hubungi Kami
            </a>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <section id="kontak" class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h3>VistarToko</h3>
                    <p>{{ $setting->tagline ?? 'Layanan Fotokopi & ATK Terpercaya' }}</p>
                    <div style="margin-top: var(--space-md);">
                        <p><strong style="color: var(--primary-light);">WhatsApp:</strong> {{ $setting->whatsapp_number ?? '-' }}</p>
                        <p><strong style="color: var(--primary-light);">Telepon:</strong> {{ $setting->store_phone ?? '-' }}</p>
                    </div>
                </div>
                <div>
                    <h3>Navigasi</h3>
                    <p><a href="{{ route('home') }}#layanan" style="color: #94a3b8; text-decoration: none;">Layanan</a></p>
                    <p><a href="{{ route('products.index') }}" style="color: #94a3b8; text-decoration: none;">Produk</a></p>
                    <p><a href="{{ route('home') }}#kontak" style="color: #94a3b8; text-decoration: none;">Kontak</a></p>
                </div>
                <div>
                    <h3>Jam Buka</h3>
                    <p>{{ $setting->opening_hours ?? 'Senin - Sabtu' }}</p>
                </div>
                <div>
                    <h3>Lokasi</h3>
                    <p>{{ $setting->address ?? 'Alamat toko belum diatur.' }}</p>
                    @if(!empty($setting->maps_embed))
                    <div style="margin-top: var(--space-sm); border-radius: var(--radius-md); overflow: hidden;">
                        <iframe src="{{ $setting->maps_embed }}" width="100%" height="120" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    @endif
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} VistarToko. All rights reserved..</p>
            </div>
        </div>
    </section>

    @yield('scripts')

</body>
</html>
