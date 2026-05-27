-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 25, 2026 lúc 08:27 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlysach`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `publication_year` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `isbn`, `price`, `quantity`, `category`, `publisher`, `publication_year`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Sapiens: Lược Sử Loài Người', 'Yuval Noah Harari', '978-0062316110', 180000.00, 20, 'Khoa học xã hội', 'NXB Trẻ', 2018, 'Một cái nhìn toàn diện về lịch sử và tương lai của loài người.', 'https://down-vn.img.susercontent.com/file/7ed15c4fa8c2437079621d52ca38e796.webp', '2026-05-25 11:15:40', '2026-05-25 11:17:55'),
(2, 'Atomic Habits', 'James Clear', '978-0735211292', 220000.00, 15, 'Phát triển bản thân', 'NXB Trẻ', 2019, 'Phương pháp xây dựng thói quen tốt và loại bỏ thói quen xấu.', 'https://pos.nvncdn.com/fd5775-40602/ps/20240107_7xE6cNqlzc.jpeg?v=1704611729', '2026-05-25 11:15:40', '2026-05-25 11:18:18'),
(3, 'Làm Đĩ', 'Vũ Trọng Phụng', '978-0062971656', 195000.00, 10, 'Văn Học', 'Nhà Xuất Bản Văn Học', 2020, 'Làm Đĩ là một thiên tả chân tiểu thuyết mục đích là hô hào nhà đạo đức và bậc làm cha mẹ chăm lo đến hạnh phúc của con cái và phải để ý đến cái sự mà những thành kiến hủ bại vẫn coi là điều bẩn thỉu, tức cái sự dâm.', 'https://307a0e78.vws.vegacdn.vn/view/v2/image/img.book/0/0/1/37094.jpg?v=2&w=480&h=700', '2026-05-25 11:15:40', '2026-05-25 11:20:27'),
(4, 'Hành Trình Về Phương Đông', 'Nguyễn Phong Việt', '978-6042092712', 120000.00, 12, 'Tự truyện', 'NXB Văn học', 2017, 'Câu chuyện truyền cảm hứng về hành trình khám phá bản thân.', 'https://firstnews.vn/upload/products/original/-1728469781.jpg', '2026-05-25 11:15:40', '2026-05-25 11:20:51'),
(5, 'Bắt Trẻ Đồng Xanh', 'J.D. Salinger', '978-0316769488', 155000.00, 18, 'Tiểu thuyết', 'NXB Hội Nhà Văn', 1994, 'Tác phẩm văn học kinh điển về tuổi trẻ và sự nổi loạn.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGIvGM6jJjF8CLtZ0qshcqRDigQL5MmVRLcBU479u7C4bVMVZl4ZWts6ZQ9TFA4T4VaiN2ovSGmSZP2SUJ0Y2gcuhwmWTf6fp7TqRR8ig&s=10', '2026-05-25 11:15:40', '2026-05-25 11:21:14'),
(6, 'Giải Mã Tâm Lý', 'Adam Grant', '978-1982144504', 205000.00, 14, 'Khoa học tâm lý', 'NXB Tri Thức', 2021, 'Khám phá cách con người suy nghĩ và đưa ra quyết định.', 'https://down-vn.img.susercontent.com/file/vn-11134207-820l4-mef722maiakka7_tn', '2026-05-25 11:15:40', '2026-05-25 11:21:38'),
(7, 'Nghìn Lẻ Một Đêm', 'Anonymous', '978-603-04-0574-2', 89000.00, 22, 'Truyện cổ tích', 'NXB Phụ Nữ', 2016, 'Tuyển tập truyện cổ tích nổi tiếng từ Trung Đông.', 'https://sachhay.luatnbs.com/wp-content/uploads/2016/12/Nghin-le-mot-dem-tron-bo-768x1151.jpg', '2026-05-25 11:15:40', '2026-05-25 11:21:58'),
(8, 'Đắc Nhân Tâm', 'Dale Carnegie', '978-0671027032', 175000.00, 16, 'Kỹ năng sống', 'NXB Lao Động', 2015, 'Cẩm nang kỹ năng ứng xử và thuyết phục người khác.', 'https://cdn1.fahasa.com/media/catalog/product/d/n/dntttttuntitled.jpg', '2026-05-25 11:15:40', '2026-05-25 11:22:13'),
(9, 'Tư Duy Nhanh Và Chậm', 'Daniel Kahneman', '978-0374533557', 215000.00, 13, 'Khoa học', 'NXB Tri Thức', 2013, 'Giải thích hai hệ thống tư duy của con người.', 'https://cdn.24hmoney.vn/upload/images/2023-3/article_img/2023-08-22/3e4b1b3ad4c6406e4c00b4f184e716f3-1692676086-width1200height1200.jpg', '2026-05-25 11:15:40', '2026-05-25 11:22:38'),
(10, 'Nhà Giả Kim', 'Paulo Coelho', '978-0061122415', 130000.00, 19, 'Tiểu thuyết', 'NXB Văn học', 2014, 'Cuộc hành trình tìm kiếm chân lý và ước mơ của một chàng chăn cừu.', 'https://www.netabooks.vn/Data/Sites/1/Product/6476/nha-gia-kim-01.jpg', '2026-05-25 11:15:40', '2026-05-25 11:22:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_25_000003_create_books_table', 1),
(5, '2026_05_25_000004_create_orders_table', 1),
(6, '2026_05_25_000005_create_order_items_table', 1),
(7, '2026_05_25_000006_add_user_id_to_orders_table', 1),
(8, '2026_05_25_000007_add_role_to_users_table', 1),
(9, '2026_05_25_000008_add_payment_method_to_orders_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `total_amount` decimal(12,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT 'cod',
  `status` enum('pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('x27MgM4TjwF5mEaEgBGz67g0oEqGGKwkazgXXXgk', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.121.0 Chrome/142.0.7444.265 Electron/39.8.8 Safari/537.36', 'eyJfdG9rZW4iOiJOQXBYRVprNVZaTE56RTBoMjRucTZQS05sNjlaQ01xTmF3Q09aa2poIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9zaG9wIiwicm91dGUiOiJzaG9wLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjJ9', 1779731286),
('ZupBipuiybJ9CDLCXUc82TYNz8UgCSEt2iVgyaRz', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ4U2tqODlrV2dLa1VqMG1Ub0s0ZklDSXIwdENuOEk2QXgxQm04NGEyIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9ib29rcyIsInJvdXRlIjoiYm9va3MuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=', 1779733387);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@example.com', 'admin', NULL, '$2y$12$Zt6Wg12MO3gvXftCM2ZT8uSQOgGi2r/5zTWm9ial3g43xWcObGXsS', NULL, '2026-05-25 10:45:02', '2026-05-25 10:45:02'),
(2, 'linh', 'lnhh@gmail.com', 'user', NULL, '$2y$12$fXoSSLmRbuF478eCjUW.vuO7eguqvnRpCVW7GuyhzWcEY0r0BX7pW', NULL, '2026-05-25 10:45:44', '2026-05-25 10:45:44'),
(3, 'Khách Hàng', 'khachhang@example.com', 'user', NULL, '$2y$12$nnsSl84ABkxgRrvfciLJn.jsnTCRJqId26mtKmwXuSZ0Rv/RVSARS', NULL, '2026-05-25 10:47:23', '2026-05-25 10:47:23');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_isbn_unique` (`isbn`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_book_id_foreign` (`book_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
