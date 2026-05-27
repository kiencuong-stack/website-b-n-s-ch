<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Quản Lý Bán Sách')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f5f5f5;
        }
        .admin-sidebar {
            width: 250px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 0;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }
        .admin-sidebar .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 18px;
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .admin-sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 12px 20px;
            transition: all 0.3s;
        }
        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: white !important;
            border-left: 4px solid white;
        }
        .admin-content {
            margin-left: 250px;
            flex: 1;
            padding: 20px;
        }
        .admin-header {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .admin-header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .alert {
            margin-bottom: 20px;
        }
        .card {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: none;
            margin-bottom: 20px;
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }
        .stat-card {
            text-align: center;
            padding: 20px;
        }
        .stat-card .stat-value {
            font-size: 28px;
            font-weight: bold;
            color: #667eea;
        }
        .stat-card .stat-label {
            color: #666;
            margin-top: 10px;
        }
        @media (max-width: 768px) {
            .admin-sidebar {
                width: 200px;
            }
            .admin-content {
                margin-left: 200px;
                padding: 10px;
            }
            .admin-header {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-sidebar">
        <div class="navbar-brand">
            <i class="fas fa-book"></i> Admin Panel
        </div>
        <nav class="nav flex-column">
            <a class="nav-link @if(Route::currentRouteName() === 'admin.dashboard') active @endif" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
            <a class="nav-link @if(Route::currentRouteName() === 'admin.books.index') active @endif" href="{{ route('admin.books.index') }}">
                <i class="fas fa-book"></i> Quản Lý Sách
            </a>
            <a class="nav-link @if(Route::currentRouteName() === 'admin.orders.index') active @endif" href="{{ route('admin.orders.index') }}">
                <i class="fas fa-shopping-cart"></i> Quản Lý Đơn Hàng
            </a>
            <a class="nav-link @if(Route::currentRouteName() === 'admin.users.index') active @endif" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users"></i> Quản Lý User
            </a>
            <hr style="background: rgba(255, 255, 255, 0.2);">
            <a class="nav-link" href="{{ route('shop.index') }}">
                <i class="fas fa-home"></i> Về Trang Chủ
            </a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="nav-link border-0 text-start w-100">
                    <i class="fas fa-sign-out-alt"></i> Đăng Xuất
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="admin-content">
        <div class="admin-header">
            <div>
                <h1>@yield('title', 'Quản Lý Bán Sách')</h1>
                @yield('breadcrumb')
            </div>
            <div>
                <span class="text-muted">{{ auth()->user()->name ?? 'Admin' }}</span>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
