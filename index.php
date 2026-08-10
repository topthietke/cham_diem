<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/lang.php';
require_once __DIR__ . '/includes/functions.php';

$stats      = $pdo->query("SELECT * FROM stats ORDER BY sort_order ASC")->fetchAll();
$ageGroups  = $pdo->query("SELECT * FROM age_groups WHERE status = 1 ORDER BY sort_order ASC")->fetchAll();
$activities = $pdo->query("SELECT * FROM activities WHERE status = 1 ORDER BY sort_order ASC LIMIT 4")->fetchAll();
$teachers   = $pdo->query("SELECT * FROM teachers WHERE status = 1 ORDER BY sort_order ASC")->fetchAll();
$testimonials = $pdo->query("SELECT * FROM testimonials WHERE status = 1 ORDER BY sort_order ASC")->fetchAll();
$newsList   = $pdo->query("SELECT * FROM news WHERE status = 1 ORDER BY published_at DESC LIMIT 2")->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>

<!-- ============ HERO ============ -->
<section class="hero-section" id="home">
  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>
  <div class="blob blob-3"></div>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h1 class="hero-title reveal"><?= e(setting($pdo, 'hero_title')) ?></h1>
        <p class="hero-desc reveal"><?= e(setting($pdo, 'hero_desc')) ?></p>
        <div class="d-flex gap-3 flex-wrap reveal">
          <a href="#contact" class="btn btn-primary"><?= e(setting($pdo, 'hero_btn1')) ?></a>
          <a href="#about" class="btn btn-outline-light-custom"><?= e(setting($pdo, 'hero_btn2')) ?></a>
        </div>
      </div>
      <div class="col-lg-6 mt-4 mt-lg-0">
        <div class="hero-image-wrap reveal">
          <img src="<?= e(img_url(setting($pdo, 'hero_image'))) ?>" alt="<?= e(setting($pdo, 'site_name')) ?>">
          <div class="hero-badge">
            <div class="icon-circle"><i class="bi bi-emoji-smile-fill"></i></div>
            <div>
              <div class="fw-bold"><?= tr('300+ Phụ huynh tin tưởng', '300+ Trusted Parents') ?></div>
              <div class="small text-muted"><?= tr('Đánh giá 5 sao', '5-star rated') ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ STATS BAR ============ -->
<section class="stats-bar">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($stats as $s): ?>
      <div class="col-6 col-md-3">
        <div class="stat-item reveal">
          <i class="bi <?= e($s['icon']) ?>"></i>
          <div class="stat-number" data-count="<?= e($s['number_value']) ?>">0</div>
          <div class="stat-label"><?= e(t($s, 'label')) ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ ABOUT ============ -->
<section class="about-section" id="about">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6 order-lg-2">
        <span class="section-eyebrow reveal"><?= e(setting($pdo, 'about_label')) ?></span>
        <h2 class="section-title reveal"><?= e(setting($pdo, 'about_title')) ?></h2>
        <p class="reveal"><?= e(setting($pdo, 'about_desc')) ?></p>

        <div class="mt-4">
          <div class="about-feature reveal">
            <div class="dot"><i class="bi bi-check-lg"></i></div>
            <div>
              <strong><?= tr('Môi trường an toàn', 'Safe environment') ?></strong>
              <div class="small text-muted"><?= tr('Cơ sở vật chất đạt chuẩn, camera giám sát 24/7.', 'Standard facilities with 24/7 camera monitoring.') ?></div>
            </div>
          </div>
          <div class="about-feature reveal">
            <div class="dot"><i class="bi bi-check-lg"></i></div>
            <div>
              <strong><?= tr('Giáo viên tận tâm', 'Dedicated teachers') ?></strong>
              <div class="small text-muted"><?= tr('Đội ngũ giáo viên giàu kinh nghiệm, yêu trẻ.', 'Experienced teachers who love children.') ?></div>
            </div>
          </div>
          <div class="about-feature reveal">
            <div class="dot"><i class="bi bi-check-lg"></i></div>
            <div>
              <strong><?= tr('Chương trình quốc tế', 'International curriculum') ?></strong>
              <div class="small text-muted"><?= tr('Kết hợp phương pháp giáo dục hiện đại trong và ngoài nước.', 'Combining modern local and international teaching methods.') ?></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 order-lg-1">
        <div class="about-img reveal" style="height:420px;">
          <img src="<?= e(img_url(setting($pdo, 'about_image'))) ?>" alt="<?= tr('Về chúng tôi', 'About us') ?>">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ PROGRAMS (age groups) ============ -->
<section class="programs-section" id="programs">
  <div class="container text-center">
    <span class="section-eyebrow reveal"><?= tr('Chương trình học', 'Our Programs') ?></span>
    <h2 class="section-title reveal"><?= tr('Các lớp học theo độ tuổi', 'Classes by Age Group') ?></h2>
    <p class="section-desc reveal"><?= tr('Chương trình học được thiết kế khoa học, phù hợp với từng giai đoạn phát triển của bé.', 'A scientifically designed curriculum suited to each stage of your child\'s development.') ?></p>

    <div class="row g-4 mt-3">
      <?php foreach ($ageGroups as $ag): ?>
      <div class="col-md-6 col-lg-3">
        <div class="program-card reveal">
          <div class="program-icon"><i class="bi <?= e($ag['icon']) ?>"></i></div>
          <h4><?= e(t($ag, 'name')) ?></h4>
          <div class="program-age"><?= e($ag['age_range']) ?></div>
          <p class="small mt-2 mb-0"><?= e(t($ag, 'desc')) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ ACTIVITIES ============ -->
<section class="activities-section" id="activities">
  <div class="container text-center">
    <span class="section-eyebrow reveal"><?= tr('Khoảnh khắc đáng yêu', 'Sweet Moments') ?></span>
    <h2 class="section-title reveal"><?= tr('Hoạt động tại trường', 'Activities at School') ?></h2>
    <p class="section-desc reveal"><?= tr('Những khoảnh khắc vui chơi, học tập đáng nhớ của các bé tại trường.', 'Memorable moments of play and learning at our school.') ?></p>

    <div class="row g-4 mt-3">
      <?php foreach ($activities as $act): ?>
      <div class="col-6 col-lg-3">
        <div class="activity-item reveal">
          <img src="<?= e(img_url($act['image'])) ?>" alt="<?= e(t($act, 'title')) ?>" loading="lazy">
          <div class="caption"><?= e(t($act, 'title')) ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ TEACHERS ============ -->
<section class="teachers-section" id="teachers">
  <div class="container text-center">
    <span class="section-eyebrow reveal"><?= tr('Đội ngũ nhà trường', 'Our Team') ?></span>
    <h2 class="section-title reveal"><?= tr('Giáo viên tận tâm - giàu kinh nghiệm', 'Dedicated & Experienced Teachers') ?></h2>
    <p class="section-desc reveal"><?= tr('Đội ngũ giáo viên được đào tạo bài bản, luôn đồng hành cùng sự phát triển của bé.', 'A professionally trained team, always accompanying your child\'s growth.') ?></p>

    <div class="row g-4 mt-3 justify-content-center">
      <?php foreach ($teachers as $tc): ?>
      <div class="col-6 col-md-3">
        <div class="teacher-card reveal">
          <img src="<?= e(img_url($tc['photo'])) ?>" class="teacher-photo" alt="<?= e($tc['name']) ?>">
          <h5><?= e($tc['name']) ?></h5>
          <div class="teacher-position"><?= e(t($tc, 'position')) ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ TESTIMONIALS ============ -->
<section class="testimonials-section">
  <div class="container text-center">
    <span class="section-eyebrow reveal"><?= tr('Phụ huynh nói gì', 'What Parents Say') ?></span>
    <h2 class="section-title reveal"><?= tr('Cảm nhận từ phụ huynh', 'Parent Testimonials') ?></h2>

    <div class="row g-4 mt-3">
      <?php foreach ($testimonials as $ts): ?>
      <div class="col-md-4">
        <div class="testimonial-card reveal">
          <div class="stars">
            <?php for ($i = 0; $i < $ts['rating']; $i++): ?><i class="bi bi-star-fill"></i><?php endfor; ?>
          </div>
          <p class="text-start"><?= e(t($ts, 'content')) ?></p>
          <div class="testimonial-parent">
            <img src="<?= e(img_url($ts['avatar'])) ?>" alt="<?= e($ts['parent_name']) ?>">
            <strong><?= e($ts['parent_name']) ?></strong>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ NEWS ============ -->
<section class="news-section">
  <div class="container text-center">
    <span class="section-eyebrow reveal"><?= tr('Tin tức', 'News') ?></span>
    <h2 class="section-title reveal"><?= tr('Hoạt động & tin tức mới nhất', 'Latest News & Activities') ?></h2>

    <div class="row g-4 mt-3">
      <?php foreach ($newsList as $n): ?>
      <div class="col-md-6">
        <div class="news-card reveal">
          <img src="<?= e(img_url($n['image'])) ?>" alt="<?= e(t($n, 'title')) ?>">
          <div class="news-body text-start">
            <div class="news-date"><i class="bi bi-calendar-event me-1"></i><?= date('d/m/Y', strtotime($n['published_at'])) ?></div>
            <h5><?= e(t($n, 'title')) ?></h5>
            <p class="small mb-0"><?= e(t($n, 'summary')) ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ CONTACT ============ -->
<section class="contact-section" id="contact">
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-eyebrow reveal"><?= tr('Liên hệ', 'Contact') ?></span>
      <h2 class="section-title reveal"><?= tr('Đăng ký tư vấn miễn phí', 'Register for Free Consultation') ?></h2>
      <p class="section-desc reveal"><?= tr('Để lại thông tin, nhà trường sẽ liên hệ tư vấn cho bạn trong thời gian sớm nhất.', 'Leave your information and our school will contact you as soon as possible.') ?></p>
    </div>

    <div class="row g-4">
      <div class="col-lg-4">
        <div class="reveal">
          <div class="contact-info-item">
            <div class="icon-circle"><i class="bi bi-geo-alt"></i></div>
            <div>
              <strong><?= tr('Địa chỉ', 'Address') ?></strong>
              <div class="small text-muted"><?= e(setting($pdo, 'address')) ?></div>
            </div>
          </div>
          <div class="contact-info-item">
            <div class="icon-circle"><i class="bi bi-telephone"></i></div>
            <div>
              <strong><?= tr('Điện thoại', 'Phone') ?></strong>
              <div class="small text-muted"><?= e(setting($pdo, 'phone')) ?></div>
            </div>
          </div>
          <div class="contact-info-item">
            <div class="icon-circle"><i class="bi bi-envelope"></i></div>
            <div>
              <strong><?= tr('Email', 'Email') ?></strong>
              <div class="small text-muted"><?= e(setting($pdo, 'email')) ?></div>
            </div>
          </div>
          <div class="map-embed mt-4" style="height:220px;">
            <?= setting($pdo, 'map_embed') ?>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="contact-form-card reveal">
          <div id="formAlert" class="alert d-none"></div>
          <form id="contactForm" action="<?= BASE_URL ?>/submit_contact.php" method="POST"
                data-sending="<?= tr('Đang gửi...', 'Sending...') ?>"
                data-error="<?= tr('Có lỗi xảy ra, vui lòng thử lại.', 'Something went wrong, please try again.') ?>">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-bold"><?= tr('Họ và tên phụ huynh', 'Parent full name') ?></label>
                <input type="text" name="parent_name" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold"><?= tr('Số điện thoại', 'Phone number') ?></label>
                <input type="text" name="phone" class="form-control" required>
              </div>
              <div class="col-12">
                <label class="form-label fw-bold"><?= tr('Lời nhắn', 'Message') ?></label>
                <textarea name="message" rows="4" class="form-control" placeholder="<?= tr('Bạn muốn tư vấn về vấn đề gì?', 'What would you like to ask about?') ?>"></textarea>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary w-100"><?= tr('Gửi đăng ký', 'Submit') ?></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
