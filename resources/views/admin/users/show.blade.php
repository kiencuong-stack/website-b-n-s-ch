@extends('admin.layout')

@section('title', 'Chi Tiết User - ' . $user->name)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-user"></i> Thông Tin User</h5>
            </div>
            <div class="card-body">
                <p><strong>Tên:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Ngày Tạo:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Ngày Cập Nhật:</strong> {{ $user->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- User Orders -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Đơn Hàng ({{ $orders->total() }})</h5>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Tổng Giá</th>
                            <th>Trạng Thái</th>
                            <th>Ngày Đặt</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td><strong>#{{ $order->id }}</strong></td>
                                <td>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                                <td>
                                    <span class="badge bg-{{ 
                                        $order->status === 'delivered' ? 'success' : 
                                        ($order->status === 'cancelled' ? 'danger' : 'warning')
                                    }}">
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
                                <td colspan="5" class="text-center text-muted py-4">Chưa có đơn hàng nào</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($orders->count() > 0)
            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Thống Kê</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6 class="text-muted">Tổng Đơn Hàng</h6>
                    <h3 class="text-primary">{{ $orders->total() }}</h3>
                </div>
                <div class="mb-3">
                    <h6 class="text-muted">Tổng Chi Tiêu</h6>
                    <h3 class="text-success">{{ number_format($orders->sum('total_amount'), 0, ',', '.') }} VNĐ</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary mt-4">
    <i class="fas fa-arrow-left"></i> Quay Lại
</a>
@endsection
