# 🚀 Bắt Đầu Nhanh - Quản Lý Bán Sách

## ✅ Cài Đặt Hoàn Tất

Ứng dụng Laravel **Quản Lý Bán Sách** đã được cài đặt thành công tại:
```
C:\xampp\htdocs\quanlysach
```

### 📦 Những Gì Đã Được Tạo

✅ **Database**: SQLite database với các bảng:
- `users` - Bảng người dùng
- `books` - Bảng sách
- `migrations` - Bảng theo dõi migrations

✅ **Dữ liệu mẫu**: 8 cuốn sách mẫu đã được thêm vào database

✅ **Cấu hình**:
- `.env` - File cấu hình ứng dụng
- `APP_KEY` - Khóa bảo mật đã được tạo
- Database SQLite đã sẵn sàng

## 🎯 Cách Khởi Động

### **Cách 1: Chạy Server (Dễ Nhất) 🌟**

#### Với Windows Batch Script:
```bash
Double-click: C:\xampp\htdocs\quanlysach\start-server.bat
```

#### Hoặc với PowerShell:
```powershell
cd c:\xampp\htdocs\quanlysach
Set-ExecutionPolicy -ExecutionPolicy Bypass -Scope Process
.\start-server.ps1
```

#### Hoặc chạy manual:
```bash
cd c:\xampp\htdocs\quanlysach
D:\xampp\php\php.exe artisan serve
```

Khi server khởi động, bạn sẽ thấy:
```
INFO  Server running on [http://127.0.0.1:8000]
```

**Truy cập**: http://127.0.0.1:8000/books

---

### **Cách 2: Sử Dụng XAMPP Apache**

1. **Kích hoạt mod_rewrite** trong Apache
   - Chỉnh sửa `D:\xampp\apache\conf\httpd.conf`
   - Tìm dòng: `#LoadModule rewrite_module modules/mod_rewrite.so`
   - Bỏ dấu `#`: `LoadModule rewrite_module modules/mod_rewrite.so`

2. **Cấu hình Virtual Host** (tùy chọn):
   - Thêm vào `D:\xampp\apache\conf\extra\httpd-vhosts.conf`:
   ```apache
   <VirtualHost *:80>
       DocumentRoot "C:\xampp\htdocs\quanlysach\public"
       ServerName quanlysach.local
       <Directory "C:\xampp\htdocs\quanlysach\public">
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```

3. **Khởi động Apache** từ XAMPP Control Panel

4. **Truy cập**: `http://localhost/quanlysach/public` 
   - hoặc `http://quanlysach.local` (nếu cấu hình virtual host)

---

## 🎓 Sử Dụng Ứng Dụng

### Trang Chủ - Danh Sách Sách
- **URL**: `http://127.0.0.1:8000/books`
- Xem danh sách tất cả sách với phân trang
- Click nút **"Thêm Sách Mới"** để thêm sách
- Click biểu tượng **👁️** để xem chi tiết
- Click biểu tượng **✏️** để chỉnh sửa
- Click biểu tượng **🗑️** để xóa

### Thêm Sách Mới
- **URL**: `http://127.0.0.1:8000/books/create`
- Điền các thông tin sách
- Click **"Lưu Sách"**

### Chỉnh Sửa Sách
- Click nút **✏️** trên bảng danh sách hoặc trang chi tiết
- Cập nhật thông tin
- Click **"Cập Nhật"**

### Xem Chi Tiết Sách
- Click nút **👁️** hoặc tên sách trên bảng danh sách
- Xem toàn bộ thông tin sách

### Xóa Sách
- Click nút **🗑️**
- Xác nhận xóa trong dialog

---

## 📊 Quản Lý Dữ Liệu

### Xem dữ liệu trong SQLite
```bash
# Cài đặt SQLite client (nếu chưa có)
# Hoặc sử dụng các tool GUI như DB Browser for SQLite

# File database:
C:\xampp\htdocs\quanlysach\database\database.sqlite
```

### Thêm dữ liệu mẫu khác
```bash
cd c:\xampp\htdocs\quanlysach
D:\xampp\php\php.exe artisan db:seed --class=BookSeeder
```

### Reset database (Xóa tất cả dữ liệu)
```bash
cd c:\xampp\htdocs\quanlysach
D:\xampp\php\php.exe artisan migrate:refresh
D:\xampp\php\php.exe artisan db:seed
```

---

## 🐛 Giải Quyết Lỗi Thường Gặp

### ❌ Lỗi: "Class 'BookController' not found"
```bash
composer dump-autoload --ignore-platform-reqs
```

### ❌ Lỗi: Database file not found
```powershell
cd C:\xampp\htdocs\quanlysach\database
New-Item -ItemType File -Name "database.sqlite"
cd ..
D:\xampp\php\php.exe artisan migrate
```

### ❌ Lỗi: Không thể kết nối database
- Kiểm tra file `database/database.sqlite` có tồn tại
- Chạy lại migrations: `D:\xampp\php\php.exe artisan migrate`

### ❌ Lỗi: 404 Not Found
- Đảm bảo URL đúng: `http://127.0.0.1:8000/books`
- Server Laravel đang chạy (`artisan serve`)

### ❌ Lỗi: "Allowed memory exhausted"
```bash
# Tăng memory limit trong .env
PHP_MEMORY_LIMIT=256M
```

---

## 📝 Cấu Hình Nâng Cao

### Đổi Database từ SQLite sang MySQL

1. **Tạo database MySQL**:
```sql
CREATE DATABASE quanlysach CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. **Cập nhật `.env`**:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=quanlysach
DB_USERNAME=root
DB_PASSWORD=
```

3. **Chạy migrations**:
```bash
D:\xampp\php\php.exe artisan migrate
D:\xampp\php\php.exe artisan db:seed
```

### Thay Đổi Port Server
```bash
D:\xampp\php\php.exe artisan serve --port=8080
# Truy cập: http://127.0.0.1:8080
```

### Bật Maintenance Mode
```bash
D:\xampp\php\php.exe artisan down
# Ứng dụng sẽ hiển thị trang "Under Maintenance"

D:\xampp\php\php.exe artisan up
# Tắt maintenance mode
```

---

## 📚 Các Lệnh Artisan Hữu Ích

```bash
# Liệt kê tất cả routes
D:\xampp\php\php.exe artisan route:list

# Tạo database cache
D:\xampp\php\php.exe artisan cache:clear

# Xóa cache view
D:\xampp\php\php.exe artisan view:clear

# Xóa tất cả cache
D:\xampp\php\php.exe artisan cache:clear && php artisan config:clear && php artisan view:clear

# Tạo link storage (nếu cần upload file)
D:\xampp\php\php.exe artisan storage:link
```

---

## 🔗 Các Route Chính

| Phương thức | URL | Mô tả | Ví dụ |
|----------|-----|-------|-------|
| GET | `/books` | Danh sách sách | http://127.0.0.1:8000/books |
| GET | `/books/create` | Form thêm sách | http://127.0.0.1:8000/books/create |
| POST | `/books` | Lưu sách mới | (form action) |
| GET | `/books/{id}` | Chi tiết sách | http://127.0.0.1:8000/books/1 |
| GET | `/books/{id}/edit` | Form chỉnh sửa | http://127.0.0.1:8000/books/1/edit |
| PUT/PATCH | `/books/{id}` | Cập nhật sách | (form action) |
| DELETE | `/books/{id}` | Xóa sách | (form action) |

---

## 🎨 Tùy Chỉnh Giao Diện

Tất cả các file view được đặt tại:
```
resources/views/
├── layout.blade.php      # Layout chính (header, footer)
└── books/
    ├── index.blade.php   # Danh sách
    ├── create.blade.php  # Form thêm
    ├── edit.blade.php    # Form chỉnh sửa
    └── show.blade.php    # Chi tiết
```

### Thay Đổi Màu Chủ Đề
Chỉnh sửa `resources/views/layout.blade.php`:
```css
.navbar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    /* Thay đổi màu ở đây */
}
```

---

## 📞 Hỗ Trợ & Tài Liệu

- **Laravel Docs**: https://laravel.com/docs
- **Bootstrap 5**: https://getbootstrap.com/docs
- **Font Awesome**: https://fontawesome.com/icons

---

## ✨ Tính Năng Có Thể Thêm Sau

- 🔐 Hệ thống đăng nhập/đăng ký
- 🔍 Tìm kiếm sách nâng cao
- 📊 Thống kê/báo cáo
- 💳 Quản lý hóa đơn/đơn hàng
- 📧 Thông báo qua email
- 📱 Mobile app
- 🌍 Đa ngôn ngữ

---

**Chúc bạn sử dụng vui vẻ! 🎉**

Ngày cập nhật: 25/05/2026
