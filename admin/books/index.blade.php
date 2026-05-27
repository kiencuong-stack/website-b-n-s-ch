@extends('admin.layout')

@section('title', 'Quản Lý Sách')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-book"></i> Danh Sách Sách</h5>
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm Sách Mới
        </a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Tiêu Đề</th>
                    <th>Tác Giả</th>
                    <th>Giá</th>
                    <th>Tồn Kho</th>
                    <th>Danh Mục</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td><strong>#{{ $book->id }}</strong></td>
                        <td>
                            <strong>{{ Str::limit($book->title, 30) }}</strong><br>
                            <small class="text-muted">ISBN: {{ $book->isbn }}</small>
                        </td>
                        <td>{{ $book->author }}</td>
                        <td>
                            <strong>{{ number_format($book->price, 0, ',', '.') }} VNĐ</strong>
                        </td>
                        <td>
                            <span class="badge bg-{{ $book->quantity < 10 ? 'danger' : 'success' }}">
                                {{ $book->quantity }}
                            </span>
                        </td>
                        <td>
                            <small>{{ $book->category ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-info" title="Xem">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning" title="Sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn chắc chắn muốn xóa?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Chưa có sách nào</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
    {{ $books->links() }}
</div>
@endsection
