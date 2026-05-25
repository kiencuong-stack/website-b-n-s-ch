@extends('layout')

@section('title', 'Cửa Hàng Bán Sách')

@section('content')
<div class="hero-banner rounded-4 p-5 mb-5">
    <div class="row align-items-center">
        <div class="col-md-8">
            <span class="badge bg-white text-primary mb-3">Mua Sách Online</span>
            <h1 class="display-5 fw-bold">Khám phá sách hay, mua nhanh, giao tận nơi</h1>
            <p class="lead opacity-85">Duyệt qua hàng trăm tựa sách đa dạng từ văn học, kỹ năng đến tiểu thuyết. Mua sắm đơn giản, giao hàng nhanh chóng.</p>
        </div>
        <div class="col-md-4 text-md-end mt-4 mt-md-0">
            <a href="{{ route('shop.cart') }}" class="btn btn-light btn-lg shadow-sm position-relative">
                <i class="fas fa-shopping-cart me-2"></i> Giỏ Hàng
                @if(session('cart'))
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </a>
        </div>
    </div>
</div>

@if($books->count() > 0)
        <div class="row g-4">
            @foreach($books as $book)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 book-card shadow-sm">
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px; color: #999;">
                            @if($book->image)
                                @if(filter_var($book->image, FILTER_VALIDATE_URL))
                                    <img src="{{ $book->image }}" alt="{{ $book->title }}" class="img-fluid" style="max-height: 200px; object-fit: contain;">
                                @else
                                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="img-fluid" style="max-height: 200px; object-fit: contain;">
                                @endif
                            @else
                                <div class="text-center">
                                    <i class="fas fa-book" style="font-size: 3rem;"></i>
                                    <p class="mt-2">{{ $book->title }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate">{{ $book->title }}</h5>
                            <p class="card-text text-muted small">
                                <i class="fas fa-user me-1"></i>{{ $book->author }}
                            </p>
                            
                            @if($book->category)
                                <p class="mb-2">
                                    <span class="badge bg-info">{{ $book->category }}</span>
                                </p>
                            @endif

                            <div class="mt-auto">
                                <div class="row mb-3">
                                    <div class="col">
                                        <p class="mb-0 text-muted small">Giá</p>
                                        <p class="h5 text-success mb-0">{{ number_format($book->price, 0, ',', '.') }}₫</p>
                                    </div>
                                    <div class="col text-end">
                                        <p class="mb-0 text-muted small">Tồn kho</p>
                                        <p class="h6 mb-0">
                                            @if($book->quantity > 0)
                                                <span class="badge bg-success">{{ $book->quantity }}</span>
                                            @else
                                                <span class="badge bg-danger">Hết hàng</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <a href="{{ route('shop.show', $book->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i>Xem Chi Tiết
                                    </a>
                                    @if($book->quantity > 0)
                                        <form action="{{ route('shop.addToCart', $book->id) }}" method="POST">
                                            @csrf
                                            <div class="input-group input-group-sm mb-2">
                                                <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $book->quantity }}">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-cart-plus me-1"></i>Thêm
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled>
                                            <i class="fas fa-ban me-1"></i>Hết Hàng
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $books->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-inbox" style="font-size: 4rem; color: #ccc;"></i>
            <h5 class="mt-3">Không có sách nào có sẵn</h5>
            <p class="text-muted">Vui lòng quay lại sau</p>
        </div>
    @endif
</div>

<style>
    .hero-banner {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #e7f0ff 0%, #ffffff 45%, #f8fbff 100%);
        background-size: 300% 300%;
        animation: slow-banner-wave 20s ease infinite;
    }

    .hero-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top left, rgba(255, 255, 255, 0.5), transparent 35%),
                    radial-gradient(circle at bottom right, rgba(24, 144, 255, 0.12), transparent 25%);
        pointer-events: none;
    }

    @keyframes slow-banner-wave {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    .book-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
    }

    .hero-banner {
        position: relative;
        background: linear-gradient(135deg, #4f46e5 0%, #2563eb 45%, #0f172a 100%) !important;
        background-size: 250% 250% !important;
        animation: slow-banner-wave 25s ease infinite !important;
        overflow: hidden;
        color: #ffffff;
    }

    .hero-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top left, rgba(255, 255, 255, 0.32), transparent 38%),
                    radial-gradient(circle at bottom right, rgba(56, 189, 248, 0.24), transparent 30%);
        animation: hero-overlay 16s ease-in-out infinite alternate;
        pointer-events: none;
    }

    @keyframes slow-banner-wave {
        0% {
            background-position: 0% 0%;
        }
        50% {
            background-position: 100% 100%;
        }
        100% {
            background-position: 0% 0%;
        }
    }

    @keyframes hero-overlay {
        0% {
            transform: translate(0%, 0%);
            opacity: 0.8;
        }
        50% {
            transform: translate(8%, -6%);
            opacity: 0.9;
        }
        100% {
            transform: translate(0%, 0%);
            opacity: 0.8;
        }
    }
</style>
@endsection
