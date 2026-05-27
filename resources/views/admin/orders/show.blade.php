@extends('admin.layout')

@section('title', 'Chi Tiết Đơn Hàng #' . $order->id)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Thông Tin Đơn Hàng</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Mã Đơn:</strong> #{{ $order->id }}</p>
                        <p><strong>Ngày Đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Trạng Thái:</strong>
                            <span class="badge bg-{{ 
                                $order->status === 'delivered' ? 'success' : 
                                ($order->status === 'cancelled' ? 'danger' : 
                                ($order->status === 'shipped' ? 'info' : 'warning'))
                            }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 text-end">
                        <p><strong>Tổng Giá:</strong></p>
                        <h4 class="text-success">{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-user"></i> Thông Tin Khách Hàng</h5>
            </div>
            <div class="card-body">
                <p><strong>Tên:</strong> {{ $order->customer_name }}</p>
                <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                <p><strong>Điện thoại:</strong> {{ $order->customer_phone }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
                <p><strong>Phương thức thanh toán:</strong>
                    {{ $order->payment_method === 'cod' ? 'Thanh toán khi nhận hàng' : ($order->payment_method === 'bank_transfer' ? 'Chuyển khoản ngân hàng' : 'Thẻ tín dụng') }}
                </p>
                <p><strong>Ghi Chú:</strong> {{ $order->notes ?? 'Không có' }}</p>
            </div>
        </div>

        <!-- Order Items -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-box"></i> Chi Tiết Sản Phẩm</h5>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Sách</th>
                            <th>Giá</th>
                            <th>Số Lượng</th>
                            <th class="text-end">Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($order->items as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item->book->title ?? 'N/A' }}</strong><br>
                                    <small class="text-muted">{{ $item->book->author ?? '' }}</small>
                                </td>
                                <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="text-end"><strong>{{ number_format($item->quantity * $item->price, 0, ',', '.') }} VNĐ</strong></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Không có sản phẩm</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Update Status -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-sync-alt"></i> Cập Nhật Trạng Thái</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Trạng Thái</label>
                        <select name="status" class="form-select">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Chờ Xử Lý</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Đang Xử Lý</option>
                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Đã Gửi</option>
                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Đã Giao</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Đã Hủy</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save"></i> Cập Nhật
                    </button>
                </form>
            </div>
        </div>

        <!-- Summary -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-calculator"></i> Tóm Tắt</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span>Tổng Sản Phẩm:</span>
                    <strong>{{ $order->items->sum('quantity') }} cái</strong>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Tổng Giá:</span>
                    <strong class="text-success">{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary mt-3">
    <i class="fas fa-arrow-left"></i> Quay Lại
</a>
@endsection
