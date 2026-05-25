@extends('layout')

@section('title', 'Thanh Toán')

@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h4 class="mb-0">Thông Tin Thanh Toán</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('shop.placeOrder') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Họ và tên</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name', auth()->user()->name ?? '') }}" required>
                        @error('customer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="customer_email" class="form-label">Email</label>
                        <input type="email" name="customer_email" id="customer_email" class="form-control @error('customer_email') is-invalid @enderror" value="{{ old('customer_email', auth()->user()->email ?? '') }}" required>
                        @error('customer_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="customer_phone" class="form-label">Số điện thoại</label>
                        <input type="text" name="customer_phone" id="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror" value="{{ old('customer_phone') }}" required>
                        @error('customer_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="customer_address" class="form-label">Địa chỉ</label>
                        <textarea name="customer_address" id="customer_address" class="form-control @error('customer_address') is-invalid @enderror" rows="3" required>{{ old('customer_address') }}</textarea>
                        @error('customer_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Phương thức thanh toán</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_method_cod" value="cod" {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }}>
                            <label class="form-check-label" for="payment_method_cod">Thanh toán khi nhận hàng</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_method_bank_transfer" value="bank_transfer" {{ old('payment_method') === 'bank_transfer' ? 'checked' : '' }}>
                            <label class="form-check-label" for="payment_method_bank_transfer">Chuyển khoản ngân hàng</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_method_credit_card" value="credit_card" {{ old('payment_method') === 'credit_card' ? 'checked' : '' }}>
                            <label class="form-check-label" for="payment_method_credit_card">Thanh toán thẻ tín dụng</label>
                        </div>
                        @error('payment_method')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="cardDetails" style="display: {{ old('payment_method') === 'credit_card' ? 'block' : 'none' }};">
                        <div class="mb-3">
                            <label for="card_number" class="form-label">Số thẻ</label>
                            <input type="text" name="card_number" id="card_number" class="form-control @error('card_number') is-invalid @enderror" value="{{ old('card_number') }}">
                            @error('card_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="card_expiry" class="form-label">Hạn thẻ (MM/YY)</label>
                                <input type="text" name="card_expiry" id="card_expiry" class="form-control @error('card_expiry') is-invalid @enderror" value="{{ old('card_expiry') }}" placeholder="MM/YY">
                                @error('card_expiry')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="card_cvv" class="form-label">CVV</label>
                                <input type="text" name="card_cvv" id="card_cvv" class="form-control @error('card_cvv') is-invalid @enderror" value="{{ old('card_cvv') }}" placeholder="123">
                                @error('card_cvv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Ghi chú (tuỳ chọn)</label>
                        <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" rows="2">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-success" type="submit">Xác nhận và đặt hàng</button>
                        <a href="{{ route('shop.cart') }}" class="btn btn-outline-secondary">Quay lại giỏ hàng</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Đơn hàng của bạn</h5>
            </div>
            <div class="card-body">
                @foreach($cart as $item)
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <strong>{{ $item['title'] }}</strong><br>
                            <small class="text-muted">x{{ $item['quantity'] }} cuốn</small>
                        </div>
                        <div>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}₫</div>
                    </div>
                @endforeach

                <hr>
                <div class="d-flex justify-content-between">
                    <strong>Tổng cộng</strong>
                    <strong class="text-success">{{ number_format($total, 0, ',', '.') }}₫</strong>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Lưu ý</h5>
            </div>
            <div class="card-body">
                <p>Chọn thanh toán khi nhận hàng nếu bạn muốn nhận sách rồi trả tiền.</p>
                <p>Chuyển khoản ngân hàng là phương thức an toàn, hãy giữ lại thông tin chuyển khoản.</p>
                <p>Nếu chọn thẻ tín dụng, hệ thống chỉ mô phỏng nhập thông tin để lưu vết đơn hàng.</p>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleCardFields() {
        const cardRadio = document.getElementById('payment_method_credit_card');
        const cardDetails = document.getElementById('cardDetails');
        cardDetails.style.display = cardRadio.checked ? 'block' : 'none';
    }

    document.querySelectorAll('input[name="payment_method"]').forEach(function (input) {
        input.addEventListener('change', toggleCardFields);
    });

    document.addEventListener('DOMContentLoaded', toggleCardFields);
</script>
@endsection
