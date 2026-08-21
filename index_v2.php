<!doctype html>
<html lang="vi" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PHP Interview Bank — Ngân hàng câu hỏi phỏng vấn PHP/Laravel</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        :root {
            /* ---- token system: "code editor" palette ---- */
            --crust: #11111b;
            --mantle: #181825;
            --base: #1e1e2e;
            --surface0: #2a2b3d;
            --surface1: #3a3c52;
            --surface2: #4b4d68;
            --text: #cdd6f4;
            --subtext: #a6adc8;
            --muted: #7f849c;

            --mauve: #cba6f7;
            --red: #f38ba8;
            --peach: #fab387;
            --yellow: #f9e2af;
            --green: #a6e3a1;
            --blue: #89b4fa;
            --sky: #89dceb;
            --teal: #94e2d5;

            --font-mono: "JetBrains Mono", ui-monospace, SFMono-Regular, monospace;
            --font-sans: "Inter", ui-sans-serif, system-ui, sans-serif;

            --radius-lg: 16px;
            --radius-md: 10px;
            --radius-sm: 6px;
        }

        @media (prefers-reduced-motion: reduce) {
            * { animation-duration: .001ms !important; transition-duration: .001ms !important; }
        }

        html, body {
            background: var(--crust);
            color: var(--text);
            font-family: var(--font-sans);
            min-height: 100vh;
        }

        body { padding: clamp(0px, 3vw, 28px) 0; }

        ::selection { background: var(--mauve); color: var(--crust); }

        a { color: var(--sky); }

        /* focus visibility */
        a:focus-visible, button:focus-visible, input:focus-visible, select:focus-visible, [tabindex]:focus-visible {
            outline: 2px solid var(--mauve);
            outline-offset: 2px;
        }

        /* ---------------- IDE shell ---------------- */
        .ide-shell {
            max-width: 1200px;
            margin: 0 auto;
            background: var(--base);
            border: 1px solid var(--surface0);
            border-radius: var(--radius-lg);
            box-shadow: 0 30px 80px -20px rgba(0,0,0,.65), 0 0 0 1px rgba(255,255,255,.02) inset;
            overflow: hidden;
        }

        .titlebar {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 18px;
            background: var(--mantle);
            border-bottom: 1px solid var(--surface0);
        }

        .tl-dots { display: flex; gap: 7px; flex-shrink: 0; }
        .tl-dots span { width: 11px; height: 11px; border-radius: 50%; display: inline-block; }
        .tl-dots span:nth-child(1) { background: var(--red); }
        .tl-dots span:nth-child(2) { background: var(--yellow); }
        .tl-dots span:nth-child(3) { background: var(--green); }

        .tl-tab {
            font-family: var(--font-mono);
            font-size: .74rem;
            color: var(--text);
            background: var(--surface0);
            border: 1px solid var(--surface1);
            padding: 5px 12px;
            border-radius: 7px 7px 0 0;
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .tl-tab .dot { width: 6px; height: 6px; border-radius: 50%; background: var(--peach); }

        .tl-meta {
            margin-left: auto;
            font-family: var(--font-mono);
            font-size: .72rem;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .tl-meta .live { color: var(--green); }
        .tl-meta .live::before {
            content: ""; display: inline-block; width: 6px; height: 6px; border-radius: 50%;
            background: var(--green); margin-right: 6px; box-shadow: 0 0 0 3px rgba(166,227,161,.18);
        }

        /* ---------------- header ---------------- */
        .app-header { padding: 30px clamp(16px, 4vw, 34px) 6px; }
        .brand-kicker {
            font-family: var(--font-mono);
            font-size: .72rem;
            letter-spacing: .12em;
            color: var(--mauve);
            text-transform: uppercase;
            display: flex; align-items: center; gap: 8px;
        }
        .brand-kicker::before { content: ">"; color: var(--green); font-weight: 700; }
        .brand-title {
            font-family: var(--font-mono);
            font-weight: 700;
            font-size: clamp(1.5rem, 3vw, 2.05rem);
            letter-spacing: -0.02em;
            margin: 6px 0 4px;
            color: #fff;
        }
        .brand-title .blink {
            display: inline-block; width: 2px; height: .95em; background: var(--green);
            margin-left: 4px; vertical-align: -2px; animation: blink 1.1s step-end infinite;
        }
        @keyframes blink { 50% { opacity: 0; } }
        .brand-sub { color: var(--subtext); font-size: .93rem; max-width: 640px; }

        /* ---------------- nav tabs ---------------- */
        .nav-editor {
            padding: 0 clamp(16px, 4vw, 34px);
            margin-top: 18px;
            border-bottom: 1px solid var(--surface0);
            gap: 4px;
        }
        .nav-editor .nav-link {
            font-family: var(--font-mono);
            font-size: .82rem;
            color: var(--muted);
            border: 1px solid transparent;
            border-bottom: none;
            border-radius: 9px 9px 0 0;
            padding: 10px 16px;
            display: flex; align-items: center; gap: 8px;
        }
        .nav-editor .nav-link:hover { color: var(--text); background: rgba(255,255,255,.03); }
        .nav-editor .nav-link.active {
            color: var(--text);
            background: var(--mantle);
            border-color: var(--surface0);
        }
        .nav-editor .nav-link .badge-count {
            font-size: .68rem; background: var(--surface1); color: var(--subtext);
            border-radius: 20px; padding: 1px 7px;
        }

        .tab-body { padding: 22px clamp(16px, 4vw, 34px) 8px; }

        /* ---------------- toolbar ---------------- */
        .toolbar {
            display: flex; flex-wrap: wrap; gap: 10px; align-items: center;
            margin-bottom: 18px;
        }
        .search-wrap {
            position: relative; flex: 1 1 260px; min-width: 220px;
        }
        .search-wrap .prompt {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: var(--green); font-family: var(--font-mono); font-weight: 700; pointer-events: none;
        }
        .search-wrap input.form-control {
            background: var(--surface0); border: 1px solid var(--surface1); color: var(--text);
            font-family: var(--font-mono); font-size: .88rem;
            padding-left: 34px; border-radius: var(--radius-md);
        }
        .search-wrap input.form-control::placeholder { color: var(--muted); }
        .search-wrap input.form-control:focus {
            background: var(--surface0); border-color: var(--mauve); color: var(--text);
            box-shadow: 0 0 0 3px rgba(203,166,247,.15);
        }

        .form-select.filter-select {
            background-color: var(--surface0); border: 1px solid var(--surface1); color: var(--text);
            font-size: .84rem; border-radius: var(--radius-md); width: auto;
        }
        .form-select.filter-select:focus {
            border-color: var(--mauve); box-shadow: 0 0 0 3px rgba(203,166,247,.15);
        }

        .btn-reset-filter {
            background: transparent; border: 1px solid var(--surface1); color: var(--subtext);
            border-radius: var(--radius-md); font-size: .84rem;
        }
        .btn-reset-filter:hover { border-color: var(--red); color: var(--red); }

        .result-count { font-family: var(--font-mono); font-size: .78rem; color: var(--muted); white-space: nowrap; }
        .result-count b { color: var(--text); }

        /* ---------------- table ---------------- */
        .qbank-table { border-collapse: separate; border-spacing: 0; width: 100%; }
        .qbank-table thead th {
            font-family: var(--font-mono);
            font-size: .68rem; letter-spacing: .08em; text-transform: uppercase;
            color: var(--muted); border-bottom: 1px solid var(--surface0);
            padding: 10px 14px; background: transparent; font-weight: 600;
        }
        .qbank-table tbody tr { border-bottom: 1px solid var(--surface0); transition: background .12s ease; }
        .qbank-table tbody tr:hover { background: rgba(255,255,255,.025); }
        .qbank-table tbody td { padding: 14px; vertical-align: top; border: none; }

        .row-accent { width: 4px; padding: 0 !important; }
        .row-accent > span { display: block; width: 4px; height: 100%; min-height: 46px; border-radius: 3px; }

        .id-chip {
            font-family: var(--font-mono); font-size: .72rem; font-weight: 600;
            background: var(--crust); border: 1px solid var(--surface1); color: var(--text);
            padding: 4px 9px; border-radius: 7px; white-space: nowrap; display: inline-block;
        }

        .q-text { font-size: .93rem; color: var(--text); line-height: 1.45; margin-bottom: 6px; }
        .tag-pill {
            font-family: var(--font-mono); font-size: .68rem; color: var(--subtext);
            background: var(--surface0); border: 1px solid var(--surface1);
            padding: 2px 8px; border-radius: 20px; display: inline-block;
        }
        .type-pill {
            font-size: .68rem; font-weight: 600; padding: 2px 9px; border-radius: 20px;
            border: 1px solid; display: inline-flex; align-items: center; gap: 4px;
        }

        .cat-pill { display: inline-flex; align-items: center; gap: 7px; font-size: .82rem; font-weight: 500; white-space: nowrap; }
        .cat-pill i { font-size: .95rem; }

        .diff-pill {
            font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .03em;
            padding: 4px 11px; border-radius: 20px; white-space: nowrap; border: 1px solid;
        }

        .btn-view {
            width: 34px; height: 34px; border-radius: 9px; border: 1px solid var(--surface1);
            background: var(--surface0); color: var(--subtext);
            display: inline-flex; align-items: center; justify-content: center;
        }
        .btn-view:hover { background: var(--mauve); border-color: var(--mauve); color: var(--crust); }

        /* mobile cards */
        .q-card {
            background: var(--surface0); border: 1px solid var(--surface1); border-radius: var(--radius-md);
            padding: 14px; margin-bottom: 12px; position: relative; overflow: hidden;
        }
        .q-card::before { content: ""; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; }

        /* pagination */
        .pagination .page-link {
            background: var(--surface0); border-color: var(--surface1); color: var(--subtext);
            font-family: var(--font-mono); font-size: .82rem;
        }
        .pagination .page-item.active .page-link { background: var(--mauve); border-color: var(--mauve); color: var(--crust); font-weight: 700; }
        .pagination .page-link:hover { background: var(--surface1); color: var(--text); }
        .pagination .page-item.disabled .page-link { background: transparent; color: var(--muted); }

        /* offcanvas detail */
        .offcanvas {
            background: var(--mantle); color: var(--text); border-left: 1px solid var(--surface0);
            width: min(560px, 100vw) !important;
        }
        .offcanvas-header { border-bottom: 1px solid var(--surface0); }
        .btn-close { filter: invert(1) grayscale(1); opacity: .7; }

        .opt-row {
            display: flex; gap: 12px; align-items: flex-start; padding: 11px 13px;
            border: 1px solid var(--surface1); border-radius: var(--radius-md); margin-bottom: 8px;
            background: var(--surface0);
        }
        .opt-row.is-correct { border-color: var(--green); background: rgba(166,227,161,.08); }
        .opt-letter {
            width: 26px; height: 26px; border-radius: 50%; background: var(--surface1); color: var(--text);
            font-family: var(--font-mono); font-weight: 700; font-size: .76rem;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .opt-row.is-correct .opt-letter { background: var(--green); color: var(--crust); }
        .opt-text { font-size: .87rem; line-height: 1.45; }

        .callout { border-radius: var(--radius-md); padding: 14px; border: 1px solid; }
        .callout-explain { background: rgba(166,227,161,.07); border-color: rgba(166,227,161,.35); }
        .callout-scenario { background: rgba(250,179,135,.07); border-color: rgba(250,179,135,.35); }
        .callout-title {
            font-family: var(--font-mono); font-size: .68rem; letter-spacing: .08em; text-transform: uppercase;
            font-weight: 700; margin-bottom: 7px; display: flex; align-items: center; gap: 6px;
        }
        .callout-body { font-size: .85rem; line-height: 1.55; color: var(--subtext); }

        /* quiz */
        .quiz-card {
            background: var(--mantle); border: 1px solid var(--surface0); border-radius: var(--radius-lg);
            padding: clamp(16px, 3vw, 28px);
        }
        .progress { background: var(--surface0); height: 8px; border-radius: 20px; }
        .progress-bar { background: var(--mauve); }

        .quiz-opt {
            width: 100%; text-align: left; display: flex; align-items: center; gap: 12px;
            padding: 13px 14px; border-radius: var(--radius-md); border: 1px solid var(--surface1);
            background: var(--surface0); color: var(--text); margin-bottom: 10px; transition: .12s ease;
        }
        .quiz-opt:hover { border-color: var(--mauve); }
        .quiz-opt.selected { border-color: var(--mauve); background: rgba(203,166,247,.1); }
        .quiz-opt.correct-answer { border-color: var(--green); background: rgba(166,227,161,.1); }
        .quiz-opt.wrong-answer { border-color: var(--red); background: rgba(243,139,168,.1); }
        .quiz-opt .opt-letter { background: var(--surface1); }
        .quiz-opt.selected .opt-letter { background: var(--mauve); color: var(--crust); }
        .quiz-opt.correct-answer .opt-letter { background: var(--green); color: var(--crust); }
        .quiz-opt.wrong-answer .opt-letter { background: var(--red); color: var(--crust); }

        .score-ring {
            width: 128px; height: 128px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; flex-direction: column;
            border: 6px solid var(--surface1); margin: 0 auto;
        }
        .score-ring .num { font-family: var(--font-mono); font-size: 1.7rem; font-weight: 700; }
        .score-ring .lbl { font-size: .68rem; color: var(--muted); text-transform: uppercase; letter-spacing: .05em; }

        .empty-state { text-align: center; padding: 60px 20px; color: var(--muted); }
        .empty-state i { font-size: 2.4rem; color: var(--surface2); margin-bottom: 14px; display: block; }

        .attempt-card {
            background: var(--surface0); border: 1px solid var(--surface1); border-radius: var(--radius-md);
            padding: 16px; margin-bottom: 12px; display: flex; align-items: center; gap: 16px; flex-wrap: wrap;
        }

        .btn-primary-app {
            background: var(--mauve); border-color: var(--mauve); color: var(--crust); font-weight: 600;
        }
        .btn-primary-app:hover { background: #b998f0; border-color: #b998f0; color: var(--crust); }

        .btn-outline-app {
            background: transparent; border: 1px solid var(--surface1); color: var(--text);
        }
        .btn-outline-app:hover { border-color: var(--mauve); color: var(--mauve); }

        /* status bar */
        .statusbar {
            background: var(--mantle); border-top: 1px solid var(--surface0);
            padding: 9px 18px; display: flex; justify-content: space-between; align-items: center;
            font-family: var(--font-mono); font-size: .7rem; color: var(--muted); flex-wrap: wrap; gap: 6px;
        }
        .statusbar .ok::before {
            content: ""; display: inline-block; width: 6px; height: 6px; border-radius: 50%;
            background: var(--green); margin-right: 6px;
        }

        @media (max-width: 767px) {
            body { padding: 0; }
            .ide-shell { border-radius: 0; border-left: none; border-right: none; }
        }
    </style>
</head>

<body>
    <div class="ide-shell">
        <!-- title bar (mac-style window chrome) -->
        <div class="titlebar">
            <div class="tl-dots"><span></span><span></span><span></span></div>
            <div class="tl-tab"><i class="bi bi-filetype-php"></i>question-bank.php<span class="dot"></span></div>
            <div class="tl-meta">
                <span class="d-none d-sm-inline"><i class="bi bi-file-earmark-text"></i> <span id="tlCount">24</span> câu hỏi</span>
                <span class="live d-none d-md-inline">UTF-8</span>
            </div>
        </div>

        <!-- header -->
        <div class="app-header">
            <div class="brand-kicker">interview_prep / php · laravel</div>
            <h1 class="brand-title">PHP Interview Bank<span class="blink"></span></h1>
            <p class="brand-sub">Ngân hàng câu hỏi phỏng vấn kỹ thuật PHP &amp; Laravel — tra cứu, lọc theo cấp độ, và thi thử để tự đánh giá năng lực.</p>
        </div>

        <!-- tabs -->
        <ul class="nav nav-editor" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-bank" type="button" role="tab">
                    <i class="bi bi-collection"></i> Ngân hàng câu hỏi <span class="badge-count" id="navCountBank">24</span>
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-quiz" type="button" role="tab">
                    <i class="bi bi-lightning-charge"></i> Thi thử
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-results" type="button" role="tab">
                    <i class="bi bi-bar-chart-line"></i> Kết quả <span class="badge-count" id="navCountResults">0</span>
                </button>
            </li>
        </ul>

        <div class="tab-content">

            <!-- ===================== TAB 1: QUESTION BANK ===================== -->
            <div class="tab-pane fade show active" id="tab-bank" role="tabpanel">
                <div class="tab-body">
                    <div class="toolbar">
                        <div class="search-wrap">
                            <span class="prompt">$</span>
                            <input type="text" class="form-control" id="searchInput"
                                   placeholder="grep -i &quot;N+1 query&quot; ...tìm ID, nội dung, tag" aria-label="Tìm kiếm câu hỏi">
                        </div>
                        <select class="form-select filter-select" id="filterCategory" aria-label="Lọc theo danh mục">
                            <option value="All">Tất cả danh mục</option>
                        </select>
                        <select class="form-select filter-select" id="filterDifficulty" aria-label="Lọc theo độ khó">
                            <option value="All">Tất cả cấp độ</option>
                        </select>
                        <select class="form-select filter-select" id="filterType" aria-label="Lọc theo loại câu hỏi">
                            <option value="All">Tất cả loại</option>
                        </select>
                        <button class="btn btn-reset-filter" id="btnResetFilter">
                            <i class="bi bi-x-circle"></i> Xóa lọc
                        </button>
                        <span class="result-count ms-auto" id="resultCount"></span>
                    </div>

                    <!-- desktop table -->
                    <div class="table-responsive d-none d-md-block">
                        <table class="qbank-table">
                            <thead>
                                <tr>
                                    <th style="width:4px;padding:0"></th>
                                    <th style="width:90px">ID</th>
                                    <th>Câu hỏi</th>
                                    <th style="width:190px">Danh mục</th>
                                    <th style="width:110px">Độ khó</th>
                                    <th style="width:70px" class="text-end">Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody"></tbody>
                        </table>
                    </div>

                    <!-- mobile cards -->
                    <div class="d-md-none" id="cardBody"></div>

                    <div id="emptyBank" class="empty-state d-none">
                        <i class="bi bi-inboxes"></i>
                        Không tìm thấy câu hỏi phù hợp với bộ lọc hiện tại.
                    </div>

                    <nav class="mt-3" id="paginationWrap">
                        <ul class="pagination pagination-sm justify-content-center" id="pagination"></ul>
                    </nav>
                </div>
            </div>

            <!-- ===================== TAB 2: QUIZ ===================== -->
            <div class="tab-pane fade" id="tab-quiz" role="tabpanel">
                <div class="tab-body">

                    <!-- setup -->
                    <div id="quizSetup" class="quiz-card mx-auto" style="max-width:560px;">
                        <div class="text-center mb-4">
                            <i class="bi bi-lightning-charge" style="font-size:2rem;color:var(--mauve);"></i>
                            <h5 class="mt-2 mb-1" style="font-family:var(--font-mono);">Bắt đầu bài thi thử</h5>
                            <p class="text-secondary small mb-0" style="color:var(--subtext) !important;">Chọn số câu và danh mục, hệ thống sẽ random câu hỏi từ ngân hàng.</p>
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small" style="color:var(--subtext)">Số câu hỏi</label>
                                <select class="form-select filter-select w-100" id="quizCount">
                                    <option value="5">5 câu</option>
                                    <option value="10" selected>10 câu</option>
                                    <option value="15">15 câu</option>
                                    <option value="20">20 câu</option>
                                    <option value="24">Tất cả (24)</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label small" style="color:var(--subtext)">Danh mục</label>
                                <select class="form-select filter-select w-100" id="quizCategory">
                                    <option value="All">Tất cả danh mục</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-primary-app w-100 mt-4 py-2" id="btnStartQuiz">
                            <i class="bi bi-play-fill"></i> Bắt đầu thi thử
                        </button>
                    </div>

                    <!-- active quiz -->
                    <div id="quizActive" class="d-none">
                        <div class="d-flex justify-content-between align-items-center mb-2" style="font-family:var(--font-mono);font-size:.8rem;color:var(--subtext);">
                            <span id="quizProgressLabel">Câu 1/10</span>
                            <span><i class="bi bi-stopwatch"></i> <span id="quizTimer">00:00</span></span>
                        </div>
                        <div class="progress mb-4"><div class="progress-bar" id="quizProgressBar" style="width:10%"></div></div>

                        <div class="quiz-card">
                            <div class="d-flex flex-wrap gap-2 mb-3" id="quizQMeta"></div>
                            <h5 class="mb-4" id="quizQText" style="line-height:1.5;"></h5>
                            <div id="quizOptions"></div>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <button class="btn btn-outline-app" id="btnQuizPrev"><i class="bi bi-arrow-left"></i> Trước</button>
                            <button class="btn btn-primary-app" id="btnQuizNext">Tiếp theo <i class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- result -->
                    <div id="quizResult" class="d-none">
                        <div class="quiz-card text-center mx-auto" style="max-width:460px;">
                            <div class="score-ring" id="scoreRing">
                                <span class="num" id="scoreNum">0/0</span>
                                <span class="lbl">điểm</span>
                            </div>
                            <h5 class="mt-3 mb-1" id="scoreVerdict" style="font-family:var(--font-mono);"></h5>
                            <p class="small" style="color:var(--subtext)" id="scoreTime"></p>
                            <div class="d-flex gap-2 justify-content-center mt-3">
                                <button class="btn btn-outline-app" id="btnToggleReview"><i class="bi bi-eye"></i> Xem lại đáp án</button>
                                <button class="btn btn-primary-app" id="btnRetryQuiz"><i class="bi bi-arrow-repeat"></i> Làm bài mới</button>
                            </div>
                        </div>
                        <div id="quizReviewList" class="mt-4 d-none"></div>
                    </div>

                </div>
            </div>

            <!-- ===================== TAB 3: RESULTS ===================== -->
            <div class="tab-pane fade" id="tab-results" role="tabpanel">
                <div class="tab-body">
                    <div id="resultsEmpty" class="empty-state">
                        <i class="bi bi-bar-chart-line"></i>
                        Chưa có lịch sử thi thử trong phiên này.<br>
                        <button class="btn btn-primary-app mt-3" id="btnGotoQuiz"><i class="bi bi-lightning-charge"></i> Bắt đầu thi thử</button>
                    </div>
                    <div id="resultsList" class="d-none"></div>
                </div>
            </div>

        </div>

        <!-- status bar -->
        <div class="statusbar">
            <span class="ok">Sẵn sàng · <span id="sbCount">24</span> câu hỏi trong ngân hàng</span>
            <span>Bootstrap 5.3 · Vanilla JS · UTF-8</span>
        </div>
    </div>

    <!-- ===================== OFFCANVAS: DETAIL ===================== -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="detailOffcanvas">
        <div class="offcanvas-header">
            <div>
                <span class="id-chip" id="dcId"></span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Đóng"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex flex-wrap gap-2 mb-3" id="dcMeta"></div>
            <h5 class="mb-4" id="dcQuestion" style="line-height:1.5;"></h5>

            <div class="mb-3" id="dcOptions"></div>

            <div class="d-flex flex-column gap-3 mb-3">
                <div class="callout callout-explain">
                    <div class="callout-title" style="color:var(--green)"><i class="bi bi-lightbulb"></i> Giải thích chi tiết</div>
                    <div class="callout-body" id="dcExplain"></div>
                </div>
                <div class="callout callout-scenario d-none" id="dcScenarioWrap">
                    <div class="callout-title" style="color:var(--peach)"><i class="bi bi-signpost-split"></i> Tình huống thực tế</div>
                    <div class="callout-body" id="dcScenario"></div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2" id="dcTags"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        /* ================= DATA ================= */
        const QUESTIONS = [{"id":"PHP-001","question":"Trong PHP 8.1, tính năng nào giúp định nghĩa tập hợp các giá trị hằng số có kiểu rõ ràng?","category":"PHP Core","difficulty":"Middle","type":"Trắc nghiệm","tags":["PHP 8.1","Enum","Type System"],"options":[{"label":"A","text":"Readonly Properties"},{"label":"B","text":"Enums - backed & pure enums"},{"label":"C","text":"Fibers"},{"label":"D","text":"Intersection Types"}],"correct":"B","explanation":"PHP 8.1 giới thiệu Enums cho phép định nghĩa tập hợp các giá trị cố định có type-safe. Ví dụ: enum Status: string { case Pending = \"pending\"; }. Readonly properties cũng là 8.1 nhưng không liên quan đến tập hợp hằng số.","scenario":"Khi xây dựng hệ thống quản lý đơn hàng, thay vì dùng hằng string rời rạc, dùng Enum để tránh lỗi typo và được IDE hỗ trợ autocomplete."},{"id":"PHP-002","question":"Sự khác biệt chính giữa match expression và switch trong PHP 8?","category":"PHP Core","difficulty":"Junior","type":"Trắc nghiệm","tags":["PHP 8","Match","Control Structure"],"options":[{"label":"A","text":"match dùng loose comparison (==)"},{"label":"B","text":"match yêu cầu break, switch thì không"},{"label":"C","text":"match dùng strict comparison (===) và return value"},{"label":"D","text":"Không có khác biệt"}],"correct":"C","explanation":"match là expression trả về giá trị, so sánh strict (===), không cần break và sẽ throw UnhandledMatchError nếu không match case nào và không có default.","codeSnippet":"$status = match($code) {\n  200, 201 => 'success',\n  404 => 'not found',\n  default => 'error',\n};"},{"id":"LAR-003","question":"Trong Laravel, làm thế nào để khắc phục lỗi N+1 query khi load danh sách 100 posts cùng author?","category":"Laravel","difficulty":"Middle","type":"Tình huống","tags":["Eloquent","N+1","Performance"],"options":[{"label":"A","text":"Dùng DB::raw() thay cho Eloquent"},{"label":"B","text":"Dùng with(\"author\") - eager loading"},{"label":"C","text":"Tăng mysql max_connections"},{"label":"D","text":"Dùng cache cho mỗi query"}],"correct":"B","explanation":"N+1 xảy ra khi 1 query lấy posts + N query lấy author. with(\"author\") sẽ gộp thành 2 queries. Ngoài ra có thể dùng lazy eager loading, hoặc withCount nếu chỉ cần đếm.","scenario":"Production log cho thấy 1 request /api/posts tốn 101 queries (1 + 100). Sau khi thêm ->with(\"author\") giảm còn 2 queries, response time từ 1.2s xuống 120ms. Cần kiểm tra bằng Laravel Debugbar hoặc Telescope.","codeSnippet":"// Before: 101 queries\n$posts = Post::all();\nforeach($posts as $post) $post->author->name;\n\n// After: 2 queries\n$posts = Post::with('author')->get();"},{"id":"LAR-004","question":"Khi Laravel Queue job bị failed liên tục, cách xử lý đúng là gì?","category":"Laravel","difficulty":"Senior","type":"Tình huống","tags":["Queue","Failed Jobs","Horizon"],"options":[{"label":"A","text":"Xóa job khỏi failed_jobs table và bỏ qua"},{"label":"B","text":"Implement failed() method, log context, cấu hình retry + backoff, dùng horizon supervision"},{"label":"C","text":"Chạy queue:work với --tries=999"},{"label":"D","text":"Chuyển sang sync driver"}],"correct":"B","explanation":"Best practice: 1) failed() method để notify Slack, 2) cấu hình $tries, $backoff, $maxExceptions, 3) dùng Horizon để giám sát, 4) queue:retry hoặc retryUntil(), 5) phân tích nguyên nhân root cause trước khi retry.","scenario":"Job gửi email invoice fail do SMTP timeout. Giải pháp: backoff 30s, 60s, 120s, log request_id, alert vào Slack channel #ops nếu fail 3 lần liên tiếp."},{"id":"SYS-005","question":"Hiện tượng Cache Stampede trong Redis là gì và cách phòng tránh?","category":"System Admin & Security","difficulty":"Senior","type":"Tình huống","tags":["Redis","Cache","Stampede","Lock"],"options":[{"label":"A","text":"Cache bị đầy, giải pháp là tăng memory"},{"label":"B","text":"Nhiều request đồng thời miss cache và cùng query DB - dùng mutex lock, early recompute, probabilistic early expiration"},{"label":"C","text":"Redis crash, dùng persistence AOF"},{"label":"D","text":"Key bị xóa nhầm, bật keyspace notification"}],"correct":"B","explanation":"Stampede xảy ra khi key hết hạn, hàng nghìn request cùng lúc query DB gây sập DB. Giải pháp: 1) Lock (Cache::lock), 2) Randomize TTL, 3) Stale-while-revalidate pattern, 4) Background refresh.","scenario":"Flash sale 12h đêm, cache product_list hết hạn, 50k users F5 đồng thời -> DB CPU 100%. Fix: Cache::remember với lock 10s, chỉ 1 request được phép rebuild cache.","codeSnippet":"Cache::lock('products:lock', 10)->get(function() {\n  Cache::put('products', Product::all(), 3600);\n});"},{"id":"SEC-006","question":"Đoạn code nào dễ bị SQL Injection?","category":"System Admin & Security","difficulty":"Junior","type":"Code","tags":["SQL Injection","Security","PDO"],"options":[{"label":"A","text":"DB::table(\"users\")->where(\"id\", $id)->first()"},{"label":"B","text":"$pdo->prepare(\"SELECT * FROM users WHERE id = ?\")->execute([$id])"},{"label":"C","text":"\"SELECT * FROM users WHERE name = '\" . $_GET[\"name\"] . \"'\""},{"label":"D","text":"User::whereId($id)->first()"}],"correct":"C","explanation":"Nối chuỗi trực tiếp từ $_GET vào query là lỗ hổng SQL Injection nghiêm trọng. Phải dùng prepared statement, Eloquent ORM hoặc Query Builder với binding.","scenario":"Hacker nhập name = ' OR 1=1 --  => lộ toàn bộ users. Audit toàn bộ codebase tìm raw query, bật Eloquent strict mode."},{"id":"SEC-007","question":"Cách phòng chống XSS khi render dữ liệu user nhập vào Blade?","category":"System Admin & Security","difficulty":"Middle","type":"Code","tags":["XSS","Blade","Security"],"options":[{"label":"A","text":"Dùng {!! $userInput !!} luôn luôn"},{"label":"B","text":"Dùng {{ $userInput }} - Blade tự escape, chỉ dùng {!! !!} khi đã purify HTML"},{"label":"C","text":"Dùng strip_tags() trong controller"},{"label":"D","text":"Tắt CSRF protection"}],"correct":"B","explanation":"{{ }} escape HTML entities tự động. {!! !!} render raw HTML - chỉ dùng khi đã qua HTML Purifier hoặc tin tưởng nguồn. Kết hợp với CSP header và validate input."},{"id":"SYS-008","question":"Production gặp lỗi Nginx 502 Bad Gateway với PHP-FPM, thứ tự kiểm tra?","category":"System Admin & Security","difficulty":"Middle","type":"Tình huống","tags":["Nginx","PHP-FPM","502","Ops"],"options":[{"label":"A","text":"Restart server ngay lập tức"},{"label":"B","text":"Check php-fpm status, socket permission, pm.max_children, slow log, nginx error log"},{"label":"C","text":"Tăng nginx worker_connections"},{"label":"D","text":"Xóa cache opcache"}],"correct":"B","explanation":"Quy trình: 1) systemctl status php8.1-fpm, 2) tail -f /var/log/php-fpm/error.log, 3) kiểm tra socket /run/php/php-fpm.sock quyền, 4) pm.max_children đầy -> tăng hoặc optimize, 5) kiểm tra slow log tìm query chậm.","scenario":"Sáng T2 traffic tăng đột biến, pm.max_children=20 đầy -> 502. Tạm thời tăng lên 50, sau đó phân tích slow log thấy 1 query thiếu index."},{"id":"SYS-009","question":"Docker container Laravel không kết nối được MySQL container, nguyên nhân phổ biến?","category":"System Admin & Security","difficulty":"Middle","type":"Tình huống","tags":["Docker","Networking","Compose"],"options":[{"label":"A","text":"Dùng DB_HOST=127.0.0.1 trong Laravel container"},{"label":"B","text":"Thiếu extension pdo_mysql"},{"label":"C","text":"Cả A và B, nên dùng service name làm host"},{"label":"D","text":"Docker không hỗ trợ MySQL"}],"correct":"C","explanation":"Trong Docker network, mỗi container có IP riêng. 127.0.0.1 trong app container là chính nó, không phải mysql. Phải dùng DB_HOST=mysql (service name) và đảm bảo cùng network, wait-for-it script.","codeSnippet":"# docker-compose.yml\nservices:\n  app:\n    depends_on: [mysql]\n  mysql:\n    image: mysql:8.0"},{"id":"PHP-010","question":"Composer: sự khác biệt giữa composer install và composer update?","category":"PHP Core","difficulty":"Junior","type":"Trắc nghiệm","tags":["Composer","Dependency"],"options":[{"label":"A","text":"Giống nhau hoàn toàn"},{"label":"B","text":"install đọc composer.lock, update đọc composer.json và cập nhật lock file"},{"label":"C","text":"install nhanh hơn vì không cần internet"},{"label":"D","text":"update chỉ dùng cho dev"}],"correct":"B","explanation":"Production luôn dùng composer install --no-dev để đảm bảo version giống hệt lock file. composer update sẽ nâng cấp package theo ràng buộc trong composer.json và ghi lại lock file mới."},{"id":"OOP-011","question":"Nguyên tắc Dependency Inversion (DIP) trong SOLID nói về?","category":"OOP/Performance","difficulty":"Middle","type":"Trắc nghiệm","tags":["SOLID","DIP","OOP"],"options":[{"label":"A","text":"Class con phải thay thế được class cha"},{"label":"B","text":"High-level module không phụ thuộc low-level module, cả hai phụ thuộc abstraction"},{"label":"C","text":"Một class chỉ nên có một lý do để thay đổi"},{"label":"D","text":"Ưu tiên composition over inheritance"}],"correct":"B","explanation":"DIP là nền tảng của Laravel Service Container. Thay vì new MailService() trực tiếp, inject qua interface MailerInterface, giúp dễ test và đổi implementation.","codeSnippet":"// Tốt: phụ thuộc abstraction\npublic function __construct(MailerInterface $mailer) {}\n// Xấu: phụ thuộc concretion\npublic function __construct(SmtpMailer $mailer) {}"},{"id":"DB-012","question":"MySQL deadlock xảy ra khi nào và cách xử lý trong Laravel?","category":"MySQL/Database","difficulty":"Senior","type":"Tình huống","tags":["MySQL","Deadlock","Transaction"],"options":[{"label":"A","text":"Khi 2 transaction khóa chéo nhau - dùng retry, sắp xếp thứ tự lock, giảm isolation level nếu cần"},{"label":"B","text":"Khi table quá lớn"},{"label":"C","text":"Khi thiếu index"},{"label":"D","text":"Không thể xảy ra với InnoDB"}],"correct":"A","explanation":"Deadlock: T1 lock row A chờ row B, T2 lock row B chờ row A. InnoDB tự detect và rollback 1 transaction. Trong Laravel: DB::transaction với retry 3 lần, hoặc đảm bảo lock theo cùng thứ tự id ASC.","scenario":"Job xử lý order đồng thời update stock: order id 1 và 2 cùng chạy, deadlock. Fix: SELECT ... FOR UPDATE ORDER BY id và retry logic."},{"id":"DB-013","question":"Để tối ưu query SELECT * FROM orders WHERE user_id=5 AND status=\"paid\" ORDER BY created_at DESC, index tốt nhất là?","category":"MySQL/Database","difficulty":"Middle","type":"Code","tags":["Index","MySQL","Performance"],"options":[{"label":"A","text":"INDEX(user_id)"},{"label":"B","text":"INDEX(status)"},{"label":"C","text":"INDEX(user_id, status, created_at DESC) - composite index theo thứ tự filter + sort"},{"label":"D","text":"INDEX(created_at)"}],"correct":"C","explanation":"Composite index tuân thủ leftmost prefix: user_id (equality), status (equality), created_at (sort). Dùng EXPLAIN để verify Extra không có Using filesort.","codeSnippet":"ALTER TABLE orders ADD INDEX idx_user_status_created \n(user_id, status, created_at DESC);"},{"id":"PHP-014","question":"PHP-FPM pm = dynamic vs ondemand vs static, khi nào dùng?","category":"OOP/Performance","difficulty":"Senior","type":"Tình huống","tags":["PHP-FPM","Performance","Tuning"],"options":[{"label":"A","text":"Luôn dùng static cho mọi case"},{"label":"B","text":"dynamic cho traffic biến động, static cho traffic ổn định cao, ondemand cho low traffic/dev tiết kiệm RAM"},{"label":"C","text":"ondemand là nhanh nhất"},{"label":"D","text":"Không quan trọng"}],"correct":"B","explanation":"static: giữ sẵn pm.max_children process (tốt cho high traffic, giảm overhead). dynamic: linh hoạt min/max_spare_servers. ondemand: tạo process khi có request, tiết kiệm RAM nhưng latency cao hơn."},{"id":"LAR-015","question":"Laravel Service Container binding singleton khác gì bind thường?","category":"Laravel","difficulty":"Middle","type":"Trắc nghiệm","tags":["Service Container","Singleton","DI"],"options":[{"label":"A","text":"singleton tạo 1 instance duy nhất cho cả lifecycle, bind tạo mới mỗi lần resolve"},{"label":"B","text":"singleton chỉ dùng cho config"},{"label":"C","text":"bind nhanh hơn singleton"},{"label":"D","text":"Không có khác biệt"}],"correct":"A","explanation":"singleton dùng cho service stateless, nặng khởi tạo (vd: Redis client). bind dùng cho service có state riêng mỗi lần dùng. Ngoài ra có scoped cho request lifecycle."},{"id":"SEC-016","question":"So sánh JWT vs Session cho API authentication, khi nào dùng JWT?","category":"System Admin & Security","difficulty":"Middle","type":"Trắc nghiệm","tags":["JWT","Session","Auth","Security"],"options":[{"label":"A","text":"JWT luôn tốt hơn Session"},{"label":"B","text":"JWT stateless, phù hợp microservices/mobile, nhưng khó revoke, nên dùng short-lived + refresh token"},{"label":"C","text":"Session không dùng được cho API"},{"label":"D","text":"JWT lưu trong localStorage là an toàn nhất"}],"correct":"B","explanation":"JWT pros: stateless, scale tốt. Cons: không revoke ngay được, payload lớn. Best practice: access token 15 phút, refresh token httpOnly cookie, blacklist khi logout bằng Redis."},{"id":"DB-017","question":"Giải thích hiện tượng Git conflict khi merge và cách resolve an toàn?","category":"PHP Core","difficulty":"Junior","type":"Tình huống","tags":["Git","Conflict","Workflow"],"options":[{"label":"A","text":"Xóa file bị conflict và commit lại"},{"label":"B","text":"Mở file, tìm <<<<<<<, chọn code đúng, test lại, git add và commit"},{"label":"C","text":"Dùng git reset --hard để bỏ conflict"},{"label":"D","text":"Không thể resolve conflict"}],"correct":"B","explanation":"Quy trình: git status xem file conflict, mở editor, quyết định giữ code nào hoặc merge thủ công, xóa marker <<<< ==== >>>>, chạy test, git add, git commit. Dùng mergetool nếu cần.","scenario":"2 dev cùng sửa cùng dòng trong User.php. Cần trao đổi để hiểu logic, không tự ý chọn 1 bên."},{"id":"PERF-018","question":"OPcache trong PHP giúp gì và cấu hình quan trọng?","category":"OOP/Performance","difficulty":"Middle","type":"Trắc nghiệm","tags":["OPcache","Performance","PHP"],"options":[{"label":"A","text":"Cache kết quả query"},{"label":"B","text":"Cache opcode đã biên dịch, giảm thời gian parse PHP, cấu hình opcache.memory_consumption, validate_timestamps=0 ở production"},{"label":"C","text":"Cache session"},{"label":"D","text":"Không cần thiết với PHP 8"}],"correct":"B","explanation":"OPcache lưu bytecode, tăng performance 3-5x. Production: opcache.validate_timestamps=0 (không check file mtime mỗi request), opcache.max_accelerated_files đủ lớn, preload cho PHP 7.4+."},{"id":"LAR-019","question":"Laravel Horizon dùng để làm gì và lợi ích so với queue:work thường?","category":"Laravel","difficulty":"Senior","type":"Trắc nghiệm","tags":["Horizon","Queue","Monitoring"],"options":[{"label":"A","text":"Thay thế hoàn toàn Redis"},{"label":"B","text":"Dashboard giám sát queue, auto-scaling workers, retry failed, metrics, balancing strategy"},{"label":"C","text":"Chỉ dùng để gửi mail"},{"label":"D","text":"Không có lợi ích gì"}],"correct":"B","explanation":"Horizon cung cấp UI đẹp, config supervisor, cân bằng queue (simple/auto), pause/resume queue, xem throughput, runtime, failed jobs. Bắt buộc cho hệ thống queue lớn."},{"id":"OOP-020","question":"Trong PHPUnit, khi nào dùng Mock vs Stub vs Fake trong Laravel testing?","category":"OOP/Performance","difficulty":"Middle","type":"Code","tags":["Testing","Mock","PHPUnit"],"options":[{"label":"A","text":"Dùng giống nhau, chỉ khác tên"},{"label":"B","text":"Mock kiểm tra interaction (method được gọi), Stub trả về dữ liệu giả, Fake là implementation nhẹ (vd: Mail::fake())"},{"label":"C","text":"Chỉ nên dùng Mock"},{"label":"D","text":"Testing không cần thiết"}],"correct":"B","explanation":"Mock: $mock->expects($this->once())->method(\"send\"). Stub: trả về giá trị cố định. Fake: Laravel cung cấp cho Queue, Mail, Storage để test mà không gửi thật. Dùng RefreshDatabase cho test isolation.","codeSnippet":"Mail::fake();\n// action\nMail::assertSent(InvoiceMail::class);"},{"id":"PHP-021","question":"PHP 8 Fibers dùng để giải quyết vấn đề gì?","category":"PHP Core","difficulty":"Senior","type":"Trắc nghiệm","tags":["PHP 8.1","Fibers","Async"],"options":[{"label":"A","text":"Tăng tốc độ xử lý string"},{"label":"B","text":"Cho phép cooperative multitasking, suspend/resume code, nền tảng cho async framework"},{"label":"C","text":"Thay thế cho Generators"},{"label":"D","text":"Chỉ dùng cho Laravel"}],"correct":"B","explanation":"Fibers cho phép tạm dừng function ở giữa và resume sau, giúp viết async code theo kiểu đồng bộ. Là nền tảng cho Revolt, Amp, Laravel Octane."},{"id":"DB-022","question":"MySQL transaction isolation level nào tránh được phantom read?","category":"MySQL/Database","difficulty":"Senior","type":"Trắc nghiệm","tags":["Isolation","Transaction","MySQL"],"options":[{"label":"A","text":"READ UNCOMMITTED"},{"label":"B","text":"READ COMMITTED"},{"label":"C","text":"REPEATABLE READ (InnoDB default) dùng gap lock, SERIALIZABLE cũng tránh được"},{"label":"D","text":"Không level nào tránh được"}],"correct":"C","explanation":"InnoDB REPEATABLE READ dùng next-key lock (record + gap lock) để tránh phantom read, khác với chuẩn SQL. SERIALIZABLE khóa mạnh hơn. READ COMMITTED vẫn có phantom read."},{"id":"SYS-023","question":"Khi deploy Laravel, tại sao phải chạy php artisan config:cache và route:cache?","category":"System Admin & Security","difficulty":"Junior","type":"Trắc nghiệm","tags":["Deploy","Cache","Laravel"],"options":[{"label":"A","text":"Để làm đẹp code"},{"label":"B","text":"Gộp config và route thành file cache, giảm I/O và tăng tốc bootstrap, phải chạy sau mỗi deploy"},{"label":"C","text":"Chỉ cần khi dùng Redis"},{"label":"D","text":"Không bao giờ nên cache"}],"correct":"B","explanation":"config:cache giảm việc đọc hàng chục file config mỗi request. route:cache tương tự. Lưu ý: nếu dùng env() ngoài config file sẽ lỗi sau khi cache, phải dùng config()."},{"id":"PERF-024","question":"Làm sao phát hiện memory leak trong PHP long-running process (queue worker)?","category":"OOP/Performance","difficulty":"Senior","type":"Tình huống","tags":["Memory Leak","Queue","Performance"],"options":[{"label":"A","text":"Tăng memory_limit lên 2GB"},{"label":"B","text":"Dùng memory_get_usage(), gc_collect_cycles(), horizon memory limit, queue:restart sau mỗi N jobs, tránh static cache lớn"},{"label":"C","text":"Memory leak không xảy ra với PHP"},{"label":"D","text":"Restart server mỗi giờ"}],"correct":"B","explanation":"Nguyên nhân phổ biến: Eloquent giữ model trong memory, event listener không detach, circular reference. Giải pháp: --max-jobs, --max-time trong Horizon, dùng cursor() thay get() cho large dataset, unset biến lớn."}];

        /* ================= META / TOKENS ================= */
        const CATEGORY_ORDER = ["PHP Core", "Laravel", "MySQL/Database", "System Admin & Security", "OOP/Performance"];
        const DIFFICULTY_ORDER = ["Junior", "Middle", "Senior"];
        const TYPE_ORDER = ["Trắc nghiệm", "Tình huống", "Code"];

        const CATEGORY_META = {
            "PHP Core": { icon: "bi-code-slash", color: "var(--mauve)" },
            "Laravel": { icon: "bi-diagram-3", color: "var(--red)" },
            "MySQL/Database": { icon: "bi-database", color: "var(--blue)" },
            "System Admin & Security": { icon: "bi-shield-lock", color: "var(--sky)" },
            "OOP/Performance": { icon: "bi-speedometer2", color: "var(--peach)" },
        };
        const DIFFICULTY_META = {
            "Junior": { color: "var(--green)" },
            "Middle": { color: "var(--peach)" },
            "Senior": { color: "var(--red)" },
        };
        const TYPE_META = {
            "Trắc nghiệm": { icon: "bi-ui-checks", color: "var(--blue)" },
            "Tình huống": { icon: "bi-signpost-split", color: "var(--peach)" },
            "Code": { icon: "bi-terminal", color: "var(--green)" },
        };

        function escapeHtml(str) {
            return String(str).replace(/[&<>"']/g, (c) => ({
                "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;"
            }[c]));
        }

        /* ================= STATE ================= */
        const state = { search: "", category: "All", difficulty: "All", type: "All", page: 1, pageSize: 8 };

        /* ================= INIT FILTER SELECTS ================= */
        function fillSelect(select, list, includeAll, allLabel) {
            list.forEach((val) => {
                const opt = document.createElement("option");
                opt.value = val; opt.textContent = val;
                select.appendChild(opt);
            });
        }
        fillSelect(document.getElementById("filterCategory"), CATEGORY_ORDER);
        fillSelect(document.getElementById("filterDifficulty"), DIFFICULTY_ORDER);
        fillSelect(document.getElementById("filterType"), TYPE_ORDER);
        fillSelect(document.getElementById("quizCategory"), CATEGORY_ORDER);

        document.getElementById("tlCount").textContent = QUESTIONS.length;
        document.getElementById("sbCount").textContent = QUESTIONS.length;
        document.getElementById("navCountBank").textContent = QUESTIONS.length;

        /* ================= FILTERING / TABLE ================= */
        function getFiltered() {
            const q = state.search.trim().toLowerCase();
            return QUESTIONS.filter((item) => {
                const matchSearch = !q ||
                    item.question.toLowerCase().includes(q) ||
                    item.id.toLowerCase().includes(q) ||
                    item.tags.join(" ").toLowerCase().includes(q);
                const matchCat = state.category === "All" || item.category === state.category;
                const matchDiff = state.difficulty === "All" || item.difficulty === state.difficulty;
                const matchType = state.type === "All" || item.type === state.type;
                return matchSearch && matchCat && matchDiff && matchType;
            });
        }

        function tagPills(tags) {
            return tags.map((t) => `<span class="tag-pill">#${escapeHtml(t)}</span>`).join(" ");
        }

        function typePill(type) {
            const meta = TYPE_META[type] || {};
            return `<span class="type-pill" style="color:${meta.color};border-color:${meta.color};background:${meta.color}1a;">
                        <i class="bi ${meta.icon}"></i> ${escapeHtml(type)}
                    </span>`;
        }

        function catPill(cat) {
            const meta = CATEGORY_META[cat] || {};
            return `<span class="cat-pill" style="color:${meta.color}"><i class="bi ${meta.icon}"></i> ${escapeHtml(cat)}</span>`;
        }

        function diffPill(diff) {
            const meta = DIFFICULTY_META[diff] || {};
            return `<span class="diff-pill" style="color:${meta.color};border-color:${meta.color};background:${meta.color}1a;">${escapeHtml(diff)}</span>`;
        }

        function renderTable() {
            const filtered = getFiltered();
            const totalPages = Math.max(1, Math.ceil(filtered.length / state.pageSize));
            state.page = Math.min(state.page, totalPages);
            const start = (state.page - 1) * state.pageSize;
            const pageItems = filtered.slice(start, start + state.pageSize);

            const tbody = document.getElementById("tableBody");
            const cardBody = document.getElementById("cardBody");
            const empty = document.getElementById("emptyBank");

            document.getElementById("resultCount").innerHTML = `Hiển thị <b>${filtered.length ? start + 1 : 0}-${Math.min(start + state.pageSize, filtered.length)}</b> / <b>${filtered.length}</b> câu hỏi`;

            if (!pageItems.length) {
                tbody.innerHTML = "";
                cardBody.innerHTML = "";
                empty.classList.remove("d-none");
            } else {
                empty.classList.add("d-none");

                tbody.innerHTML = pageItems.map((item) => {
                    const catColor = (CATEGORY_META[item.category] || {}).color || "var(--muted)";
                    return `
                    <tr>
                        <td class="row-accent"><span style="background:${catColor}"></span></td>
                        <td><span class="id-chip">${escapeHtml(item.id)}</span></td>
                        <td>
                            <div class="q-text">${escapeHtml(item.question)}</div>
                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                ${typePill(item.type)}
                                ${tagPills(item.tags)}
                            </div>
                        </td>
                        <td>${catPill(item.category)}</td>
                        <td>${diffPill(item.difficulty)}</td>
                        <td class="text-end">
                            <button class="btn-view" data-view="${escapeHtml(item.id)}" aria-label="Xem chi tiết ${escapeHtml(item.id)}">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>`;
                }).join("");

                cardBody.innerHTML = pageItems.map((item) => {
                    const catColor = (CATEGORY_META[item.category] || {}).color || "var(--muted)";
                    return `
                    <div class="q-card">
                        <span style="position:absolute;left:0;top:0;bottom:0;width:4px;background:${catColor}"></span>
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="id-chip">${escapeHtml(item.id)}</span>
                            <button class="btn-view" data-view="${escapeHtml(item.id)}" aria-label="Xem chi tiết ${escapeHtml(item.id)}">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div class="q-text">${escapeHtml(item.question)}</div>
                        <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                            ${catPill(item.category)} ${diffPill(item.difficulty)}
                        </div>
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            ${typePill(item.type)} ${tagPills(item.tags)}
                        </div>
                    </div>`;
                }).join("");
            }

            renderPagination(totalPages);

            document.querySelectorAll("[data-view]").forEach((btn) => {
                btn.addEventListener("click", () => openDetail(btn.getAttribute("data-view")));
            });
        }

        function renderPagination(totalPages) {
            const wrap = document.getElementById("paginationWrap");
            const el = document.getElementById("pagination");
            if (totalPages <= 1) { wrap.classList.add("d-none"); el.innerHTML = ""; return; }
            wrap.classList.remove("d-none");

            let html = "";
            html += `<li class="page-item ${state.page === 1 ? "disabled" : ""}">
                        <button class="page-link" data-page="${state.page - 1}"><i class="bi bi-chevron-left"></i></button></li>`;
            for (let p = 1; p <= totalPages; p++) {
                html += `<li class="page-item ${p === state.page ? "active" : ""}">
                            <button class="page-link" data-page="${p}">${p}</button></li>`;
            }
            html += `<li class="page-item ${state.page === totalPages ? "disabled" : ""}">
                        <button class="page-link" data-page="${state.page + 1}"><i class="bi bi-chevron-right"></i></button></li>`;
            el.innerHTML = html;

            el.querySelectorAll("[data-page]").forEach((btn) => {
                btn.addEventListener("click", () => {
                    const p = parseInt(btn.getAttribute("data-page"), 10);
                    if (p >= 1 && p <= totalPages) { state.page = p; renderTable(); window.scrollTo({ top: 0, behavior: "smooth" }); }
                });
            });
        }

        /* ================= DETAIL OFFCANVAS ================= */
        const detailOffcanvas = new bootstrap.Offcanvas(document.getElementById("detailOffcanvas"));

        function openDetail(id) {
            const item = QUESTIONS.find((q) => q.id === id);
            if (!item) return;

            document.getElementById("dcId").textContent = item.id;
            document.getElementById("dcMeta").innerHTML = `${catPill(item.category)} ${diffPill(item.difficulty)} ${typePill(item.type)}`;
            document.getElementById("dcQuestion").textContent = item.question;
            document.getElementById("dcExplain").textContent = item.explanation;
            document.getElementById("dcTags").innerHTML = tagPills(item.tags);

            const scenarioWrap = document.getElementById("dcScenarioWrap");
            if (item.scenario) {
                scenarioWrap.classList.remove("d-none");
                document.getElementById("dcScenario").textContent = item.scenario;
            } else {
                scenarioWrap.classList.add("d-none");
            }

            document.getElementById("dcOptions").innerHTML = item.options.map((o) => `
                <div class="opt-row ${o.label === item.correct ? "is-correct" : ""}">
                    <span class="opt-letter">${o.label}</span>
                    <span class="opt-text">${escapeHtml(o.text)}${o.label === item.correct ? ' <i class="bi bi-check-circle-fill" style="color:var(--green)"></i>' : ""}</span>
                </div>
            `).join("");

            detailOffcanvas.show();
        }

        /* ================= EVENTS: filters ================= */
        let searchDebounce;
        document.getElementById("searchInput").addEventListener("input", (e) => {
            clearTimeout(searchDebounce);
            searchDebounce = setTimeout(() => { state.search = e.target.value; state.page = 1; renderTable(); }, 200);
        });
        document.getElementById("filterCategory").addEventListener("change", (e) => { state.category = e.target.value; state.page = 1; renderTable(); });
        document.getElementById("filterDifficulty").addEventListener("change", (e) => { state.difficulty = e.target.value; state.page = 1; renderTable(); });
        document.getElementById("filterType").addEventListener("change", (e) => { state.type = e.target.value; state.page = 1; renderTable(); });
        document.getElementById("btnResetFilter").addEventListener("click", () => {
            state.search = ""; state.category = "All"; state.difficulty = "All"; state.type = "All"; state.page = 1;
            document.getElementById("searchInput").value = "";
            document.getElementById("filterCategory").value = "All";
            document.getElementById("filterDifficulty").value = "All";
            document.getElementById("filterType").value = "All";
            renderTable();
        });

        renderTable();

        /* ================= QUIZ ================= */
        let quiz = null; // { questions, index, answers, startedAt, timerHandle }
        let quizHistory = [];

        function shuffle(arr) {
            const a = arr.slice();
            for (let i = a.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [a[i], a[j]] = [a[j], a[i]];
            }
            return a;
        }

        function formatTime(sec) {
            const m = Math.floor(sec / 60).toString().padStart(2, "0");
            const s = Math.floor(sec % 60).toString().padStart(2, "0");
            return `${m}:${s}`;
        }

        document.getElementById("btnStartQuiz").addEventListener("click", () => {
            const count = parseInt(document.getElementById("quizCount").value, 10);
            const cat = document.getElementById("quizCategory").value;
            const pool = cat === "All" ? QUESTIONS : QUESTIONS.filter((q) => q.category === cat);
            const picked = shuffle(pool).slice(0, Math.min(count, pool.length));

            if (!picked.length) { alert("Không đủ câu hỏi cho lựa chọn này."); return; }

            quiz = { questions: picked, index: 0, answers: {}, startedAt: Date.now() };
            document.getElementById("quizSetup").classList.add("d-none");
            document.getElementById("quizResult").classList.add("d-none");
            document.getElementById("quizActive").classList.remove("d-none");

            clearInterval(quiz.timerHandle);
            quiz.timerHandle = setInterval(() => {
                document.getElementById("quizTimer").textContent = formatTime((Date.now() - quiz.startedAt) / 1000);
            }, 1000);

            renderQuizQuestion();
        });

        function renderQuizQuestion() {
            const q = quiz.questions[quiz.index];
            const total = quiz.questions.length;
            document.getElementById("quizProgressLabel").textContent = `Câu ${quiz.index + 1}/${total}`;
            document.getElementById("quizProgressBar").style.width = `${((quiz.index + 1) / total) * 100}%`;
            document.getElementById("quizQMeta").innerHTML = `${catPill(q.category)} ${diffPill(q.difficulty)}`;
            document.getElementById("quizQText").textContent = q.question;

            document.getElementById("quizOptions").innerHTML = q.options.map((o) => `
                <button type="button" class="quiz-opt ${quiz.answers[q.id] === o.label ? "selected" : ""}" data-opt="${o.label}">
                    <span class="opt-letter">${o.label}</span>
                    <span>${escapeHtml(o.text)}</span>
                </button>
            `).join("");

            document.querySelectorAll(".quiz-opt").forEach((btn) => {
                btn.addEventListener("click", () => {
                    quiz.answers[q.id] = btn.getAttribute("data-opt");
                    renderQuizQuestion();
                });
            });

            document.getElementById("btnQuizPrev").disabled = quiz.index === 0;
            document.getElementById("btnQuizNext").innerHTML = quiz.index === total - 1
                ? 'Nộp bài <i class="bi bi-check2-circle"></i>'
                : 'Tiếp theo <i class="bi bi-arrow-right"></i>';
        }

        document.getElementById("btnQuizPrev").addEventListener("click", () => {
            if (quiz.index > 0) { quiz.index--; renderQuizQuestion(); }
        });
        document.getElementById("btnQuizNext").addEventListener("click", () => {
            if (quiz.index < quiz.questions.length - 1) { quiz.index++; renderQuizQuestion(); }
            else { submitQuiz(); }
        });

        function submitQuiz() {
            clearInterval(quiz.timerHandle);
            const total = quiz.questions.length;
            let score = 0;
            quiz.questions.forEach((q) => { if (quiz.answers[q.id] === q.correct) score++; });

            const elapsed = Math.floor((Date.now() - quiz.startedAt) / 1000);
            const record = {
                id: Date.now(), date: new Date().toLocaleString("vi-VN"),
                score, total, elapsed,
                questions: quiz.questions, answers: { ...quiz.answers },
            };
            quizHistory.unshift(record);
            renderResultsTab();

            document.getElementById("quizActive").classList.add("d-none");
            document.getElementById("quizResult").classList.remove("d-none");
            document.getElementById("quizReviewList").classList.add("d-none");
            document.getElementById("btnToggleReview").innerHTML = '<i class="bi bi-eye"></i> Xem lại đáp án';
            renderScore(record);
        }

        function renderScore(record) {
            const pct = Math.round((record.score / record.total) * 100);
            const ring = document.getElementById("scoreRing");
            const color = pct >= 80 ? "var(--green)" : pct >= 60 ? "var(--peach)" : "var(--red)";
            ring.style.borderColor = color;
            document.getElementById("scoreNum").textContent = `${record.score}/${record.total}`;
            document.getElementById("scoreNum").style.color = color;
            document.getElementById("scoreVerdict").textContent =
                pct >= 80 ? "Xuất sắc! 🎉" : pct >= 60 ? "Khá tốt, cố lên!" : "Cần luyện tập thêm";
            document.getElementById("scoreVerdict").style.color = color;
            document.getElementById("scoreTime").textContent = `${pct}% chính xác · thời gian ${formatTime(record.elapsed)}`;
            renderReviewList(record, "quizReviewList");
        }

        function renderReviewList(record, targetId) {
            const wrap = document.getElementById(targetId);
            wrap.innerHTML = record.questions.map((q, i) => {
                const userAns = record.answers[q.id];
                const isCorrect = userAns === q.correct;
                return `
                <div class="quiz-card mb-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="id-chip">${escapeHtml(q.id)}</span>
                        <span style="color:${isCorrect ? "var(--green)" : "var(--red)"};font-size:.8rem;font-family:var(--font-mono);">
                            <i class="bi ${isCorrect ? "bi-check-circle-fill" : "bi-x-circle-fill"}"></i> Câu ${i + 1}
                        </span>
                    </div>
                    <div class="q-text mb-3">${escapeHtml(q.question)}</div>
                    ${q.options.map((o) => {
                        let cls = "";
                        if (o.label === q.correct) cls = "correct-answer";
                        else if (o.label === userAns) cls = "wrong-answer";
                        return `<div class="quiz-opt ${cls}" style="cursor:default;">
                                    <span class="opt-letter">${o.label}</span><span>${escapeHtml(o.text)}</span>
                                </div>`;
                    }).join("")}
                    <div class="callout callout-explain mt-2">
                        <div class="callout-title" style="color:var(--green)"><i class="bi bi-lightbulb"></i> Giải thích</div>
                        <div class="callout-body">${escapeHtml(q.explanation)}</div>
                    </div>
                </div>`;
            }).join("");
        }

        document.getElementById("btnToggleReview").addEventListener("click", () => {
            const el = document.getElementById("quizReviewList");
            const btn = document.getElementById("btnToggleReview");
            el.classList.toggle("d-none");
            btn.innerHTML = el.classList.contains("d-none")
                ? '<i class="bi bi-eye"></i> Xem lại đáp án'
                : '<i class="bi bi-eye-slash"></i> Ẩn đáp án';
        });

        document.getElementById("btnRetryQuiz").addEventListener("click", () => {
            document.getElementById("quizResult").classList.add("d-none");
            document.getElementById("quizSetup").classList.remove("d-none");
        });

        /* ================= RESULTS TAB ================= */
        function renderResultsTab() {
            document.getElementById("navCountResults").textContent = quizHistory.length;
            const empty = document.getElementById("resultsEmpty");
            const list = document.getElementById("resultsList");

            if (!quizHistory.length) { empty.classList.remove("d-none"); list.classList.add("d-none"); return; }
            empty.classList.add("d-none"); list.classList.remove("d-none");

            list.innerHTML = quizHistory.map((r, idx) => {
                const pct = Math.round((r.score / r.total) * 100);
                const color = pct >= 80 ? "var(--green)" : pct >= 60 ? "var(--peach)" : "var(--red)";
                return `
                <div class="attempt-card">
                    <div style="width:52px;height:52px;border-radius:50%;border:4px solid ${color};display:flex;align-items:center;justify-content:center;font-family:var(--font-mono);font-weight:700;font-size:.78rem;color:${color};flex-shrink:0;">${pct}%</div>
                    <div class="flex-grow-1">
                        <div style="font-weight:600;">${r.score}/${r.total} câu đúng</div>
                        <div class="small" style="color:var(--muted)">${r.date} · ${formatTime(r.elapsed)}</div>
                    </div>
                    <button class="btn btn-outline-app btn-sm" data-review="${idx}"><i class="bi bi-eye"></i> Xem lại</button>
                </div>`;
            }).join("");

            list.querySelectorAll("[data-review]").forEach((btn) => {
                btn.addEventListener("click", () => {
                    const r = quizHistory[parseInt(btn.getAttribute("data-review"), 10)];
                    document.getElementById("quizSetup").classList.add("d-none");
                    document.getElementById("quizActive").classList.add("d-none");
                    document.getElementById("quizResult").classList.remove("d-none");
                    document.getElementById("quizReviewList").classList.remove("d-none");
                    document.getElementById("btnToggleReview").innerHTML = '<i class="bi bi-eye-slash"></i> Ẩn đáp án';
                    renderScore(r);
                    new bootstrap.Tab(document.querySelector('[data-bs-target="#tab-quiz"]')).show();
                    window.scrollTo({ top: 0, behavior: "smooth" });
                });
            });
        }

        document.getElementById("btnGotoQuiz").addEventListener("click", () => {
            new bootstrap.Tab(document.querySelector('[data-bs-target="#tab-quiz"]')).show();
        });
    </script>
</body>

</html>