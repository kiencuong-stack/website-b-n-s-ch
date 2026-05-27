# Quản Lý Bán Sách - Hệ Thống Quản Lý Kho Sách

Một ứng dụng web được xây dựng bằng **Laravel** để quản lý bán sách, bao gồm các tính năng thêm, sửa, xóa, và xem chi tiết sách.

## 🚀 Tính Năng

- ✅ **Danh sách sách** - Xem tất cả sách với phân trang
- ✅ **Thêm sách mới** - Form để thêm sách vào kho
- ✅ **Chỉnh sửa sách** - Cập nhật thông tin sách
- ✅ **Xóa sách** - Xóa sách khỏi hệ thống
- ✅ **Xem chi tiết** - Hiển thị tất cả thông tin chi tiết của một cuốn sách
- ✅ **Tìm kiếm & Phân trang** - Dễ dàng quản lý danh sách sách

## 📋 Thông Tin Sách

Mỗi cuốn sách trong hệ thống gồm các thông tin:
- **Tiêu đề** - Tên sách
- **Tác giả** - Người viết
- **ISBN** - Mã định danh sách
- **Giá** - Giá bán
- **Số lượng** - Số lượng tồn kho
- **Thể loại** - Loại sách
- **Nhà xuất bản** - Công ty xuất bản
- **Năm xuất bản** - Năm phát hành
- **Mô tả** - Thông tin mô tả sách

## 🔧 Cấu Hình

### Yêu cầu hệ thống
- PHP >= 8.2
- Composer
- SQLite (hoặc MySQL/PostgreSQL)
- Laravel 13.x

### Cài đặt & Chạy

#### 1. Cài đặt dependencies
```bash
cd c:\xampp\htdocs\quanlysach
composer install --ignore-platform-reqs
```

#### 2. Tạo file .env (nếu chưa có)
```bash
copy .env.example .env
```

#### 3. Tạo application key
```bash
D:\xampp\php\php.exe artisan key:generate
```

#### 4. Chạy migrations
```bash
D:\xampp\php\php.exe artisan migrate
```

#### 5. Khởi động server
```bash
D:\xampp\php\php.exe artisan serve
```

Ứng dụng sẽ chạy tại: **http://127.0.0.1:8000**

## 🌐 Sử dụng với XAMPP

Nếu muốn sử dụng với XAMPP Apache:

1. Đảm bảo thư mục được đặt trong `C:\xampp\htdocs\quanlysach`
2. Trỏ URL: `http://localhost/quanlysach/public`
3. Cấu hình `.env`:
```
APP_URL=http://localhost/quanlysach
```

## 📁 Cấu trúc Thư Mục

```
quanlysach/
├── app/
│   ├── Models/
│   │   └── Book.php          # Model cho sách
│   └── Http/
│       └── Controllers/
│           └── BookController.php  # Controller quản lý sách
├── database/
│   ├── migrations/           # Database migrations
│   └── database.sqlite       # SQLite database
├── resources/
│   └── views/
│       ├── layout.blade.php  # Layout chính
│       └── books/
│           ├── index.blade.php     # Danh sách sách
│           ├── create.blade.php    # Form thêm sách
│           ├── edit.blade.php      # Form chỉnh sửa
│           └── show.blade.php      # Chi tiết sách
├── routes/
│   └── web.php              # Định tuyến ứng dụng
└── public/                  # Thư mục công khai
```

## 🛣️ Routes (Đường dẫn)

| Method | URL | Mô tả |
|--------|-----|-------|
| GET | `/books` | Xem danh sách sách |
| GET | `/books/create` | Form thêm sách |
| POST | `/books` | Lưu sách mới |
| GET | `/books/{id}` | Xem chi tiết sách |
| GET | `/books/{id}/edit` | Form chỉnh sửa sách |
| PUT | `/books/{id}` | Cập nhật sách |
| DELETE | `/books/{id}` | Xóa sách |

## 🎨 Giao Diện

Ứng dụng sử dụng **Bootstrap 5** để tạo giao diện đẹp mắt và responsive:
- Thanh điều hướng với gradien màu
- Bảng danh sách với icon trực quan
- Form nhập liệu với validation
- Alert thông báo thành công/lỗi
- Responsive design cho mobile

## 📦 Dependencies Chính

- **Laravel 13.x** - Web framework
- **Bootstrap 5** - CSS framework
- **Font Awesome 6** - Icon library
- **SQLite** - Database mặc định

## 🔐 Bảo Mật

- CSRF protection trên tất cả form
- Validation dữ liệu đầu vào
- Prepared statements để tránh SQL injection
- Password hashing với BCRYPT

## 📝 Cấu hình Database (Tùy chọn)

Mặc định ứng dụng sử dụng SQLite. Để sử dụng MySQL:

1. Chỉnh sửa `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=quanlysach
DB_USERNAME=root
DB_PASSWORD=
```

2. Chạy lại migrations:
```bash
D:\xampp\php\php.exe artisan migrate
```

## 🐛 Xử lý Lỗi

### Nếu gặp lỗi "Undefined constant BookController"
```bash
composer dump-autoload --ignore-platform-reqs
```

### Nếu database không tìm thấy
```bash
# Tạo file database.sqlite
New-Item -Path "database" -Name "database.sqlite"
D:\xampp\php\php.exe artisan migrate
```

## 📖 Hỗ Trợ

Để biết thêm thông tin về Laravel, xem tại: [Laravel Documentation](https://laravel.com/docs)

---

**Phiên bản**: 1.0.0  
**Tác giả**: Copilot  
**Cập nhật lần cuối**: 25/05/2026
