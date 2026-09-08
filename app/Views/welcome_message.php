<!DOCTYPE html>
<html lang="en">
<head>
    <title>Who's the Hero?</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="icon" href="<?= base_url('assets/logo.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('assets/fonts/fontawesome/css/fontawesome-all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/animation/css/animate.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

    <style>
        html, body {
            min-height: 100%;
        }

        body {
            margin: 0;
            background-color: #EEF3F5;
            background-image:
                radial-gradient(circle, rgba(19,110,110,0.16) 1.4px, transparent 1.4px),
                linear-gradient(120deg, #EEF3F5, #E7F1F0, #EEF3F5, #EAF0F7);
            background-size: 26px 26px, 300% 300%;
            background-attachment: fixed, fixed;
            animation: bgPan 18s ease-in-out infinite;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        @keyframes bgPan {
            0%   { background-position: 0 0, 0% 50%; }
            50%  { background-position: 0 0, 100% 50%; }
            100% { background-position: 0 0, 0% 50%; }
        }

        .bg-blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(70px);
            z-index: 0;
            pointer-events: none;
        }
        .bg-blob-1 {
            width: 480px;
            height: 480px;
            top: -160px;
            left: -140px;
            background: rgba(14,148,143,0.20);
            animation: drift1 22s ease-in-out infinite;
        }
        .bg-blob-2 {
            width: 420px;
            height: 420px;
            bottom: -140px;
            right: -120px;
            background: rgba(45,90,166,0.16);
            animation: drift2 26s ease-in-out infinite;
        }
        .bg-blob-3 {
            width: 300px;
            height: 300px;
            top: 40%;
            right: 8%;
            background: rgba(204,154,6,0.12);
            animation: drift1 30s ease-in-out infinite reverse;
        }

        @keyframes drift1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, 25px) scale(1.06); }
        }
        @keyframes drift2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-25px, -20px) scale(1.05); }
        }

        @media (prefers-reduced-motion: reduce) {
            .bg-blob, body, .dashboard-title-wrap h2, .header-title span, .logo-left img, .logo-right img {
                animation: none !important;
            }
        }

        /* ---------- HEADER ---------- */
        .site-header {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 2rem;
            background: linear-gradient(90deg, #5374d1, #3661c3);
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        /* Logo slide-in-from-left on page load, then settle in place */
        .site-header .logo-left img {
            height: 48px;
            width: auto;
            display: block;
            animation: slideInLeft 1s cubic-bezier(0.25, 0.8, 0.25, 1) both;
        }

        /* Logo slide-in-from-right on page load, then settle in place */
        .site-header .logo-right img {
            height: 48px;
            width: auto;
            display: block;
            animation: slideInRight 1s cubic-bezier(0.25, 0.8, 0.25, 1) both;
        }

        @keyframes slideInLeft {
            0% {
                transform: translateX(-140px);
                opacity: 0;
            }
            70% {
                transform: translateX(6px);
                opacity: 1;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideInRight {
            0% {
                transform: translateX(140px);
                opacity: 0;
            }
            70% {
                transform: translateX(-6px);
                opacity: 1;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .site-header .header-title {
            font-weight: 800;
            font-size: 2.4rem;
            letter-spacing: 1px;
            text-align: center;
            flex: 1;
            text-shadow: 0 2px 6px rgba(0,0,0,0.25);
        }

        /* Each letter blinks (opacity) AND cycles through colours in a
           staggered wave across the title */
        .header-title span {
            display: inline-block;
            animation: letterBlink 1.6s ease-in-out infinite,
                       letterColor 3.2s linear infinite;
        }

        .header-title span.space {
            width: 0.4em;
        }

        @keyframes letterBlink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.2; }
        }

        @keyframes letterColor {
            0%   { color: #ff5f6d; }
            16%  { color: #ffc371; }
            33%  { color: #f6ff6d; }
            50%  { color: #6dffb0; }
            66%  { color: #6dc9ff; }
            83%  { color: #b06dff; }
            100% { color: #ff5f6d; }
        }

        .site-header .logo-left,
        .site-header .logo-right {
            flex: 0 0 auto;
            min-width: 60px;
        }
        .site-header .logo-right {
            display: flex;
            justify-content: flex-end;
        }

        /* ---------- FOOTER ---------- */
        .site-footer {
            position: relative;
            z-index: 2;
            width: 100%;
            margin-top: auto;
            padding: 1rem 2rem;
            background: #313377;
            color: #eaf3f1;
            text-align: center;
            font-size: 0.9rem;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.15);
            box-sizing: border-box;
        }
        .site-footer a {
            color: #cfe8e4;
            text-decoration: none;
        }
        .site-footer a:hover {
            text-decoration: underline;
        }

        /* ---------- MAIN CONTENT ---------- */
        .auth-wrapper {
            position: relative;
            z-index: 1;
            background-color: #F5F8FA;
            flex: 1;
            overflow: hidden; /* keep bubbles contained inside this section */
        }

        .auth-wrapper > .row {
            position: relative;
            z-index: 1; /* keep real content above the bubble layer */
        }

        .container-fluid.py-4 {
            background: rgba(255,255,255,0.55);
            backdrop-filter: blur(6px);
            border-radius: 20px;
            margin: 1.5rem;
        }

        /* Content container needs relative positioning so the bubble
           layer (position: absolute) clips inside it correctly */
        .container-fluid.py-2 {
            position: relative;
            z-index: 1;
        }
        .container-fluid.py-2 > .row {
            position: relative;
            z-index: 1;
        }

        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 3px solid #000 !important;
            border-radius: 14px;
            overflow: hidden;
            min-height: 320px;
        }
        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.12) !important;
            border-color: #000 !important;
        }

        /* Disabled category card — visually differentiated from active ones */
        .stat-card.stat-card-disabled {
            background: repeating-linear-gradient(
                135deg,
                #e9ecef,
                #e9ecef 14px,
                #dfe3e6 14px,
                #dfe3e6 28px
            );
            border-color: #6c757d !important;
            filter: grayscale(0.6);
        }
        .stat-card.stat-card-disabled:hover {
            transform: none;
            box-shadow: none !important;
            border-color: #6c757d !important;
        }
        .stat-card.stat-card-disabled .stat-title-box .stat-title {
            color: #6c757d;
        }
        .stat-card.stat-card-disabled .stat-icon-wrap {
            background: rgba(108,117,125,0.10) !important;
        }
        .stat-card-disabled-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #6c757d;
            color: #fff;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.25rem 0.6rem;
            border-radius: 999px;
            letter-spacing: 0.5px;
            z-index: 2;
        }

        .stat-icon-wrap {
            width: 100%;
            height: 300px;
            margin: 0 auto;
            padding: 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .icon-primary { background: rgba(13,110,253,0.08); }
        .icon-success { background: rgba(25,135,84,0.08); }
        .icon-warning { background: rgba(255,193,7,0.10); }
        .icon-danger  { background: rgba(220,53,69,0.08); }

        /* Image is hidden entirely; the box shows the title instead */
        .stat-img {
            display: none;
        }

        .stat-title-box {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 1rem;
        }
        .stat-title-box .stat-title {
            font-weight: 800;
            font-size: 4.2rem;
            line-height: 1.2;
            margin: 0;
            color: #0b3d3a;
        }

        .stat-card-body {
            padding: 0 !important;
        }
        .stat-card {
            min-height: 280px;
        }

        .dashboard-title-wrap {
            text-align: center;
            margin-top: 1rem;
            margin-bottom: 2rem;
        }
        .dashboard-title-wrap h2 {
            display: inline-block;
            font-weight: 700;
            background: linear-gradient(90deg, #0d6efd, #198754, #cc9a06, #dc3545, #0d6efd);
            background-size: 300% 100%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
            animation: titleColorShift 6s linear infinite;
        }

        @keyframes titleColorShift {
            0%   { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        .row-gap-section {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .stat-col {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
        div#debug-icon {
            display: none;
        }

        /* ---------- CONTENT AREA FLOATING BUBBLES ---------- */
        .content-bubbles {
            position: absolute;
            inset: 0;
            overflow: hidden;
            border-radius: 20px;
            z-index: 0;
            pointer-events: none;
        }

        .content-bubbles .bubble {
            position: absolute;
            bottom: -80px;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.85), rgba(83,116,209,0.18) 70%);
            opacity: 0.55;
            animation-name: bubbleFloat;
            animation-timing-function: ease-in;
            animation-iteration-count: infinite;
        }

        .content-bubbles .bubble:nth-child(1) { left: 4%;  width: 26px; height: 26px; animation-duration: 12s; animation-delay: 0s; }
        .content-bubbles .bubble:nth-child(2) { left: 14%; width: 14px; height: 14px; animation-duration: 9s;  animation-delay: 1.5s; }
        .content-bubbles .bubble:nth-child(3) { left: 24%; width: 34px; height: 34px; animation-duration: 15s; animation-delay: 0.5s; }
        .content-bubbles .bubble:nth-child(4) { left: 36%; width: 18px; height: 18px; animation-duration: 10s; animation-delay: 3s; }
        .content-bubbles .bubble:nth-child(5) { left: 48%; width: 22px; height: 22px; animation-duration: 13s; animation-delay: 2s; }
        .content-bubbles .bubble:nth-child(6) { left: 58%; width: 30px; height: 30px; animation-duration: 16s; animation-delay: 1s; }
        .content-bubbles .bubble:nth-child(7) { left: 68%; width: 16px; height: 16px; animation-duration: 11s; animation-delay: 4s; }
        .content-bubbles .bubble:nth-child(8) { left: 78%; width: 24px; height: 24px; animation-duration: 14s; animation-delay: 2.5s; }
        .content-bubbles .bubble:nth-child(9) { left: 88%; width: 20px; height: 20px; animation-duration: 10s; animation-delay: 0.8s; }
        .content-bubbles .bubble:nth-child(10) { left: 94%; width: 32px; height: 32px; animation-duration: 17s; animation-delay: 3.5s; }

        @keyframes bubbleFloat {
            0% {
                transform: translateY(0) translateX(0) scale(1);
                opacity: 0;
            }
            10% {
                opacity: 0.55;
            }
            50% {
                transform: translateY(-160px) translateX(18px) scale(1.05);
            }
            90% {
                opacity: 0.4;
            }
            100% {
                transform: translateY(-360px) translateX(-12px) scale(0.9);
                opacity: 0;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .content-bubbles .bubble {
                animation: none !important;
                display: none;
            }
        }
         
        .card-bubbles {
            position: absolute;
            inset: 0;
            overflow: hidden;
            border-radius: 14px; /* match .stat-card radius */
            z-index: 0;
            pointer-events: none;
        }

        .card-bubbles .bubble {
            position: absolute;
            bottom: 0px;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgb(64 38 38 / 85%), rgb(10 10 10 / 18%) 70%);
            opacity: 0.55;
            animation-name: cardBubbleFloat;
            animation-timing-function: ease-in;
            animation-iteration-count: infinite;
        }

        .card-bubbles .bubble:nth-child(1) { left: 10%; width: 14px; height: 14px; animation-duration: 7s;  animation-delay: 0s; }
        .card-bubbles .bubble:nth-child(2) { left: 30%; width: 20px; height: 20px; animation-duration: 9s;  animation-delay: 1.2s; }
        .card-bubbles .bubble:nth-child(3) { left: 50%; width: 12px; height: 12px; animation-duration: 6s;  animation-delay: 2.4s; }
        .card-bubbles .bubble:nth-child(4) { left: 70%; width: 18px; height: 18px; animation-duration: 8s;  animation-delay: 0.8s; }
        .card-bubbles .bubble:nth-child(5) { left: 88%; width: 15px; height: 15px; animation-duration: 10s; animation-delay: 1.8s; }

        @keyframes cardBubbleFloat {
            0% {
                transform: translateY(0) translateX(0) scale(1);
                opacity: 0;
            }
            10% {
                opacity: 0.55;
            }
            50% {
                transform: translateY(-90px) translateX(10px) scale(1.05);
            }
            90% {
                opacity: 0.35;
            }
            100% {
                transform: translateY(-200px) translateX(-8px) scale(0.9);
                opacity: 0;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .card-bubbles .bubble {
                animation: none !important;
                display: none;
            }
        }
        .auth-wrapper .card {
            margin-bottom: 0;
            padding: 0px !important;
        }
        .cat-stat-row {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.35rem 0.5rem;
            flex-wrap: wrap;
        }
        .cat-stat-pill {
            font-size: 0.8rem;
            font-weight: 700;
            padding: 0.25rem 0.7rem;
            border-radius: 20px;
            background: #fff;
            border: 1.5px solid #000;
        }
        .cat-stat-right { color: #198754; }
        .cat-stat-wrong { color: #dc3545; }
        .cat-stat-time  { color: #333; }
        .stat-card-disabled .cat-stat-pill {
            border-color: #6c757d;
            color: #6c757d !important;
        }
    </style>
</head>

<body>

<div class="bg-blob bg-blob-1"></div>
<div class="bg-blob bg-blob-2"></div>
<div class="bg-blob bg-blob-3"></div>

<!-- ---------- HEADER ---------- -->
<div>
    <div class="row">
        <div class="col-md-12">
            <header class="site-header">
                <div class="logo-left">
                    <img src="<?= base_url('assets/Event_logo.png') ?>" alt="Logo">
                </div>
                <div class="header-title" id="headerTitle">Who's the Hero?</div>
                <div class="logo-right">
                    <img src="<?= base_url('assets/logo.png') ?>" alt="Logo">
                </div>
            </header>
        </div>
        <div class="col-md-12">
            <div class="auth-wrapper aut-bg-img-side cotainer-fiuid align-items-stretch" style="background-image: url('<?= base_url('assets/background_image.jpeg') ?>')">
                <div class="row align-items-center w-100 align-items-stretch">
                    <div class="container-fluid py-2">
                        <div class="content-bubbles">
                            <span class="bubble"></span>
                            <span class="bubble"></span>
                            <span class="bubble"></span>
                            <span class="bubble"></span>
                            <span class="bubble"></span>
                            <span class="bubble"></span>
                            <span class="bubble"></span>
                            <span class="bubble"></span>
                            <span class="bubble"></span>
                            <span class="bubble"></span>
                        </div>
                        <div class="row">
                            <?php $delay = 0.1; ?>
                            <?php foreach ($categoryList as $row) : ?>
                                <div class="col-md-6 col-sm-6 stat-col animate__animated animate__fadeInUp" style="animation-delay: <?= $delay ?>s;">
                                <?php if ($row->categoryId == 0) : ?>
                                    <a href="<?= base_url('graphview/' . $row->cid) ?>" class="text-decoration-none">
                                        <div class="card stat-card shadow-sm h-100" style="position: relative;">
                                            <div class="card-bubbles">
                                                <span class="bubble"></span>
                                                <span class="bubble"></span>
                                                <span class="bubble"></span>
                                                <span class="bubble"></span>
                                                <span class="bubble"></span>
                                            </div>
                                            <div class="card-body stat-card-body text-center">
                                                <div class="stat-icon-wrap icon-primary">
                                                    <img src="<?= base_url('uploads/' . $row->cat_image) ?>" alt="<?= esc($row->cat_image) ?>" class="stat-img">
                                                    <div class="stat-title-box">
                                                        <p class="stat-title"><?= esc($row->cat_name ?? $row->cat_image) ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php else : ?>
                                    <div class="card stat-card stat-card-disabled shadow-sm h-100" style="cursor: not-allowed; position: relative;">
                                        <span class="stat-card-disabled-badge">Disabled</span>
                                        <div class="card-bubbles">
                                            <span class="bubble"></span>
                                            <span class="bubble"></span>
                                            <span class="bubble"></span>
                                            <span class="bubble"></span>
                                            <span class="bubble"></span>
                                        </div>
                                        <div class="card-body stat-card-body text-center">
                                            <div class="stat-icon-wrap icon-primary">
                                                <img src="<?= base_url('uploads/' . $row->cat_image) ?>" alt="<?= esc($row->cat_image) ?>" class="stat-img">
                                                <div class="stat-title-box">
                                                    <p class="stat-title"><?= esc($row->cat_name ?? $row->cat_image) ?></p>
                                                </div>
                                            </div>
                                            <!-- NEW: quiz stats for this category -->
                                            <div class="cat-stat-row">
                                                <span class="cat-stat-pill cat-stat-right">Right: <?= (int) $row->right_count ?></span>
                                                <span class="cat-stat-pill cat-stat-wrong">Wrong: <?= (int) $row->wrong_count ?></span>
                                            </div>
                                            <!-- <div class="cat-stat-row">
                                                <span class="cat-stat-pill cat-stat-time">Used: <?= esc($row->total_time_used_formatted) ?></span>
                                                <span class="cat-stat-pill cat-stat-time">Balance: <?= esc($row->time_balance_formatted) ?></span>
                                            </div> -->
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php $delay += 0.15; ?>
                            <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>  
        <!-- ---------- FOOTER ---------- -->
        <footer class="site-footer">
            Developed by the Event's Team | © <?= date('Y') ?>. All Rights Reserved.
        </footer>
    </div>
</div>  

<!-- JS -->
<script src="<?= base_url('assets/js/vendor-all.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>

<script>
    // Split the header title into individual letter spans and stagger
    // the blink animation so the letters blink in a left-to-right wave.
    (function () {
        var titleEl = document.getElementById('headerTitle');
        if (!titleEl) return;

        var text = titleEl.textContent;
        titleEl.textContent = '';

        var delayStep = 0.08; // seconds between each letter's animation start

        for (var i = 0; i < text.length; i++) {
            var ch = text[i];
            var span = document.createElement('span');

            if (ch === ' ') {
                span.classList.add('space');
                span.innerHTML = '&nbsp;';
            } else {
                span.textContent = ch;
            }

            span.style.animationDelay = (i * delayStep) + 's';
            titleEl.appendChild(span);
        }
    })();
</script>

</body>
</html>