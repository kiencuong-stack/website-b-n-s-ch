@extends('layout')

@section('title', $book->title)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-body">
                <h2>{{ $book->title }}</h2>
                <p class="text-muted">Tác giả: {{ $book->author }}</p>
                <p class="mb-2"><strong>Giá:</strong> <span class="text-success h4">{{ number_format($book->price, 0, ',', '.') }}₫</span></p>
                <p class="mb-2"><strong>Tồn kho:</strong>
                    @if($book->quantity > 0)
                        <span class="badge bg-success">{{ $book->quantity }}</span>
                    @else
                        <span class="badge bg-danger">Hết hàng</span>
                    @endif
                </p>

                <p class="mt-3">{{ $book->description ?: 'Không có mô tả' }}</p>

                @if($book->quantity > 0)
                    <form action="{{ route('shop.addToCart', $book->id) }}" method="POST" class="mt-4">
                        @csrf
                        <div class="input-group mb-3" style="max-width: 200px;">
                            <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $book->quantity }}">
                            <button class="btn btn-success" type="submit"><i class="fas fa-cart-plus me-1"></i> Thêm vào giỏ</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5>Chi tiết nhanh</h5>
                <p class="mb-1"><strong>ISBN:</strong> {{ $book->isbn ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Nhà xuất bản:</strong> {{ $book->publisher ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Năm xuất bản:</strong> {{ $book->publication_year ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Thể loại:</strong> {{ $book->category ?? 'N/A' }}</p>
            </div>
        </div>

        <a href="{{ route('shop.cart') }}" class="btn btn-primary w-100 mb-2">Xem giỏ hàng</a>
        <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary w-100">Quay lại cửa hàng</a>
    </div>
</div>
@endsection
