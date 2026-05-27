@extends('layout')

@section('title', $book->title)

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="mb-0"><i class="fas fa-book me-2"></i>Chi Tiết Sách</h4>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit me-2"></i>Chỉnh Sửa
                        </a>
                        <a href="{{ route('books.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-2"></i>Quay Lại
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4 text-center">
                        @if($book->image)
                            @if(filter_var($book->image, FILTER_VALIDATE_URL))
                                <img src="{{ $book->image }}" alt="{{ $book->title }}" class="img-fluid rounded" style="max-height: 300px;">
                            @else
                                <img src="{{ asset('storage/' . $book->image) }}" 
                                     alt="{{ $book->title }}" class="img-fluid rounded" style="max-height: 300px;">
                            @endif
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                 style="height: 300px; color: #999;">
                                <div>
                                    <i class="fas fa-image" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                                    <p>Không có ảnh</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-8">
                        <h2 class="mb-3">{{ $book->title }}</h2>

                        <div class="mb-4">
                            <p class="mb-2"><strong>Tác Giả:</strong> {{ $book->author }}</p>
                            <p class="mb-2"><strong>Nhà Xuất Bản:</strong> {{ $book->publisher ?? 'N/A' }}</p>
                            <p class="mb-2"><strong>Năm Xuất Bản:</strong> {{ $book->publication_year ?? 'N/A' }}</p>
                            <p class="mb-2"><strong>ISBN:</strong> <code>{{ $book->isbn ?? 'N/A' }}</code></p>
                            @if($book->category)
                                <p class="mb-2"><strong>Thể Loại:</strong> <span class="badge bg-secondary">{{ $book->category }}</span></p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <h5>Giá &amp; Tồn Kho</h5>
                            <p class="mb-2">
                                <strong>Giá:</strong> 
                                <span class="h4 text-success">{{ number_format($book->price, 0, ',', '.') }}₫</span>
                            </p>
                            <p class="mb-0">
                                <strong>Số Lượng Tồn:</strong> 
                                @if($book->quantity > 0)
                                    <span class="badge bg-info fs-6">{{ $book->quantity }}</span>
                                @else
                                    <span class="badge bg-danger fs-6">Hết hàng</span>
                                @endif
                            </p>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i>Chỉnh Sửa
                            </a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa sách này?')">
                                    <i class="fas fa-trash me-2"></i>Xóa
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                @if($book->description)
                    <hr>
                    <div class="mt-4">
                        <h5>Mô Tả</h5>
                        <p class="text-muted">{{ nl2br(e($book->description)) }}</p>
                    </div>
                @endif

                <hr>
                <div class="mt-4">
                    <small class="text-muted">
                        <i class="fas fa-clock me-2"></i>
                        Tạo lúc: {{ $book->created_at->format('d/m/Y H:i') }}<br>
                        <i class="fas fa-sync-alt me-2"></i>
                        Cập nhật lúc: {{ $book->updated_at->format('d/m/Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
