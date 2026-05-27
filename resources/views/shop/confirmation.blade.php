@extends('layout')

@section('title', 'Xác Nhận Đơn Hàng')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card shadow-lg">
            <div class="card-body p-5 text-center">
                <div class="mb-4">
                    <div class="mx-auto mb-3 d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 100px; height: 100px; background: rgba(34, 197, 94, 0.12);">
                        <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                    </div>
                    <h2 class="mb-3">Đặt hàng thành công!</h2>
                    <p class="text-muted mb-4">Đơn hàng của bạn đã được ghi nhận. Chúng tôi sẽ xác nhận và giao hàng sớm nhất có thể.</p>
                </div>

                <div class="row g-3 text-start mb-4">
                    <div class="col-sm-6">
                        <div class="border rounded-3 p-3">
                            <div class="text-uppercase text-muted small">Mã đơn hàng</div>
                            <div class="fw-semibold">{{ $order->order_number }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="border rounded-3 p-3">
                            <div class="text-uppercase text-muted small">Tổng tiền</div>
                            <div class="fw-semibold text-success">{{ number_format($order->total_amount, 0, ',', '.') }}₫</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="border rounded-3 p-3">
                            <div class="text-uppercase text-muted small">Phương thức thanh toán</div>
                            <div class="fw-semibold">
                                {{ $order->payment_method === 'cod' ? 'Thanh toán khi nhận hàng' : ($order->payment_method === 'bank_transfer' ? 'Chuyển khoản ngân hàng' : 'Thẻ tín dụng') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card rounded-4 border-0 mb-4">
                    <div class="card-body p-4" style="background: rgba(79, 70, 229, 0.05);">
                        <h5 class="mb-3">Chi tiết đơn hàng</h5>
                        <ul class="list-unstyled mb-0">
                            @foreach($order->items as $item)
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span>{{ $item->book->title }}</span>
                                    <strong>{{ number_format($item->subtotal, 0, ',', '.') }}₫</strong>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                    <a href="{{ route('shop.index') }}" class="btn btn-primary px-4">Quay lại cửa hàng</a>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline-secondary px-4">Xem quản lý đơn hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
