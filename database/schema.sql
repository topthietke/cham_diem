-- =========================================================
-- CSDL Website Mầm Non (Kindergarten Landing Page + Admin)
-- =========================================================
SET NAMES utf8mb4;
CREATE DATABASE IF NOT EXISTS mamnon_database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mamnon_database;

-- ---------------------------------------------------------
-- 1. Quản trị viên
-- ---------------------------------------------------------
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tài khoản admin mặc định được tạo tự động khi truy cập admin/setup.php lần đầu
-- (username: admin / mật khẩu: admin123) - hãy đổi mật khẩu ngay sau khi đăng nhập.

-- ---------------------------------------------------------
-- 2. Cài đặt chung (thông tin site, liên hệ, hero...)
--    key/value đa ngôn ngữ: value_vi / value_en
-- ---------------------------------------------------------
CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    value_vi TEXT,
    value_en TEXT,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO settings (setting_key, value_vi, value_en) VALUES
('site_name', 'Mầm Non Ánh Dương', 'Sunshine Kindergarten'),
('hero_title', 'Chào mừng bé đến với ngôi nhà thứ hai', 'Welcome your child to their second home'),
('hero_desc', 'Môi trường giáo dục an toàn, yêu thương, giúp bé phát triển toàn diện về thể chất, trí tuệ và cảm xúc ngay từ những năm đầu đời.', 'A safe, loving educational environment that helps your child grow comprehensively from the very first years.'),
('hero_btn1', 'Đăng ký tư vấn', 'Book a consultation'),
('hero_btn2', 'Tham quan trường', 'Take a tour'),
('about_label', 'Về chúng tôi', 'About us'),
('about_title', 'Vì sao phụ huynh tin chọn chúng tôi', 'Why parents trust us'),
('about_desc', 'Với hơn 10 năm kinh nghiệm, chúng tôi tự hào mang đến chương trình học hiện đại, đội ngũ giáo viên tận tâm và cơ sở vật chất an toàn cho bé.', 'With over 10 years of experience, we proudly bring a modern curriculum, dedicated teachers, and a safe facility for your child.'),
('phone', '0900 123 456', '0900 123 456'),
('email', 'lienhe@mamnonanhduong.vn', 'contact@sunshinekids.vn'),
('address', '123 Đường Hoa Mai, Quận 1, TP. Hồ Chí Minh', '123 Hoa Mai Street, District 1, Ho Chi Minh City'),
('map_embed', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4!2d106.7!3d10.77" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>', ''),
('facebook_url', 'https://facebook.com', 'https://facebook.com'),
('working_hours', 'Thứ 2 - Thứ 7: 6:30 - 17:30', 'Mon - Sat: 6:30 AM - 5:30 PM'),
('hero_image', 'banner/hero.svg', 'banner/hero.svg'),
('about_image', 'banner/about.svg', 'banner/about.svg');

-- ---------------------------------------------------------
-- 3. Thống kê (số liệu hiển thị dưới hero: 100+ học sinh...)
-- ---------------------------------------------------------
CREATE TABLE stats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    number_value VARCHAR(20) NOT NULL,
    label_vi VARCHAR(100) NOT NULL,
    label_en VARCHAR(100) NOT NULL,
    icon VARCHAR(50) DEFAULT 'bi-star-fill',
    sort_order INT DEFAULT 0
) ENGINE=InnoDB;

INSERT INTO stats (number_value, label_vi, label_en, icon, sort_order) VALUES
('300+', 'Học sinh', 'Students', 'bi-emoji-smile', 1),
('20+', 'Giáo viên', 'Teachers', 'bi-person-hearts', 2),
('10+', 'Năm kinh nghiệm', 'Years of experience', 'bi-award', 3),
('15+', 'Hoạt động ngoại khóa', 'Extracurricular activities', 'bi-puzzle', 4);

-- ---------------------------------------------------------
-- 4. Banner (slider trang chủ)
-- ---------------------------------------------------------
CREATE TABLE banners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title_vi VARCHAR(255),
    title_en VARCHAR(255),
    subtitle_vi VARCHAR(255),
    subtitle_en VARCHAR(255),
    image VARCHAR(255) NOT NULL,
    link VARCHAR(255) DEFAULT '#',
    status TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0
) ENGINE=InnoDB;

INSERT INTO banners (title_vi, title_en, image, sort_order) VALUES
('Chào mừng bé đến với ngôi nhà thứ hai', 'Welcome to your child''s second home', 'banner/hero.svg', 1);

-- ---------------------------------------------------------
-- 5. Danh mục header (menu điều hướng)
-- ---------------------------------------------------------
CREATE TABLE menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label_vi VARCHAR(100) NOT NULL,
    label_en VARCHAR(100) NOT NULL,
    link VARCHAR(255) DEFAULT '#',
    sort_order INT DEFAULT 0,
    status TINYINT(1) DEFAULT 1
) ENGINE=InnoDB;

INSERT INTO menus (label_vi, label_en, link, sort_order) VALUES
('Trang chủ', 'Home', '#home', 1),
('Giới thiệu', 'About', '#about', 2),
('Chương trình học', 'Programs', '#programs', 3),
('Hoạt động', 'Activities', '#activities', 4),
('Giáo viên', 'Teachers', '#teachers', 5),
('Liên hệ', 'Contact', '#contact', 6);

-- ---------------------------------------------------------
-- 6. Chương trình học theo độ tuổi
-- ---------------------------------------------------------
CREATE TABLE age_groups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_vi VARCHAR(100) NOT NULL,
    name_en VARCHAR(100) NOT NULL,
    age_range VARCHAR(50),
    desc_vi TEXT,
    desc_en TEXT,
    icon VARCHAR(50) DEFAULT 'bi-flower1',
    sort_order INT DEFAULT 0,
    status TINYINT(1) DEFAULT 1
) ENGINE=InnoDB;

INSERT INTO age_groups (name_vi, name_en, age_range, desc_vi, desc_en, icon, sort_order) VALUES
('Lớp Mầm', 'Nursery Class', '2 - 3 tuổi', 'Giúp bé làm quen môi trường lớp học, phát triển vận động và ngôn ngữ cơ bản.', 'Helps children get used to the classroom environment and develop basic motor and language skills.', 'bi-flower1', 1),
('Lớp Chồi', 'Junior Class', '3 - 4 tuổi', 'Phát triển kỹ năng giao tiếp, làm quen chữ cái, số đếm qua trò chơi.', 'Develops communication skills, letters and numbers through play.', 'bi-flower2', 2),
('Lớp Lá', 'Senior Class', '4 - 5 tuổi', 'Trang bị kỹ năng tiền tiểu học, tư duy logic và tính tự lập cho bé.', 'Provides pre-primary skills, logical thinking and independence.', 'bi-tree', 3),
('Kỹ Năng Sống', 'Life Skills', '2 - 5 tuổi', 'Rèn luyện kỹ năng sống, tự phục vụ và ứng xử xã hội cho trẻ.', 'Trains life skills, self-care and social behavior for children.', 'bi-heart', 4);

-- ---------------------------------------------------------
-- 7. Hoạt động tại trường (thư viện ảnh)
-- ---------------------------------------------------------
CREATE TABLE activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title_vi VARCHAR(150),
    title_en VARCHAR(150),
    image VARCHAR(255) NOT NULL,
    sort_order INT DEFAULT 0,
    status TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO activities (title_vi, title_en, image, sort_order) VALUES
('Vẽ tranh sáng tạo', 'Creative painting', 'activities/act1.svg', 1),
('Học chữ vui vẻ', 'Fun letter learning', 'activities/act2.svg', 2),
('Xếp hình Lego', 'Lego building', 'activities/act3.svg', 3),
('Vui chơi ngoài trời', 'Outdoor play', 'activities/act4.svg', 4);

-- ---------------------------------------------------------
-- 8. Đội ngũ giáo viên
-- ---------------------------------------------------------
CREATE TABLE teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    position_vi VARCHAR(150),
    position_en VARCHAR(150),
    photo VARCHAR(255),
    sort_order INT DEFAULT 0,
    status TINYINT(1) DEFAULT 1
) ENGINE=InnoDB;

INSERT INTO teachers (name, position_vi, position_en, photo, sort_order) VALUES
('Nguyễn Thị Lan', 'Hiệu trưởng', 'Principal', 'teachers/t1.svg', 1),
('Emmawell West', 'Giáo viên chủ nhiệm', 'Homeroom teacher', 'teachers/t2.svg', 2),
('Đỗ Khôi Nguyên', 'Giáo viên Anh ngữ', 'English teacher', 'teachers/t3.svg', 3),
('Lê Bảo Ngọc', 'Giáo viên năng khiếu', 'Talent teacher', 'teachers/t4.svg', 4);

-- ---------------------------------------------------------
-- 9. Cảm nhận phụ huynh
-- ---------------------------------------------------------
CREATE TABLE testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parent_name VARCHAR(150) NOT NULL,
    content_vi TEXT,
    content_en TEXT,
    avatar VARCHAR(255),
    rating TINYINT DEFAULT 5,
    sort_order INT DEFAULT 0,
    status TINYINT(1) DEFAULT 1
) ENGINE=InnoDB;

INSERT INTO testimonials (parent_name, content_vi, content_en, avatar, rating, sort_order) VALUES
('Chị Phạm Thị Hương', 'Con tôi rất vui khi đến trường mỗi ngày, cô giáo tận tâm và chương trình học rất phù hợp.', 'My child is happy to go to school every day, the teachers are dedicated and the curriculum is great.', 'teachers/p1.svg', 5, 1),
('Anh Nguyễn Minh Đức', 'Cơ sở vật chất sạch sẽ, an toàn. Bé tiến bộ rõ rệt về kỹ năng giao tiếp sau vài tháng.', 'Clean and safe facilities. My child improved communication skills noticeably after a few months.', 'teachers/p2.svg', 5, 2),
('Chị Trần Thu Hà', 'Đội ngũ giáo viên yêu thương trẻ, luôn cập nhật tình hình học tập cho phụ huynh.', 'Loving teachers who always update parents on learning progress.', 'teachers/p3.svg', 5, 3);

-- ---------------------------------------------------------
-- 10. Tin tức / hoạt động mới nhất
-- ---------------------------------------------------------
CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title_vi VARCHAR(255) NOT NULL,
    title_en VARCHAR(255),
    summary_vi TEXT,
    summary_en TEXT,
    content_vi LONGTEXT,
    content_en LONGTEXT,
    image VARCHAR(255),
    slug VARCHAR(255),
    status TINYINT(1) DEFAULT 1,
    published_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO news (title_vi, title_en, summary_vi, summary_en, image, slug, published_at) VALUES
('Khai giảng năm học mới 2026 - 2027', 'Opening ceremony school year 2026-2027', 'Trường tổ chức lễ khai giảng chào đón các bé và phụ huynh với nhiều hoạt động ý nghĩa.', 'The school held an opening ceremony welcoming children and parents with meaningful activities.', 'news/n1.svg', 'khai-giang-nam-hoc-moi', '2026-08-05 08:00:00'),
('Ngày hội thể thao IDVA cho các bé', 'IDVA Sports Day for kids', 'Chương trình vận động thể chất giúp bé rèn luyện sức khỏe và tinh thần đồng đội.', 'A physical activity program helping children build health and teamwork spirit.', 'news/n2.svg', 'ngay-hoi-the-thao', '2026-07-20 08:00:00');

-- ---------------------------------------------------------
-- 11. Tin nhắn liên hệ / đăng ký tư vấn (từ landing page)
-- ---------------------------------------------------------
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parent_name VARCHAR(150) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    message TEXT,
    status ENUM('new','read','replied') DEFAULT 'new',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
