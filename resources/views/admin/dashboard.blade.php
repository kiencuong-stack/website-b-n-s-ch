@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row mb-4">
    <!-- Statistics Cards -->
    <div class="col-md-3 mb-3">
        <div class="card stat-card bg-primary text-white">
            <i class="fas fa-users fa-3x mb-3" style="opacity: 0.2;"></i>
            <div class="stat-value">{{ $totalUsers }}</div>
            <div class="stat-label">Tổng User</div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stat-card bg-success text-white">
            <i class="fas fa-book fa-3x mb-3" style="opacity: 0.2;"></i>
            <div class="stat-value">{{ $totalBooks }}</div>
            <div class="stat-label">Tổng Sách</div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stat-card bg-warning text-white">
            <i class="fas fa-shopping-cart fa-3x mb-3" style="opacity: 0.2;"></i>
            <div class="stat-value">{{ $totalOrders }}</div>
            <div class="stat-label">Tổng Đơn Hàng</div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stat-card bg-info text-white">
            <i class="fas fa-money-bill-wave fa-3x mb-3" style="opacity: 0.2;"></i>
            <div class="stat-value">{{ number_format($totalRevenue, 0, ',', '.') }}</div>
            <div class="stat-label">Tổng Doanh Thu</div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <!-- Order Status -->
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Trạng Thái Đơn Hàng</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <h5 class="text-warning">{{ $orderStats['pending'] }}</h5>
                        <small class="text-muted">Chờ Xử Lý</small>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-info">{{ $orderStats['processing'] }}</h5>
                        <small class="text-muted">Đang Xử Lý</small>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-primary">{{ $orderStats['shipped'] }}</h5>
                        <small class="text-muted">Đã Gửi</small>
                    </div>
                </div>
                <hr>
                <div class="row text-center">
                    <div class="col-md-4">
                        <h5 class="text-success">{{ $orderStats['delivered'] }}</h5>
                        <small class="text-muted">Đã Giao</small>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-danger">{{ $orderStats['cancelled'] }}</h5>
                        <small class="text-muted">Đã Hủy</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Books -->
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-exclamation-triangle"></i> Sách Tồn Kho Thấp (&lt; 10)</h5>
            </div>
            <div class="card-body">
                @if($lowStockBooks->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($lowStockBooks as $book)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $book->title }}</strong><br>
                                    <small class="text-muted">{{ $book->author }}</small>
                                </div>
                                <span class="badge bg-danger">{{ $book->quantity }} cái</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted text-center mb-0">Tất cả sách đều đủ tồn kho</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-history"></i> Đơn Hàng Gần Đây</h5>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-light">Xem Tất Cả</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Khách Hàng</th>
                    <th>Tổng Giá</th>
                    <th>Trạng Thái</th>
                    <th>Ngày</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                    <tr>
                        <td><strong>#{{ $order->id }}</strong></td>
                        <td>
                            {{ $order->user->name ?? 'N/A' }}<br>
                            <small class="text-muted">{{ $order->user->email ?? '' }}</small>
                        </td>
                        <td><strong>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</strong></td>
                        <td>
                            <span class="badge bg-{{ $order->status === 'delivered' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'warning') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Chưa có đơn hàng nào</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
