@extends('layout')

@section('title', 'Danh Sách Sách')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="mb-0"><i class="fas fa-list me-2"></i>Danh Sách Sách</h4>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('books.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Thêm Sách Mới
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                @if($books->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Tiêu Đề</th>
                                    <th>Tác Giả</th>
                                    <th>Giá</th>
                                    <th>Số Lượng</th>
                                    <th>Thể Loại</th>
                                    <th>Năm Xuất Bản</th>
                                    <th class="text-center">Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $book)
                                    <tr>
                                        <td>#{{ $book->id }}</td>
                                        <td>
                                            <strong>{{ $book->title }}</strong>
                                        </td>
                                        <td>{{ $book->author }}</td>
                                        <td>
                                            <span class="badge bg-success">{{ number_format($book->price, 0, ',', '.') }}đ</span>
                                        </td>
                                        <td>
                                            @if($book->quantity > 0)
                                                <span class="badge bg-info">{{ $book->quantity }}</span>
                                            @else
                                                <span class="badge bg-danger">Hết hàng</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($book->category)
                                                <span class="badge bg-secondary">{{ $book->category }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($book->publication_year)
                                                {{ $book->publication_year }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('books.show', $book->id) }}" 
                                                   class="btn btn-info" title="Xem chi tiết">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('books.edit', $book->id) }}" 
                                                   class="btn btn-warning" title="Chỉnh sửa">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('books.destroy', $book->id) }}" 
                                                      method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa sách này?')"
                                                            title="Xóa">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center p-3">
                        {{ $books->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox" style="font-size: 3rem; color: #ccc;"></i>
                        <h5 class="mt-3">Không có sách nào</h5>
                        <p class="text-muted">Bắt đầu thêm sách để quản lý kho hàng của bạn</p>
                        <a href="{{ route('books.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Thêm Sách Đầu Tiên
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
