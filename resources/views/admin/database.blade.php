@extends('admin.layout')

@section('title', 'Quản Lý Dữ Liệu')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-database"></i> Trình Quản Lý Dữ Liệu</h5>
        <small class="text-muted">Chỉ admin mới truy cập được</small>
    </div>
    <div class="card-body">
        <p>Trang này cho phép bạn điều hướng nhanh tới các bảng chính của hệ thống.</p>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card border-primary h-100">
                    <div class="card-body">
                        <h6 class="card-title">Sách</h6>
                        <p class="card-text">Số bản ghi: <strong>{{ $tableCounts['books'] }}</strong></p>
                        <a href="{{ route('admin.books.index') }}" class="btn btn-primary btn-sm">Mở quản lý sách</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-success h-100">
                    <div class="card-body">
                        <h6 class="card-title">Người dùng</h6>
                        <p class="card-text">Số bản ghi: <strong>{{ $tableCounts['users'] }}</strong></p>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-success btn-sm">Mở quản lý user</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-warning h-100">
                    <div class="card-body">
                        <h6 class="card-title">Đơn hàng</h6>
                        <p class="card-text">Số bản ghi: <strong>{{ $tableCounts['orders'] }}</strong></p>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-warning btn-sm">Mở quản lý đơn hàng</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <p class="text-muted">Nếu bạn cần chỉnh dữ liệu khác, hãy sử dụng các trang quản lý phía trên. Đây là cách an toàn nhất để sửa dữ liệu qua web.</p>
    </div>
</div>
@endsection