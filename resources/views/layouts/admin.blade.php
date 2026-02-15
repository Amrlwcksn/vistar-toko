<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.svg') }}">
    <title>VistarToko Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Primary Colors - Blue (Paper, Ink, Professional) */
            --primary: #1e40af;
            --primary-dark: #1e3a8a;
            --primary-light: #3b82f6;
            
            /* Secondary - Red (Urgent, Important) */
            --secondary: #dc2626;
            --secondary-dark: #991b1b;
            
            /* Accent - Amber */
            --accent: #f59e0b;
            
            /* Backgrounds */
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --bg-sidebar: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            
            /* Text */
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #64748b;
            
            /* Borders & Shadows */
            --border: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 2px 4px 0 rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 4px 8px 0 rgba(0, 0, 0, 0.12);
            
            /* Layout */
            --sidebar-width: 270px;
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: -apple-system, BlinkMacSystemFont, 'Inter', 'Segoe UI', sans-serif;
            background: var(--bg-body); 
            color: var(--text-primary); 
            display: flex; 
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* Sidebar - Gradient Background */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--bg-sidebar);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 1.75rem 1.25rem;
            z-index: 50;
            box-shadow: 4px 0 12px rgba(0, 0, 0, 0.08);
        }

        .brand { 
            font-family: 'Inter', sans-serif;
            font-size: 1.375rem; 
            font-weight: 800; 
            color: white;
            margin-bottom: 2rem; 
            display: flex; 
            align-items: center; 
            gap: 0.625rem;
            letter-spacing: -0.01em;
            padding: 0 0.625rem;
        }
        
        .compass-icon {
            color: var(--primary-light);
            width: 30px;
            height: 30px;
            filter: drop-shadow(0 2px 6px rgba(59, 130, 246, 0.3));
        }
        
        nav { flex: 1; overflow-y: auto; }
        
        .nav-section {
            margin-bottom: 1.75rem;
        }
        .nav-section-title {
            padding: 0 0.75rem;
            margin-bottom: 0.625rem;
            font-size: 0.75rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 0.625rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: var(--radius-md);
            margin-bottom: 0.375rem;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.9375rem;
            position: relative;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(4px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.3);
        }
        
        .nav-link.active::before {
            content: '';
            position: absolute;
            left: -1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 22px;
            background: var(--primary-light);
            border-radius: 0 2px 2px 0;
        }

        .nav-link.logout-link:hover {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }
        
        .icon { width: 20px; height: 20px; stroke-width: 2; stroke: currentColor; fill: none; }

        /* User Profile in Sidebar */
        .sidebar-footer {
            margin-top: auto;
            padding-top: 1.25rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            padding: 0.75rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-md);
            margin-bottom: 0.625rem;
        }
        .user-avatar {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: white;
            font-size: 1rem;
        }
        .user-info h4 {
            font-size: 0.9375rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.125rem;
        }
        .user-info p {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.6);
        }

        /* Main Content - Balanced */
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 1.75rem 2rem;
            min-height: 100vh;
        }

        /* Topbar */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid var(--border);
        }
        .topbar-left h1 {
            font-family: 'Inter', sans-serif;
            font-size: 1.875rem;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.02em;
            margin-bottom: 0.25rem;
        }
        .topbar-left p {
            color: var(--text-secondary);
            font-size: 0.9375rem;
        }
        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* Cards - Balanced */
        .card {
            background: var(--bg-card);
            padding: 1.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: all 0.2s ease;
        }
        .card:hover {
            box-shadow: var(--shadow-md);
        }

        /* Buttons - Balanced */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-md);
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9375rem;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .btn-primary { 
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white; 
            box-shadow: var(--shadow-sm);
        }
        .btn-primary:hover { 
            transform: translateY(-1px); 
            box-shadow: var(--shadow-md);
        }
        .btn-secondary { 
            background: white; 
            border: 1px solid var(--border); 
            color: var(--text-primary); 
        }
        .btn-secondary:hover { 
            background: var(--bg-body); 
            border-color: var(--primary);
        }
        .btn-danger { 
            background: #ef4444; 
            color: white; 
        }
        .btn-danger:hover { 
            background: #dc2626; 
        }

        /* Tables */
        .table-wrapper { overflow-x: auto; }
        table { 
            width: 100%; 
            border-collapse: separate; 
            border-spacing: 0; 
        }
        th { 
            background: var(--bg-body);
            padding: 1rem 1.25rem; 
            text-align: left; 
            font-size: 0.75rem; 
            font-weight: 700; 
            text-transform: uppercase; 
            color: var(--text-secondary);
            letter-spacing: 0.05em;
            border-bottom: 2px solid var(--border);
        }
        td { 
            padding: 1.125rem 1.25rem; 
            border-bottom: 1px solid var(--border); 
            color: var(--text-primary);
        }
        tr:last-child td { border-bottom: none; }
        tr:hover { background: var(--bg-body); }
        
        /* Form Elements */
        label { 
            display: block; 
            margin-bottom: 0.5rem; 
            font-size: 0.9375rem; 
            font-weight: 600; 
            color: var(--text-primary); 
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="number"], textarea, select {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
            font-size: 0.9375rem;
            transition: all 0.2s;
            background: white;
            font-family: inherit;
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
        }

        /* Mobile Responsiveness */
        .mobile-toggle { display: none; }
        
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
                padding: 1.5rem;
            }
            .mobile-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
                background: white;
                border: 1px solid var(--border);
                border-radius: var(--radius-md);
                width: 40px;
                height: 40px;
                cursor: pointer;
                color: var(--text-primary);
            }
            .overlay {
                display: none;
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 40;
            }
            .overlay.active { display: block; }
        }
    </style>
</head>
<body>
    
    <div id="overlay" class="overlay"></div>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="brand">
            <svg class="compass-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
            </svg>
            <span>VistarToko</span>
        </div>
        
        <nav>
            <div class="nav-section">
                <p class="nav-section-title">Menu Utama</p>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg class="icon" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                    <svg class="icon" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    Layanan
                </a>
                <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <svg class="icon" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    Kategori
                </a>
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <svg class="icon" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    Produk
                </a>
            </div>
            
            <div class="nav-section">
                <p class="nav-section-title">Pengaturan</p>
                <a href="{{ route('admin.profile.index') }}" class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                    <svg class="icon" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profil
                </a>
                <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <svg class="icon" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Pengaturan Toko
                </a>
            </div>
        </nav>
        
        <div class="sidebar-footer">
            <div class="user-profile">
                <div class="user-avatar">A</div>
                <div class="user-info">
                    <h4>Admin</h4>
                    <p>Toko Manager</p>
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" class="nav-link logout-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <svg class="icon" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Logout
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <button id="sidebarToggle" class="mobile-toggle">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
                </button>
                <div class="topbar-left">
                    @yield('page-title')
                </div>
            </div>
            <div class="topbar-actions">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                    Lihat Website
                </a>
            </div>
        </div>

        @yield('content')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');
            const overlay = document.getElementById('overlay');

            function toggleSidebar() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            }

            if(toggle) toggle.addEventListener('click', toggleSidebar);
            if(overlay) overlay.addEventListener('click', toggleSidebar);
        });
    </script>

</body>
</html>
