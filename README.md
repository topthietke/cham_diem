# PHP QBank — Ngân hàng câu hỏi phỏng vấn PHP Developer (Middle)

Hệ thống gồm **200 câu hỏi & đáp án PHP** (20 chủ đề), giao diện tra cứu công khai
(Bootstrap 5 + JS tìm kiếm/lọc trực tiếp qua AJAX) và trang **Admin quản trị nội dung** (CRUD đầy đủ).

## Yêu cầu
- PHP >= 8.0 với extension `pdo_sqlite` (có sẵn trong hầu hết bản cài PHP mặc định)
- Không cần cài đặt MySQL — dữ liệu lưu trong file SQLite tự tạo tại `data/qbank.sqlite`

## Cách chạy
```bash
cd qbank
php -S localhost:8000
```
Mở trình duyệt: http://localhost:8000

## Trang Admin
- URL: http://localhost:8000/admin/login.php
- Tài khoản mặc định: `admin` / `admin123`
- Chức năng: Thêm / Sửa / Xóa câu hỏi, tìm kiếm, lọc theo chủ đề, phân trang.

## Cấu trúc thư mục
```
qbank/
├── index.php              # Trang public - tra cứu 200 câu hỏi
├── api/search.php         # API JSON phục vụ tìm kiếm/lọc bằng JS (fetch)
├── assets/
│   ├── style.css          # Giao diện tùy chỉnh
│   └── app.js              # Logic tìm kiếm/lọc trực tiếp phía client
├── includes/
│   ├── db.php              # Kết nối SQLite + tự động seed dữ liệu lần đầu chạy
│   ├── functions.php       # Hàm dùng chung
│   └── seed_data.php       # Bộ 200 câu hỏi & đáp án gốc
├── admin/
│   ├── login.php / logout.php
│   ├── index.php           # Danh sách câu hỏi (tìm kiếm, lọc, xóa, phân trang)
│   ├── add.php              # Thêm câu hỏi mới
│   └── edit.php             # Sửa câu hỏi
└── data/qbank.sqlite        # Database (tự động tạo khi chạy lần đầu)
```

## Nếu muốn chuyển sang MySQL
Chỉ cần sửa `includes/db.php`, thay dòng khởi tạo PDO SQLite bằng:
```php
$pdo = new PDO('mysql:host=localhost;dbname=qbank;charset=utf8mb4', $user, $pass);
```
Toàn bộ code còn lại (câu truy vấn, cú pháp PDO) tương thích sẵn với MySQL, không cần sửa gì thêm.

## Ghi chú bảo mật khi triển khai thực tế
- Đổi mật khẩu admin mặc định ngay sau khi cài đặt (bảng `admins` trong DB).
- Toàn bộ truy vấn dùng **Prepared Statement** (PDO) để chống SQL Injection.
- Output luôn qua `htmlspecialchars()` để chống XSS.
- Nên đặt thư mục `data/` ngoài web root hoặc chặn truy cập trực tiếp khi deploy production.
