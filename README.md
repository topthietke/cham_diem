# Website Mầm Non Ánh Dương (Landing Page + Trang quản trị)

Landing page trường mầm non xây dựng bằng **PHP thuần + PDO + Bootstrap 5**,
hỗ trợ **song ngữ Việt / Anh**, có **trang quản trị** để quản lý toàn bộ nội dung
(menu, banner, chương trình học, thư viện ảnh, giáo viên, cảm nhận phụ huynh,
tin tức, tin nhắn liên hệ...).

## 1. Yêu cầu hệ thống

- PHP >= 7.4 (khuyến nghị PHP 8.x), có bật extension `pdo_mysql`, `gd` (hoặc `fileinfo`)
- MySQL / MariaDB >= 5.7
- Apache (có `mod_rewrite`) hoặc Nginx / server hỗ trợ PHP
- Trình duyệt hiện đại (Chrome, Edge, Firefox...)

## 2. Cài đặt

### Bước 1 — Import cơ sở dữ liệu

1. Tạo một database MySQL mới (hoặc để script tự tạo).
2. Import file `database/schema.sql` vào MySQL, ví dụ bằng dòng lệnh:

   ```bash
   mysql -u root -p < database/schema.sql
   ```

   Hoặc dùng phpMyAdmin: **Import** → chọn file `database/schema.sql` → Go.

   File này sẽ tự tạo database `mamnon_db` và toàn bộ bảng + dữ liệu mẫu
   (banner, chương trình học, giáo viên, cảm nhận phụ huynh, tin tức mẫu...).

### Bước 2 — Cấu hình kết nối database

Mở file `config/db.php` và chỉnh lại các thông số cho đúng với server của bạn:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'mamnon_db');
define('DB_USER', 'root');
define('DB_PASS', '');
```

Nếu website không chạy ở domain gốc (ví dụ: `http://localhost/mamnon`),
hãy cập nhật thêm:

```php
define('BASE_URL', '/mamnon');
```

### Bước 3 — Tạo tài khoản quản trị mặc định

Truy cập vào đường dẫn sau **1 lần duy nhất** trên trình duyệt để tạo tài khoản admin:

```
http://<domain-cua-ban>/admin/setup.php
```

Tài khoản mặc định được tạo:

- **Tên đăng nhập:** `admin`
- **Mật khẩu:** `admin123`

⚠️ **Sau khi chạy xong, hãy xóa file `admin/setup.php` khỏi server** và đổi mật khẩu
ngay trong mục **Tài khoản của tôi** ở trang quản trị để đảm bảo an toàn.

### Bước 4 — Phân quyền thư mục upload

Đảm bảo thư mục `uploads/` (và các thư mục con `banner`, `activities`, `teachers`, `news`)
có quyền ghi (`chmod 755` hoặc `775` tùy cấu hình server):

```bash
chmod -R 755 uploads/
```

### Bước 5 — Truy cập website

- **Trang chủ (landing page):** `http://<domain-cua-ban>/index.php`
- **Trang quản trị:** `http://<domain-cua-ban>/admin/login.php`

## 3. Cấu trúc thư mục

```
├── index.php                  # Trang chủ (landing page)
├── submit_contact.php         # Xử lý form đăng ký tư vấn (AJAX)
├── config/
│   └── db.php                 # Cấu hình kết nối MySQL
├── includes/                  # Header, footer, hàm dùng chung, xử lý đa ngôn ngữ
│   ├── header.php
│   ├── footer.php
│   ├── functions.php
│   └── lang.php
├── assets/
│   ├── css/style.css          # Giao diện landing page
│   ├── css/admin.css          # Giao diện trang quản trị
│   ├── js/main.js             # Hiệu ứng, AJAX, đếm số
│   └── images/                # Ảnh tĩnh, placeholder, ảnh minh họa mẫu
├── uploads/                   # Ảnh do admin tải lên (banner, hoạt động, giáo viên, tin tức)
├── admin/                     # Toàn bộ trang quản trị
│   ├── login.php / logout.php / setup.php / account.php
│   ├── index.php              # Dashboard tổng quan
│   ├── settings.php           # Cài đặt chung (nội dung Hero, About, liên hệ... VI/EN)
│   ├── menus.php              # Quản lý danh mục menu header
│   ├── banners.php            # Quản lý banner
│   ├── stats.php              # Quản lý số liệu thống kê
│   ├── programs.php           # Quản lý chương trình học theo độ tuổi
│   ├── activities.php         # Quản lý thư viện ảnh hoạt động
│   ├── teachers.php           # Quản lý đội ngũ giáo viên
│   ├── testimonials.php       # Quản lý cảm nhận phụ huynh
│   ├── news.php                # Quản lý tin tức
│   ├── messages.php           # Quản lý tin nhắn liên hệ / đăng ký tư vấn
│   └── includes/               # auth.php, layout_head.php, layout_foot.php
└── database/
    └── schema.sql              # Toàn bộ cấu trúc + dữ liệu mẫu
```

## 4. Tính năng chính

### Landing page
- Bootstrap 5 + CSS tùy chỉnh theo phong cách mầm non (màu pastel cam/hồng/vàng),
  font chữ **Baloo 2** (tiêu đề) + **Quicksand** (nội dung) — thân thiện, dễ đọc.
- Responsive đầy đủ: Desktop / Laptop / Tablet / Mobile.
- Chuyển đổi ngôn ngữ Việt / Anh (lưu lựa chọn bằng session + cookie 30 ngày).
- Hiệu ứng cuộn mượt (scroll-reveal), số liệu thống kê chạy đếm số, hiệu ứng hover
  cho card, banner, menu.
- Toàn bộ nội dung (banner, chương trình học, hoạt động, giáo viên, cảm nhận,
  tin tức, thông tin liên hệ, bản đồ) đều lấy từ cơ sở dữ liệu — admin cập nhật
  ở đâu, trang chủ hiển thị ở đó, không cần sửa code.
- Ảnh mặc định (SVG minh họa) được cung cấp sẵn cho tất cả các mục để không bao
  giờ bị "trắng" hình khi mới cài đặt; admin có thể thay bằng ảnh thật bất cứ lúc nào.
- Form đăng ký tư vấn gửi AJAX, lưu vào database + gửi email thông báo cho quản trị
  (cần cấu hình SMTP/mail server trên hosting để nhận được email).

### Trang quản trị
- Giao diện riêng, phong cách nhẹ nhàng phù hợp ngành giáo dục mầm non,
  bố cục sidebar rõ ràng, dễ thao tác trên di động.
- Đăng nhập bảo mật bằng mật khẩu mã hoá bcrypt (`password_hash` / `password_verify`).
- Quản lý toàn bộ nội dung đa ngôn ngữ VI/EN thông qua tab chuyển đổi ngay
  trong form (không cần 2 bảng riêng biệt cho từng ngôn ngữ).
- Quản lý danh mục menu, banner, số liệu thống kê, chương trình học, thư viện ảnh,
  giáo viên, cảm nhận phụ huynh, tin tức — đầy đủ Thêm / Sửa / Xóa / Ẩn-hiện.
- Xem và xử lý tin nhắn đăng ký tư vấn từ phụ huynh (đánh dấu đã xem / đã phản hồi).
- Upload ảnh có kiểm tra định dạng, tự động đổi tên tránh trùng lặp.

## 5. Bảo mật khuyến nghị khi triển khai thật

1. Xóa file `admin/setup.php` sau khi tạo tài khoản admin.
2. Đổi mật khẩu mặc định ngay sau lần đăng nhập đầu tiên.
3. Dùng HTTPS cho toàn bộ website, đặc biệt là trang quản trị.
4. Không để `display_errors` bật ở môi trường production (chỉnh trong `php.ini`).
5. Sao lưu (backup) database định kỳ.

## 6. Tùy biến thêm

- Thay đổi bảng màu: sửa các biến `:root` trong `assets/css/style.css` (landing)
  và `assets/css/admin.css` (trang quản trị).
- Thêm ngôn ngữ khác: mở rộng `includes/lang.php` (`$allowedLangs`) và thêm cột
  `value_xx` tương ứng trong các bảng liên quan.
- Mã nhúng Google Maps: cập nhật trong **Cài đặt chung → Mã nhúng Google Maps**
  ở trang quản trị (lấy mã `<iframe>` từ Google Maps → Chia sẻ → Nhúng bản đồ).
