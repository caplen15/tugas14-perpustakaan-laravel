<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Perpustakaan') - Sistem Perpustakaan</title>
    
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- SweetAlert2 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">

    {{-- Custom CSS --}}
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #bbbbbb;
        }
        
        main {
            flex: 1;
            background-color: #f7f8f9;
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.3rem;
        }
        
        footer {
            margin-top: auto;
            padding: 2rem 0;
        }

        .site-navbar {
            background: linear-gradient(135deg, #2b2f34 0%, #4a4f56 100%);
            border-bottom: 1px solid #6b7280;
        }

        .site-navbar .navbar-brand,
        .site-navbar .nav-link,
        .site-navbar .navbar-toggler-icon {
            color: #f5f7fa !important;
        }

        .site-navbar .nav-link:hover,
        .site-navbar .nav-link.active {
            color: #dfe4ea !important;
        }

        .site-footer {
            background: linear-gradient(135deg, #23262b 0%, #3a3d42 100%);
            color: #f5f7fa;
            border-top: 1px solid #6b7280;
        }

        .site-footer a {
            color: #dfe4ea;
            text-decoration: none;
        }

        .site-footer a:hover {
            color: #ffffff;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    {{-- Navbar --}}
    @include('layouts.navbar')
    
    @push('scripts')
    <script>
        // Loading state saat submit form
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn && !this.classList.contains('delete-form')) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';
                }
            });
        });
    </script>
    @endpush

    @if (session('success') || session('error') || session('info') || session('warning'))
        @push('scripts')
        <script>
            // Auto hide alerts after 5 seconds
            setTimeout(function() {
                let alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    let bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        </script>
        @endpush
    @endif

    {{-- Main Content --}}
    <main class="py-4">
        <div class="container">
            {{-- Alert Messages --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if (session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle-fill"></i>
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            {{-- Page Content --}}
            @yield('content')
        </div>
    </main>
    
    {{-- Footer --}}
    @include('layouts.footer')
    
    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')

    {{-- SweetAlert2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
</body>
</html>