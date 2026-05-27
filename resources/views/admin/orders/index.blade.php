@extends('admin.layout')

@section('title', 'Quản Lý Đơn Hàng')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Danh Sách Đơn Hàng</h5>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Khách Hàng</th>
                    <th>Email</th>
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
                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                        <td>{{ $order->user->email ?? 'N/A' }}</td>
                        <td><strong>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</strong></td>
                        <td>
                            <span class="badge bg-{{ 
                                $order->status === 'delivered' ? 'success' : 
                                ($order->status === 'cancelled' ? 'danger' : 
                                ($order->status === 'shipped' ? 'info' : 'warning'))
                            }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> Chi Tiết
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Chưa có đơn hàng nào</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
    {{ $orders->links() }}
</div>
@endsection
