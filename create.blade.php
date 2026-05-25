@extends('layout')

@section('title', 'Thêm Sách Mới')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0"><i class="fas fa-plus me-2"></i>Thêm Sách Mới</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu Đề <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}" 
                               placeholder="Nhập tiêu đề sách" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="author" class="form-label">Tác Giả <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('author') is-invalid @enderror" 
                               id="author" name="author" value="{{ old('author') }}" 
                               placeholder="Nhập tên tác giả" required>
                        @error('author')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="text" class="form-control @error('isbn') is-invalid @enderror" 
                                   id="isbn" name="isbn" value="{{ old('isbn') }}" 
                                   placeholder="Nhập ISBN">
                            @error('isbn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Giá <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                       id="price" name="price" value="{{ old('price') }}" 
                                       placeholder="0" step="0.01" min="0" required>
                                <span class="input-group-text">₫</span>
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="quantity" class="form-label">Số Lượng <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                   id="quantity" name="quantity" value="{{ old('quantity') }}" 
                                   placeholder="0" min="0" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="publication_year" class="form-label">Năm Xuất Bản</label>
                            <input type="number" class="form-control @error('publication_year') is-invalid @enderror" 
                                   id="publication_year" name="publication_year" value="{{ old('publication_year') }}" 
                                   placeholder="YYYY" min="1000" max="{{ date('Y') }}">
                            @error('publication_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Thể Loại</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror" 
                                   id="category" name="category" value="{{ old('category') }}" 
                                   placeholder="Nhập thể loại sách">
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="publisher" class="form-label">Nhà Xuất Bản</label>
                            <input type="text" class="form-control @error('publisher') is-invalid @enderror" 
                                   id="publisher" name="publisher" value="{{ old('publisher') }}" 
                                   placeholder="Nhập tên nhà xuất bản">
                            @error('publisher')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô Tả</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4" 
                                  placeholder="Nhập mô tả sách">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image_url" class="form-label">Link Ảnh (URL)</label>
                        <input type="url" class="form-control @error('image_url') is-invalid @enderror"
                               id="image_url" name="image_url" value="{{ old('image_url') }}"
                               placeholder="https://example.com/image.jpg">
                        <div class="form-text">Dán link ảnh trực tiếp hoặc để trống.</div>
                        @error('image_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Lưu Sách
                        </button>
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Hủy
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
