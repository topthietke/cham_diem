(function () {
  const searchInput = document.getElementById('searchInput');
  const difficultyFilter = document.getElementById('difficultyFilter');
  const resetBtn = document.getElementById('resetBtn');
  const pills = document.querySelectorAll('.category-pill');
  const questionList = document.getElementById('questionList');
  const loadingState = document.getElementById('loadingState');
  const emptyState = document.getElementById('emptyState');
  const resultCount = document.getElementById('resultCount');

  let state = { q: '', category: 'all', difficulty: 'all' };
  let debounceTimer = null;

  function escapeHtml(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
  }

  function badgeClass(diff) {
    if (diff === 'Dễ') return 'bg-success';
    if (diff === 'Khó') return 'bg-danger';
    return 'bg-warning text-dark';
  }

  function render(data) {
    resultCount.textContent = data.length;
    if (data.length === 0) {
      questionList.innerHTML = '';
      emptyState.style.display = 'block';
      return;
    }
    emptyState.style.display = 'none';

    let currentCategory = null;
    let html = '';
    data.forEach((item, idx) => {
      if (item.category !== currentCategory) {
        currentCategory = item.category;
        html += `<h5 class="mt-4 mb-3 text-secondary"><i class="bi bi-bookmark-star"></i> ${escapeHtml(currentCategory)}</h5>`;
      }
      const collapseId = 'q' + item.id;
      html += `
        <div class="card question-card">
          <div class="card-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#${collapseId}">
            <div><span class="q-index">#${item.id}</span>${escapeHtml(item.question)}</div>
            <span class="badge ${badgeClass(item.difficulty)}">${escapeHtml(item.difficulty)}</span>
          </div>
          <div id="${collapseId}" class="collapse">
            <div class="card-body">${escapeHtml(item.answer)}</div>
          </div>
        </div>`;
    });
    questionList.innerHTML = html;
  }

  function fetchData() {
    loadingState.style.display = 'block';
    questionList.innerHTML = '';
    emptyState.style.display = 'none';

    const params = new URLSearchParams({
      q: state.q,
      category: state.category,
      difficulty: state.difficulty
    });

    fetch('api/search.php?' + params.toString())
      .then(res => res.json())
      .then(json => {
        loadingState.style.display = 'none';
        if (json.success) render(json.data);
      })
      .catch(() => {
        loadingState.style.display = 'none';
        questionList.innerHTML = '<p class="text-danger text-center">Có lỗi khi tải dữ liệu.</p>';
      });
  }

  searchInput.addEventListener('input', () => {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
      state.q = searchInput.value.trim();
      fetchData();
    }, 300);
  });

  difficultyFilter.addEventListener('change', () => {
    state.difficulty = difficultyFilter.value;
    fetchData();
  });

  pills.forEach(pill => {
    pill.addEventListener('click', () => {
      pills.forEach(p => p.classList.remove('active'));
      pill.classList.add('active');
      state.category = pill.dataset.cat;
      fetchData();
    });
  });

  resetBtn.addEventListener('click', () => {
    state = { q: '', category: 'all', difficulty: 'all' };
    searchInput.value = '';
    difficultyFilter.value = 'all';
    pills.forEach(p => p.classList.remove('active'));
    pills[0].classList.add('active');
    fetchData();
  });

  fetchData();
})();
