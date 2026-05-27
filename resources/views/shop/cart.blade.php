@extends('layout')

@section('title', 'Giỏ Hàng')

@section('content')
<div class="row gx-4">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-4">
                    <div>
                        <h4 class="mb-1"><i class="fas fa-shopping-cart me-2"></i>Giỏ Hàng</h4>
                        <p class="text-muted mb-0">Xem lại sản phẩm và chuẩn bị thanh toán nhanh chóng.</p>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-primary">{{ count($cart) }} mặt hàng</span>
                    </div>
                </div>

                @if(empty($cart))
                    <div class="empty-state py-5 rounded-4 bg-white">
                        <i class="fas fa-shopping-basket" style="font-size: 4rem;"></i>
                        <h5 class="mt-3">Giỏ hàng trống</h5>
                        <p class="text-muted">Thêm sách vào giỏ để tiếp tục mua sắm.</p>
                        <a href="{{ route('shop.index') }}" class="btn btn-primary mt-3">Mua sắm ngay</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-borderless table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Sách</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th class="text-end">Tạm tính</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $item)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">{{ $item['title'] }}</div>
                                            <div class="text-muted small">{{ $item['author'] }}</div>
                                        </td>
                                        <td>{{ number_format($item['price'], 0, ',', '.') }}₫</td>
                                        <td>
                                            <form action="{{ route('shop.updateCart') }}" method="POST" class="d-flex gap-2 align-items-center">
                                                @csrf
                                                <input type="hidden" name="book_id" value="{{ $item['id'] }}">
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm" style="width: 90px;">
                                                <button class="btn btn-sm btn-outline-secondary" type="submit">Cập nhật</button>
                                            </form>
                                        </td>
                                        <td class="text-end">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}₫</td>
                                        <td class="text-end">
                                            <form action="{{ route('shop.removeFromCart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="book_id" value="{{ $item['id'] }}">
                                                <button class="btn btn-sm btn-danger px-3">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card sticky-top" style="top: 1rem;">
            <div class="card-body">
                <h5 class="mb-3">Tổng đơn hàng</h5>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="text-muted">Tổng</div>
                    <div class="fs-3 text-success fw-bold">{{ number_format($total, 0, ',', '.') }}₫</div>
                </div>
                <div class="d-grid gap-3">
                    <a href="{{ route('shop.checkout') }}" class="btn btn-primary btn-lg {{ empty($cart) ? 'disabled' : '' }}">Tiến hành thanh toán</a>
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary btn-lg">Tiếp tục mua sắm</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
