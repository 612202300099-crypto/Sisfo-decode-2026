<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Sisfo Decode 2026')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/img/logo.jpg') }}">
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    <!-- Custom Styles -->
    <style>
        :root {
            /* Brand Colors */
            --brand-navy: #29166F;
            --brand-navy-dark: #1e1150;
            --brand-yellow: #FFF500;
            --brand-yellow-muted: #fffa66;
            
            /* Light Theme Variables */
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --bg-surface: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --text-inverse: #ffffff;
            --border-color: rgba(0, 0, 0, 0.05);
            --input-bg: #f8fafc;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
            --shadow-md: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            
            --primary-color: var(--brand-navy);
            --font-family: 'Inter', sans-serif;

            /* Bootstrap Overrides */
            --bs-primary: var(--brand-navy);
            --bs-primary-rgb: 41, 22, 111;
        }

        [data-bs-theme="dark"] {
            --bg-body: #0a081a;
            --bg-card: #15122e;
            --bg-surface: #1c183d;
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
            --text-inverse: #0a081a;
            --border-color: rgba(255, 255, 255, 0.1);
            --input-bg: rgba(255, 255, 255, 0.05);
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.5);
            --shadow-md: 0 10px 30px -5px rgba(0, 0, 0, 0.5);
            
            /* Override Bootstrap Utilities for Dark Mode */
            --bs-body-bg: var(--bg-body);
            --bs-body-color: var(--text-main);
            --bs-tertiary-bg: var(--bg-surface);
        }
        
        body {
            font-family: var(--font-family);
            background-color: var(--bg-body);
            color: var(--text-main);
            transition: all 0.3s ease;
        }

        /* Essential Visibility Fixes for Dark Mode */
        [data-bs-theme="dark"] .text-dark { color: #ffffff !important; }
        [data-bs-theme="dark"] .text-muted { color: var(--text-muted) !important; }
        [data-bs-theme="dark"] .bg-light { background-color: var(--bg-surface) !important; color: var(--text-main); }
        [data-bs-theme="dark"] .card-header.bg-white { background-color: transparent !important; border-bottom: 1px solid var(--border-color); }
        [data-bs-theme="dark"] .table { color: var(--text-main); }
        [data-bs-theme="dark"] .table-hover tbody tr:hover { background-color: rgba(255,255,255,0.03); color: var(--text-main); }
        [data-bs-theme="dark"] .list-group-item { background-color: transparent; color: var(--text-main); border-color: var(--border-color); }
        [data-bs-theme="dark"] .modal-content { background-color: var(--bg-card); color: var(--text-main); }
        [data-bs-theme="dark"] .dropdown-menu { background-color: var(--bg-surface); border: 1px solid var(--border-color); }
        [data-bs-theme="dark"] .dropdown-item { color: var(--text-main); }
        [data-bs-theme="dark"] .dropdown-item:hover { background-color: rgba(255,255,255,0.05); color: var(--brand-yellow); }
        [data-bs-theme="dark"] .breadcrumb-item.active { color: var(--brand-yellow); }
        
        /* Premium Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--brand-navy) 0%, var(--brand-navy-dark) 100%);
            padding: 0.85rem 0;
            backdrop-filter: blur(10px);
            border-bottom: 2px solid var(--brand-yellow);
            z-index: 1030;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 0.6rem 1.2rem !important;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--brand-yellow) !important;
            transform: translateY(-1px);
        }

        .navbar-nav .nav-link.active {
            background: var(--brand-yellow) !important;
            color: var(--brand-navy) !important;
            box-shadow: 0 4px 12px rgba(255, 245, 0, 0.3);
        }
        
        /* Typography reinforcement */
        h1, h2, h3, h4, h5, h6, .fw-bold { color: var(--text-main); }
        .text-dark { color: var(--text-main) !important; }
        .text-muted { color: var(--text-muted) !important; }

        /* Global UI Tweaks */
        .breadcrumb-item a { color: var(--brand-navy); text-decoration: none; font-weight: 600; }
        .breadcrumb-item.active { color: var(--text-muted); font-weight: 500; }
        [data-bs-theme="dark"] .breadcrumb-item a { color: var(--brand-yellow); }
        [data-bs-theme="dark"] .breadcrumb-item.active { color: #ffffff; }

        .search-wrapper { position: relative; max-width: 300px; }
        .search-input {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            padding: 0.6rem 1rem 0.6rem 2.8rem;
            color: white;
            transition: all 0.3s ease;
        }
        .search-input::placeholder { color: rgba(255, 255, 255, 0.6) !important; font-size: 0.9rem; }
        .search-input:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--brand-yellow);
            box-shadow: 0 0 0 4px rgba(255, 245, 0, 0.15);
        }

        .search-icon {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--brand-yellow);
        }

        .content-wrapper { padding-top: 2.5rem; padding-bottom: 5rem; min-height: 85vh; }

        .table thead th { 
            background-color: var(--input-bg); 
            color: var(--text-muted);
            font-weight: 700;
            border-bottom: 1px solid var(--border-color) !important;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        .dropdown-menu {
            background-color: var(--bg-card);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 0.5rem;
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 0.6rem 1rem;
            color: var(--text-main);
            font-weight: 500;
            transition: all 0.2s;
        }

        .dropdown-item:hover {
            background-color: var(--input-bg);
            color: var(--brand-navy);
        }

        [data-bs-theme="dark"] .dropdown-item:hover {
            color: var(--brand-yellow);
        }

        .alert { border-radius: 16px; border: none; box-shadow: var(--shadow-sm); }

        .card {
            background-color: var(--bg-card);
            border-radius: 20px;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            color: var(--text-main);
        }

        .card:hover {
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.1);
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--brand-navy);
            border-color: var(--brand-navy);
            color: white;
            border-radius: 12px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--brand-navy-dark);
            border-color: var(--brand-yellow);
            color: var(--brand-yellow);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }

        .theme-toggle {
            cursor: pointer;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.08);
            color: var(--brand-yellow);
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            background: var(--brand-yellow);
            color: var(--brand-navy);
        }


    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <div class="bg-white rounded-circle p-1 me-2 shadow-sm">
                    <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo" width="30" height="30" class="rounded-circle">
                </div>
                <span class="ms-2">SISFO <span class="fw-bold" style="color: var(--brand-yellow)">DECODE</span></span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/"><i class="bi bi-grid-fill me-2"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('students*') ? 'active' : '' }}" href="{{ url('/students') }}"><i class="bi bi-people-fill me-2"></i>Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('study-programs*') ? 'active' : '' }}" href="{{ url('/study-programs') }}"><i class="bi bi-mortarboard-fill me-2"></i>Prodi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('subjects*') ? 'active' : '' }}" href="{{ url('/subjects') }}"><i class="bi bi-journal-check me-2"></i>Mata Kuliah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('trash*') ? 'active text-danger' : 'text-danger fw-medium' }} opacity-75" href="{{ route('trash.index') }}">
                            <i class="bi bi-trash-fill me-2"></i>Sampah
                        </a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center gap-3">
                    <div class="search-wrapper d-none d-lg-block">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" id="globalSearch" class="form-control search-input" placeholder="Cari nim, nama..." autocomplete="off">
                        <div id="searchSuggestions" class="dropdown-menu shadow-lg border-0 rounded-4 mt-2 w-100 p-0 overflow-hidden" style="display: none; position: absolute; max-height: 400px; overflow-y: auto;">
                            <!-- Results will be injected here -->
                        </div>
                    </div>
                    
                    <div class="theme-toggle" id="themeToggle" title="Ganti Tema">
                        <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Flash Messages with dynamic icons -->
            @foreach(['success' => 'check-circle-fill', 'error' => 'exclamation-triangle-fill', 'warning' => 'exclamation-circle-fill', 'info' => 'info-circle-fill'] as $msg => $icon)
                @if(session($msg))
                    <div class="alert alert-{{ $msg === 'error' ? 'danger' : $msg }} alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-{{ $icon }} fs-4 me-3"></i>
                            <div>{{ session($msg) }}</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
            @endforeach

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                    <div class="d-flex">
                        <i class="bi bi-exclamation-octagon-fill fs-4 me-3"></i>
                        <div>
                            <span class="fw-bold">Mohon perbaiki kesalahan berikut:</span>
                            <ul class="mb-0 mt-1 small">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @yield('content')
        </div>
    </div>



    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dark Mode Logic
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const html = document.documentElement;

        // Check stored theme
        const storedTheme = localStorage.getItem('theme') || 'light';
        setTheme(storedTheme);

        themeToggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            setTheme(newTheme);
        });

        function setTheme(theme) {
            html.setAttribute('data-bs-theme', theme);
            localStorage.setItem('theme', theme);
            if (theme === 'dark') {
                themeIcon.classList.replace('bi-moon-stars-fill', 'bi-sun-fill');
            } else {
                themeIcon.classList.replace('bi-sun-fill', 'bi-moon-stars-fill');
            }
            // Notify other components (like charts) that theme has changed
            window.dispatchEvent(new CustomEvent('themeChanged', { detail: { theme: theme } }));
        }

        // Auto Close Alerts
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);

        // Global Search Logic
        const searchInput = document.getElementById('globalSearch');
        const searchSuggestions = document.getElementById('searchSuggestions');
        let searchTimeout;

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();

            if (query.length < 2) {
                searchSuggestions.style.display = 'none';
                return;
            }

            searchTimeout = setTimeout(() => {
                fetch(`/search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        searchSuggestions.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                const div = document.createElement('a');
                                div.href = item.url;
                                div.className = 'dropdown-item d-flex align-items-center py-3 border-bottom';
                                div.style.whiteSpace = 'normal';
                                div.innerHTML = `
                                    <div class="bg-light rounded-circle p-2 me-3">
                                        <i class="bi bi-${item.type === 'Mahasiswa' ? 'person' : 'journal-text'} text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold small text-muted text-uppercase" style="font-size: 0.7rem;">${item.type}</div>
                                        <div class="fw-bold">${item.title}</div>
                                        <div class="text-muted small">${item.subtitle}</div>
                                    </div>
                                `;
                                searchSuggestions.appendChild(div);
                            });
                            searchSuggestions.style.display = 'block';
                        } else {
                            searchSuggestions.innerHTML = '<div class="p-4 text-center text-muted small">Tidak ada hasil ditemukan</div>';
                            searchSuggestions.style.display = 'block';
                        }
                    });
            }, 300);
        });

        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchSuggestions.contains(e.target)) {
                searchSuggestions.style.display = 'none';
            }
        });

        function confirmDelete(formId) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini? Data akan dipindahkan ke tempat sampah (Soft Delete).')) {
                document.getElementById(formId).submit();
            }
            return false;
        }
    </script>
    
    @yield('scripts')
</body>
</html>
