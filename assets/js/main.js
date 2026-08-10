document.addEventListener('DOMContentLoaded', function () {
  /* ---- Reveal on scroll ---- */
  const revealEls = document.querySelectorAll('.reveal');
  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });
  revealEls.forEach(el => io.observe(el));

  /* ---- Animated counters for stats ---- */
  const counters = document.querySelectorAll('.stat-number[data-count]');
  const counterIO = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        counterIO.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });
  counters.forEach(c => counterIO.observe(c));

  function animateCounter(el) {
    const raw = el.getAttribute('data-count');
    const numMatch = raw.match(/\d+/);
    if (!numMatch) { el.textContent = raw; return; }
    const target = parseInt(numMatch[0], 10);
    const suffix = raw.replace(numMatch[0], '');
    let current = 0;
    const step = Math.max(1, Math.ceil(target / 40));
    const timer = setInterval(() => {
      current += step;
      if (current >= target) {
        current = target;
        clearInterval(timer);
      }
      el.textContent = current + suffix;
    }, 30);
  }

  /* ---- Navbar shrink + active link on scroll ---- */
  const navbar = document.querySelector('.navbar-mamnon');
  window.addEventListener('scroll', function () {
    if (window.scrollY > 40) {
      navbar.classList.add('shadow');
    }
    const backToTop = document.querySelector('.back-to-top');
    if (backToTop) {
      backToTop.classList.toggle('show', window.scrollY > 400);
    }
  });

  /* ---- Smooth scroll for in-page nav links ---- */
  document.querySelectorAll('a.nav-link[href^="#"]').forEach(link => {
    link.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');
      const target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        window.scrollTo({
          top: target.offsetTop - 80,
          behavior: 'smooth'
        });
        // collapse mobile navbar
        const navCollapse = document.querySelector('.navbar-collapse');
        if (navCollapse && navCollapse.classList.contains('show')) {
          bootstrap.Collapse.getInstance(navCollapse).hide();
        }
      }
    });
  });

  /* ---- Back to top click ---- */
  const backToTop = document.querySelector('.back-to-top');
  if (backToTop) {
    backToTop.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* ---- Contact form: simple client-side validation + AJAX submit ---- */
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
      e.preventDefault();
      const alertBox = document.getElementById('formAlert');
      const submitBtn = contactForm.querySelector('button[type="submit"]');
      const originalText = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.innerHTML = contactForm.dataset.sending || 'Đang gửi...';

      fetch(contactForm.action, {
        method: 'POST',
        body: new FormData(contactForm),
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
        .then(res => res.json())
        .then(data => {
          alertBox.classList.remove('d-none', 'alert-success', 'alert-danger');
          alertBox.classList.add(data.success ? 'alert-success' : 'alert-danger');
          alertBox.textContent = data.message;
          if (data.success) contactForm.reset();
        })
        .catch(() => {
          alertBox.classList.remove('d-none', 'alert-success');
          alertBox.classList.add('alert-danger');
          alertBox.textContent = contactForm.dataset.error || 'Có lỗi xảy ra, vui lòng thử lại.';
        })
        .finally(() => {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalText;
        });
    });
  }
});
