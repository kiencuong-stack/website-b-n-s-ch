<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Quản Lý Bán Sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg: #eef2ff;
            --surface: #ffffff;
            --surface-soft: rgba(255,255,255,0.88);
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --accent: #22c55e;
            --text: #0f172a;
            --muted: #475569;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: radial-gradient(circle at top left, rgba(79, 70, 229, 0.15), transparent 32%),
                        linear-gradient(180deg, #f8fafc 0%, #eef2ff 45%, #f8fafc 100%);
            color: var(--text);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary) 0%, #2563eb 100%);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.15);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.92);
            transition: color 0.2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #ffffff;
        }

        .card {
            border: none;
            border-radius: 1.25rem;
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.08);
        }

        .card-header {
            background: transparent;
            border-bottom: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, #2563eb 100%);
            border: none;
            box-shadow: 0 16px 28px rgba(79, 70, 229, 0.18);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #4338ca 0%, #1d4ed8 100%);
        }

        .btn-outline-secondary {
            border-color: rgba(15, 23, 42, 0.12);
            color: var(--text);
        }

        .btn-outline-secondary:hover {
            background: rgba(15, 23, 42, 0.04);
        }

        .form-control:focus {
            border-color: rgba(79, 70, 229, 0.75);
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.14);
        }

        .table thead {
            background: rgba(79, 70, 229, 0.06);
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
        }

        .table-hover tbody tr:hover {
            background: rgba(79, 70, 229, 0.04);
        }

        .badge {
            font-size: 0.82rem;
            border-radius: 999px;
            padding: 0.55em 0.8em;
        }

        .hero-banner {
            background: linear-gradient(135deg, #4f46e5 0%, #2563eb 55%, #0f172a 100%);
            color: #ffffff;
        }

        .hero-banner .btn {
            min-width: 180px;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        footer {
            background: transparent;
        }

        .alert {
            border-radius: 1rem;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }
    </style>
    @yield('extra_css')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('shop.index') }}">
                <i class="fas fa-book"></i> Quản Lý Bán Sách
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('shop.*') ? 'active' : '' }}" href="{{ route('shop.index') }}">
                            <i class="fas fa-store"></i> Cửa Hàng
                        </a>
                    </li>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}" href="{{ route('books.index') }}">
                                    <i class="fas fa-list"></i> Quản Lý Sách
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> Admin
                                </a>
                            </li>
                        @endif
                    @endauth

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('shop.cart') ? 'active' : '' }}" href="{{ route('shop.cart') }}">
                            <i class="fas fa-shopping-cart"></i> Giỏ Hàng
                            @if(session('cart'))
                                <span class="badge bg-danger ms-1">{{ count(session('cart')) }}</span>
                            @endif
                        </a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Đăng Nhập
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> Đăng Ký
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="#">Thông tin</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Đăng Xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Lỗi!</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p class="text-muted mb-0">&copy; 2026 Quản Lý Bán Sách. Tất cả quyền được bảo lưu.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('extra_js')
</body>
</html>
