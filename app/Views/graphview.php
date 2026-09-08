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
            background-color: #FFF6ED;
            background-image:
                radial-gradient(circle, rgba(255,138,80,0.16) 1.4px, transparent 1.4px),
                linear-gradient(120deg, #FFF6ED, #FDE9E0, #FFF0E6, #FCEFE3);
            background-size: 26px 26px, 300% 300%;
            background-attachment: fixed, fixed;
            animation: bgPan 18s ease-in-out infinite;
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
            background: rgba(255,111,60,0.22);
            animation: drift1 22s ease-in-out infinite;
        }
        .bg-blob-2 {
            width: 420px;
            height: 420px;
            bottom: -140px;
            right: -120px;
            background: rgba(255,64,129,0.16);
            animation: drift2 26s ease-in-out infinite;
        }
        .bg-blob-3 {
            width: 400px;
            height: 400px;
            top: 40%;
            right: 8%;
            background: rgba(255,193,7,0.16);
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
            .bg-blob, body, .dashboard-title-wrap h2 {
                animation: none !important;
            }
        }

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

        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 3px solid #000 !important;
            border-radius: 14px;
            overflow: hidden;
        }
        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.12) !important;
            border-color: #000 !important;
        }
        .stat-icon-wrap {
            width: 100%;
            height: 100%;
            display: block;
            margin: 0;
            overflow: hidden;
            transition: none;
        }
        .stat-card:hover .stat-icon-wrap {
            transform: none;
        }
        /* .icon-primary { background: rgba(13,110,253,0.08); } */
        .icon-primary { background: white; }
        .icon-success { background: rgba(25,135,84,0.08); }
        .icon-warning { background: rgba(255,193,7,0.10); }
        .icon-danger  { background: rgba(220,53,69,0.08); }
        .stat-img {
            /* width: 100%; */
            height: 100%;
            object-fit: cover;
            /* display: block; */
            transition: transform 0.4s ease;
        }
        .stat-card:hover .stat-img {
            transform: scale(1.06);
        }
        .stat-card-body {
            padding: 0;
        }
        .stat-card {
            min-height: 280px;
        }
        .stat-title {
            font-weight: 700;
            font-size: 1.15rem;
            margin: 0;
        }

        .dashboard-title-wrap {
            text-align: center;
            margin-top: 1rem;
            margin-bottom: 2rem;
        }
        .dashboard-title-wrap h2 {
            display: inline-block;
            font-weight: 700;
            background: linear-gradient(90deg, #ff6f3c, #ff4081, #ffc107, #ff6f3c);
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

        /* ---- Countdown number ---- */
        .timer-countdown {
            text-align: center;
            font-weight: 800;
            font-size: 1.4rem;
            padding: 0.4rem 0 0.2rem;
            color: #ff4081;
            font-variant-numeric: tabular-nums;
        }
        .timer-countdown.is-low {
            color: #dc3545;
            animation: pulseCountdown 1s ease-in-out infinite;
        }
        @keyframes pulseCountdown {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.15); }
        }

        /* ---- Progress bar (per-image 10s timer) ---- */
        .progress-track {
            width: 100%;
            height: 6px;
            background: rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            width: 100%;
            background: linear-gradient(90deg, #ff6f3c, #ff4081, #ffc107);
            transform-origin: left;
            animation: shrinkBar 10s linear forwards;
        }
        @keyframes shrinkBar {
            from { transform: scaleX(1); }
            to   { transform: scaleX(0); }
        }

        /* ---- Image entrance animations (cycled per image) ---- */
        #slideImage {
            will-change: transform, opacity;
        }

        @keyframes slideInFromRight {
            0%   { transform: translateX(120%); opacity: 0; }
            70%  { transform: translateX(-8%); opacity: 1; }
            100% { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideInFromLeft {
            0%   { transform: translateX(-120%); opacity: 0; }
            70%  { transform: translateX(8%); opacity: 1; }
            100% { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideInFromTop {
            0%   { transform: translateY(-120%); opacity: 0; }
            70%  { transform: translateY(8%); opacity: 1; }
            100% { transform: translateY(0); opacity: 1; }
        }

        @keyframes slideInFromBottom {
            0%   { transform: translateY(120%); opacity: 0; }
            70%  { transform: translateY(-8%); opacity: 1; }
            100% { transform: translateY(0); opacity: 1; }
        }

        @keyframes slideInZoom {
            0%   { transform: scale(0.3); opacity: 0; }
            70%  { transform: scale(1.08); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }

        .slide-anim-right  { animation: slideInFromRight 0.7s cubic-bezier(0.25, 0.8, 0.25, 1) both; }
        .slide-anim-left   { animation: slideInFromLeft 0.7s cubic-bezier(0.25, 0.8, 0.25, 1) both; }
        .slide-anim-top    { animation: slideInFromTop 0.7s cubic-bezier(0.25, 0.8, 0.25, 1) both; }
        .slide-anim-bottom { animation: slideInFromBottom 0.7s cubic-bezier(0.25, 0.8, 0.25, 1) both; }
        .slide-anim-zoom   { animation: slideInZoom 0.6s cubic-bezier(0.25, 0.8, 0.25, 1) both; }

        @media (prefers-reduced-motion: reduce) {
            #slideImage {
                animation: none !important;
            }
        }

        /* ---- NEW: Box (whole card) entrance animations, cycled per image ---- */
        #slideCard {
            will-change: transform, opacity;
        }

        @keyframes boxSlideInFromRight {
            0%   { transform: translateX(140%); opacity: 0; }
            70%  { transform: translateX(-4%); opacity: 1; }
            100% { transform: translateX(0); opacity: 1; }
        }

        @keyframes boxSlideInFromLeft {
            0%   { transform: translateX(-140%); opacity: 0; }
            70%  { transform: translateX(4%); opacity: 1; }
            100% { transform: translateX(0); opacity: 1; }
        }

        @keyframes boxSlideInFromTop {
            0%   { transform: translateY(-140%); opacity: 0; }
            70%  { transform: translateY(4%); opacity: 1; }
            100% { transform: translateY(0); opacity: 1; }
        }

        @keyframes boxSlideInFromBottom {
            0%   { transform: translateY(140%); opacity: 0; }
            70%  { transform: translateY(-4%); opacity: 1; }
            100% { transform: translateY(0); opacity: 1; }
        }

        @keyframes boxSlideInZoom {
            0%   { transform: scale(0.5); opacity: 0; }
            70%  { transform: scale(1.04); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }

        .box-anim-right  { animation: boxSlideInFromRight 0.8s cubic-bezier(0.25, 0.8, 0.25, 1) both; }
        .box-anim-left   { animation: boxSlideInFromLeft 0.8s cubic-bezier(0.25, 0.8, 0.25, 1) both; }
        .box-anim-top    { animation: boxSlideInFromTop 0.8s cubic-bezier(0.25, 0.8, 0.25, 1) both; }
        .box-anim-bottom { animation: boxSlideInFromBottom 0.8s cubic-bezier(0.25, 0.8, 0.25, 1) both; }
        .box-anim-zoom   { animation: boxSlideInZoom 0.7s cubic-bezier(0.25, 0.8, 0.25, 1) both; }

        @media (prefers-reduced-motion: reduce) {
            #slideCard {
                animation: none !important;
            }
        }

        /* ---- Right / Wrong action buttons (replaces radio inputs) ---- */
        .answer-choice {
            display: flex;
            justify-content: center;
            gap: 2rem;
            padding: 1rem 0;
            background: #fff;
        }
        .answer-choice .btn-answer {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            padding: 0.5rem 1.4rem;
            border-radius: 30px;
            border: 2px solid transparent;
            background: #f8f9fa;
            transition: border-color 0.2s ease, background 0.2s ease, transform 0.15s ease;
        }
        .answer-choice .btn-answer:active {
            transform: scale(0.94);
        }
        .answer-choice .btn-right {
            color: #198754;
        }
        .answer-choice .btn-right:hover {
            border-color: #198754;
            background: rgba(25,135,84,0.08);
        }
        .answer-choice .btn-wrong {
            color: #dc3545;
        }
        .answer-choice .btn-wrong:hover {
            border-color: #dc3545;
            background: rgba(220,53,69,0.08);
        }
        .answer-choice .btn-answer:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        #thankYouCard {
            min-height: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #thankYouCard h3 {
            font-weight: 700;
        }
        #slideCounter {
            margin-top: 0.75rem;
            font-weight: 600;
            color: #555;
        }
        #thankYouCard {
            min-height: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #ffffff, #ffd8b8);
        }

        .thank-you-icon {
            margin-bottom: 1rem;
        }

        .checkmark-svg {
            width: 90px;
            height: 90px;
            display: block;
            margin: 0 auto;
        }

        .checkmark-circle {
            stroke: #198754;
            stroke-width: 3;
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            animation: circleDraw 0.7s ease forwards;
        }

        .checkmark-check {
            stroke: #198754;
            stroke-width: 4;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: checkDraw 0.4s 0.6s ease forwards;
        }

        @keyframes circleDraw {
            to { stroke-dashoffset: 0; }
        }

        @keyframes checkDraw {
            to { stroke-dashoffset: 0; }
        }

        #thankYouCard h3 {
            font-weight: 700;
            background: linear-gradient(90deg, #ff6f3c, #198754, #ffc107);
            background-size: 200% 100%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
            animation: titleColorShift 4s linear infinite;
        }

        .result-summary {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }
        .result-pill {
            padding: 0.6rem 1.2rem;
            border-radius: 30px;
            font-weight: 700;
            border: 2px solid #000;
            background: #fff;
        }
        .result-pill.total { color: #333; }
        .result-pill.right { color: #198754; }
        .result-pill.wrong { color: #dc3545; }

         /* ---------- HEADER ---------- */
        .site-header {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 2rem;
            background: linear-gradient(90deg, #5374d1, #3661c3);
            background-size: 300% 100%;
            animation: headerGradientShift 12s linear infinite;
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        @keyframes headerGradientShift {
            0%   { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        .site-header .logo-left img {
            height: 48px;
            width: auto;
            display: block;
            animation: slideInLeft 1s cubic-bezier(0.25, 0.8, 0.25, 1) both;
        }

        .site-header .logo-right img {
            height: 48px;
            width: auto;
            display: block;
            animation: slideInRight 1s cubic-bezier(0.25, 0.8, 0.25, 1) both;
        }

        @keyframes slideInLeft {
            0% { transform: translateX(-140px); opacity: 0; }
            70% { transform: translateX(6px); opacity: 1; }
            100% { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideInRight {
            0% { transform: translateX(140px); opacity: 0; }
            70% { transform: translateX(-6px); opacity: 1; }
            100% { transform: translateX(0); opacity: 1; }
        }

        .site-header .header-title {
            font-weight: 800;
            font-size: 2.4rem;
            letter-spacing: 1px;
            text-align: center;
            flex: 1;
            text-shadow: 0 2px 6px rgba(0,0,0,0.25);
        }

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
            display: flex;
            align-items: center;
        }
        .site-header .logo-right {
            justify-content: flex-end;
        }
        .site-header img {
            object-fit: contain;
        }

        /* ---------- FOOTER ---------- */
        .site-footer {
            position: relative;
            z-index: 2;
            width: 100%;
            margin-top: auto;
            padding: 1rem 2rem;
            background: #313377;
            background-size: 300% 100%;
            animation: headerGradientShift 12s linear infinite;
            color: #ffffff;
            text-align: center;
            font-size: 0.9rem;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.15);
            box-sizing: border-box;
        }
        .site-footer a {
            color: #eaf0ff;
            text-decoration: none;
        }
        .site-footer a:hover {
            text-decoration: underline;
        }
        .auth-wrapper .card .card-body {
            padding: 0px 0px 0px 0px;
        }

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
            opacity: 0.6;
            animation-timing-function: ease-in-out;
            animation-iteration-count: infinite;
        }

        .content-bubbles .shape-circle {
            border-radius: 50%;
        }
        .content-bubbles .shape-square {
            border-radius: 6px;
        }
        .content-bubbles .shape-diamond {
            border-radius: 6px;
            transform: rotate(45deg);
        }
        .content-bubbles .shape-triangle {
            width: 0 !important;
            height: 0 !important;
            background: transparent !important;
            border-left: 16px solid transparent;
            border-right: 16px solid transparent;
            border-bottom: 28px solid currentColor;
        }

        .content-bubbles .bubble:nth-child(3n+1) {
            background: rgba(220,53,69,0.55);
            color: rgba(220,53,69,0.55);
        }
        .content-bubbles .bubble:nth-child(3n+2) {
            background: rgba(25,135,84,0.55);
            color: rgba(25,135,84,0.55);
        }
        .content-bubbles .bubble:nth-child(3n+3) {
            background: rgba(13,110,253,0.55);
            color: rgba(13,110,253,0.55);
        }

        .content-bubbles .size-big {
            width: 44px;
            height: 44px;
        }
        .content-bubbles .size-medium {
            width: 28px;
            height: 28px;
        }
        .content-bubbles .size-small {
            width: 16px;
            height: 16px;
        }

        .content-bubbles .shape-triangle.size-big {
            border-left-width: 22px;
            border-right-width: 22px;
            border-bottom-width: 38px;
        }
        .content-bubbles .shape-triangle.size-medium {
            border-left-width: 16px;
            border-right-width: 16px;
            border-bottom-width: 28px;
        }
        .content-bubbles .shape-triangle.size-small {
            border-left-width: 10px;
            border-right-width: 10px;
            border-bottom-width: 17px;
        }

        .content-bubbles .bubble:nth-child(1)  { left: 2%;  animation-duration: 12s; animation-delay: 0s; }
        .content-bubbles .bubble:nth-child(2)  { left: 9%;  animation-duration: 14s; animation-delay: 0.5s; }
        .content-bubbles .bubble:nth-child(3)  { left: 16%; animation-duration: 15s; animation-delay: 1s; }
        .content-bubbles .bubble:nth-child(4)  { left: 23%; animation-duration: 11s; animation-delay: 1.5s; }
        .content-bubbles .bubble:nth-child(5)  { left: 30%; animation-duration: 16s; animation-delay: 2s; }
        .content-bubbles .bubble:nth-child(6)  { left: 37%; animation-duration: 13s; animation-delay: 2.5s; }
        .content-bubbles .bubble:nth-child(7)  { left: 44%; animation-duration: 17s; animation-delay: 3s; }
        .content-bubbles .bubble:nth-child(8)  { left: 51%; animation-duration: 12s; animation-delay: 0.8s; }
        .content-bubbles .bubble:nth-child(9)  { left: 58%; animation-duration: 15s; animation-delay: 1.8s; }
        .content-bubbles .bubble:nth-child(10) { left: 65%; animation-duration: 10s; animation-delay: 3.5s; }
        .content-bubbles .bubble:nth-child(11) { left: 72%; animation-duration: 14s; animation-delay: 1.2s; }
        .content-bubbles .bubble:nth-child(12) { left: 79%; animation-duration: 18s; animation-delay: 2.2s; }
        .content-bubbles .bubble:nth-child(13) { left: 86%; animation-duration: 13s; animation-delay: 0.3s; }
        .content-bubbles .bubble:nth-child(14) { left: 92%; animation-duration: 11s; animation-delay: 2.8s; }
        .content-bubbles .bubble:nth-child(15) { left: 96%; animation-duration: 16s; animation-delay: 1.4s; }
        .content-bubbles .bubble:nth-child(16) { left: 47%; animation-duration: 14s; animation-delay: 4s; }

        .content-bubbles .bubble:not(.down) {
            bottom: -80px;
            animation-name: bubbleFloatUp;
        }

        .content-bubbles .bubble.down {
            top: -80px;
            bottom: auto;
            animation-name: bubbleFloatDown;
        }

        @keyframes bubbleFloatUp {
            0% { transform: translateY(0) translateX(0) scale(1); opacity: 0; }
            10% { opacity: 0.6; }
            50% { transform: translateY(-160px) translateX(18px) scale(1.05); }
            90% { opacity: 0.35; }
            100% { transform: translateY(-360px) translateX(-12px) scale(0.9); opacity: 0; }
        }

        .content-bubbles .shape-diamond.bubble:not(.down) {
            animation-name: bubbleFloatUpDiamond;
        }
        @keyframes bubbleFloatUpDiamond {
            0% { transform: translateY(0) translateX(0) rotate(45deg) scale(1); opacity: 0; }
            10% { opacity: 0.6; }
            50% { transform: translateY(-160px) translateX(18px) rotate(45deg) scale(1.05); }
            90% { opacity: 0.35; }
            100% { transform: translateY(-360px) translateX(-12px) rotate(45deg) scale(0.9); opacity: 0; }
        }

        @keyframes bubbleFloatDown {
            0% { transform: translateY(0) translateX(0) scale(1); opacity: 0; }
            10% { opacity: 0.6; }
            50% { transform: translateY(160px) translateX(-18px) scale(1.05); }
            90% { opacity: 0.35; }
            100% { transform: translateY(360px) translateX(12px) scale(0.9); opacity: 0; }
        }

        .content-bubbles .shape-diamond.bubble.down {
            animation-name: bubbleFloatDownDiamond;
        }
        @keyframes bubbleFloatDownDiamond {
            0% { transform: translateY(0) translateX(0) rotate(45deg) scale(1); opacity: 0; }
            10% { opacity: 0.6; }
            50% { transform: translateY(160px) translateX(-18px) rotate(45deg) scale(1.05); }
            90% { opacity: 0.35; }
            100% { transform: translateY(160px) translateX(12px) rotate(45deg) scale(0.9); opacity: 0; }
        }

        @media (prefers-reduced-motion: reduce) {
            .content-bubbles .bubble {
                animation: none !important;
                display: none;
            }
        }

        /* ---- FULL PAGE CRACKER EFFECT ---- */
        .cracker-effect {
            position: fixed;
            inset: 0;
            width: 100vw;
            height: 100vh;
            z-index: 99999;
            pointer-events: none;
            overflow: hidden;
        }
        .cracker-burst {
            position: absolute;
            width: 12px;
            height: 12px;
        }
        .cracker-burst .spark {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 5px;
            height: 30px;
            border-radius: 50%;
            background: linear-gradient(to bottom, #ffffff, #ffd700, #ff9800, #ff4081);
            box-shadow: 0 0 6px #ffd700, 0 0 15px #ff9800, 0 0 25px #ff4081;
            transform-origin: 50% 100%;
            animation: fullPageCracker 1s ease-out forwards;
        }
        .cracker-burst::after {
            content: "✨";
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font-size: 25px;
            animation: crackerFlash 0.7s ease-out forwards;
        }
        @keyframes fullPageCracker {
            0%   { transform: translate(-50%, -50%) rotate(var(--angle)) translateY(0) scale(0.2); opacity: 1; }
            30%  { opacity: 1; }
            100% { transform: translate(-50%, -50%) rotate(var(--angle)) translateY(-100px) scale(0); opacity: 0; }
        }
        @keyframes crackerFlash {
            0%   { transform: translate(-50%, -50%) scale(0); opacity: 0; }
            30%  { transform: translate(-50%, -50%) scale(1.8); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(0.5); opacity: 0; }
        }

        /* ---- FINAL CLAP EFFECT ---- */
        .clap-effect {
            position: fixed;
            inset: 0;
            width: 100vw;
            height: 100vh;
            z-index: 999999;
            pointer-events: none;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.18);
            animation: clapBackground 2.2s ease forwards;
        }
        .clap-item {
            position: absolute;
            font-size: 70px;
            opacity: 0;
            filter: drop-shadow(0 0 8px rgba(255,193,7,0.9)) drop-shadow(0 0 20px rgba(255,111,60,0.8));
            animation: clapItemPop 0.7s ease-out forwards, clapItemShake 0.8s 0.7s ease-in-out;
        }
        .clap-item.small { font-size: 45px; }
        .clap-item.medium { font-size: 65px; }
        .clap-item.large { font-size: 90px; }

        @keyframes clapItemPop {
            0%   { transform: scale(0) rotate(-30deg); opacity: 0; }
            40%  { transform: scale(1.4) rotate(15deg); opacity: 1; }
            70%  { transform: scale(1) rotate(-8deg); opacity: 1; }
            100% { transform: scale(1) rotate(0deg); opacity: 1; }
        }
        @keyframes clapItemShake {
            0%, 100% { transform: rotate(0deg) scale(1); }
            20% { transform: rotate(-15deg) scale(1.08); }
            40% { transform: rotate(15deg) scale(1.08); }
            60% { transform: rotate(-12deg) scale(1.05); }
            80% { transform: rotate(10deg) scale(1.03); }
        }
        @keyframes clapBackground {
            0%   { background: rgba(255,255,255,0); }
            15%  { background: rgba(255,255,255,0.65); }
            35%  { background: rgba(255,215,0,0.18); }
            100% { background: rgba(255,255,255,0); }
        }

        .final-clap-message {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: min(90%, 700px);
            text-align: center;
            z-index: 1000000;
            padding: 25px 35px;
            border-radius: 25px;
            background: rgba(255,255,255,0.92);
            box-shadow: 0 20px 60px rgba(0,0,0,0.25), 0 0 40px rgba(255,193,7,0.45);
            animation: finalMessagePop 0.8s ease-out forwards;
        }
        .final-clap-message h2 {
            margin: 0;
            font-size: clamp(2rem, 5vw, 4rem);
            font-weight: 900;
            background: linear-gradient(90deg, #ff6f3c, #ff4081, #ffc107, #198754, #0d6efd, #ff6f3c);
            background-size: 400% 100%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: finalTextColor 3s linear infinite;
        }
        .final-clap-message p {
            margin-top: 10px;
            font-size: 1.2rem;
            font-weight: 800;
            color: #333;
        }
        @keyframes finalMessagePop {
            0%   { transform: translate(-50%, -50%) scale(0); opacity: 0; }
            60%  { transform: translate(-50%, -50%) scale(1.12); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(1); opacity: 1; }
        }
        @keyframes finalTextColor {
            0%   { background-position: 0% 50%; }
            100% { background-position: 400% 50%; }
        }
    </style>
</head>

<body>

<div class="bg-blob bg-blob-1"></div>
<div class="bg-blob bg-blob-2"></div>
<div class="bg-blob bg-blob-3"></div>
<header class="site-header">
    <div class="logo-left">
        <img src="<?= base_url('assets/Event_logo.png') ?>" alt="Left Logo">
    </div>
    <div class="header-title" id="headerTitle">Who's the Hero?</div>
    <div class="logo-right">
        <img src="<?= base_url('assets/logo.png') ?>" alt="Right Logo">
    </div>
</header>

<div class="auth-wrapper aut-bg-img-side cotainer-fiuid align-items-stretch" 
style="background-color: #758ec7;background-image: url('<?= base_url('assets/background_image.jpeg') ?>')">
    <div class="row align-items-center w-100 align-items-stretch">
        <div class="container-fluid py-2">
            <div class="content-bubbles">
                <span class="bubble shape-circle size-big"></span>
                <span class="bubble shape-square down size-medium"></span>
                <span class="bubble shape-diamond size-small"></span>
                <span class="bubble shape-triangle down size-big"></span>
                <span class="bubble shape-circle size-small"></span>
                <span class="bubble shape-square down size-big"></span>
                <span class="bubble shape-diamond size-medium"></span>
                <span class="bubble shape-triangle down size-small"></span>
                <span class="bubble shape-circle size-medium"></span>
                <span class="bubble shape-square down size-small"></span>
                <span class="bubble shape-diamond size-big"></span>
                <span class="bubble shape-triangle down size-medium"></span>
                <span class="bubble shape-circle size-small"></span>
                <span class="bubble shape-square down size-medium"></span>
                <span class="bubble shape-diamond size-big"></span>
                <span class="bubble shape-triangle down size-small"></span>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 col-sm-12 stat-col animate__animated animate__fadeInUp">
                    <div class="card stat-card shadow-sm" id="slideCard">
                        <div class="timer-countdown" id="timerCountdown">10</div>
                        <div class="progress-track">
                            <div class="progress-fill" id="progressFill"></div>
                        </div>
                        <div class="card-body stat-card-body text-center">
                            <div class="stat-icon-wrap icon-primary">
                                <img id="slideImage" src="" alt="" class="stat-img" style="height:400px;">
                            </div>
                        </div>
                        <div class="answer-choice">
                            <button type="button" class="btn-answer btn-right" id="choiceRight">
                                <i class="fa fa-check"></i> Right
                            </button>
                            <button type="button" class="btn-answer btn-wrong" id="choiceWrong">
                                <i class="fa fa-times"></i> Wrong
                            </button>
                        </div>
                    </div>

                   <div class="card shadow-sm" id="thankYouCard" style="display:none;">
                        <div class="card-body text-center" style="padding: 3rem 1rem;">
                            <div class="thank-you-icon animate__animated animate__bounceIn">
                                <svg viewBox="0 0 52 52" class="checkmark-svg">
                                    <circle class="checkmark-circle" cx="26" cy="26" r="24" fill="none"/>
                                    <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                                </svg>
                            </div>
                            <h3 class="animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">Thank You!</h3>
                            <p class="animate__animated animate__fadeInUp" style="animation-delay: 0.5s;color:black;font-weight:800;">You have viewed all the images.</p>
                            <div class="result-summary animate__animated animate__fadeInUp" style="animation-delay: 0.6s;">
                                <div class="result-pill total">Total: <span id="totalCount">0</span></div>
                                <div class="result-pill right">Right: <span id="rightCount">0</span></div>
                                <div class="result-pill wrong">Wrong: <span id="wrongCount">0</span></div>
                            </div>
                        </div>
                    </div>

                    <div id="slideCounter" class="text-center"></div>
                </div>

                <div class="col-md-4"></div>
            </div>

            <div class="col-12 text-center" style="margin-bottom: 1rem; margin-top: 1.5rem;">
                <a href="javascript:void(0);" onclick="goBackAndRefresh()" class="btn btn-primary">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>

            <!-- NEW: needed so saveAnswer() knows which category these answers belong to -->
            <input type="hidden" name="cid" id="cid" value="<?= isset($cid) ? (int) $cid : '' ?>" />

        </div>
    </div>
</div>

<!-- ---------- FOOTER ---------- -->
<footer class="site-footer">
    Developed by the Event's Team | © <?= date('Y') ?>. All Rights Reserved.
</footer>

<script>
function goBackAndRefresh() {
    window.location.href = document.referrer || '<?= base_url() ?>';
}

// Build image list from PHP data.
// NOTE: using $row->sid (the subcategory row's own primary key) so each
// image saves against a unique identifier, matching saveAnswer()'s lookup.
var slideImages = [
    <?php foreach ($imageList as $row) : ?>
        { id: <?= (int) $row->sid ?>, url: "<?= base_url('uploads/' . $row->web_image) ?>" },
    <?php endforeach; ?>
];

var currentIndex = 0;
var slideDurationSec = 10; // 10 seconds per image
var secondsLeft = slideDurationSec;
var countdownIntervalId = null;
var autoAdvanceTimeoutId = null;
var answers = new Array(slideImages.length).fill(null); // 'right' | 'wrong' | null
var slideStartTimestamp = null;
var answeredOnce = false; // guards against double-click on the same slide

var progressFillEl = document.getElementById('progressFill');
var choiceRightEl = document.getElementById('choiceRight');
var choiceWrongEl = document.getElementById('choiceWrong');
var timerCountdownEl = document.getElementById('timerCountdown');
var cidEl = document.getElementById('cid');
var slideImageEl = document.getElementById('slideImage');
var slideCardEl = document.getElementById('slideCard');

// Entrance animations to cycle through for the image, one per image
var entranceAnimations = [
    'slide-anim-right',
    'slide-anim-left',
    'slide-anim-top',
    'slide-anim-bottom',
    'slide-anim-zoom'
];

// NEW: entrance animations to cycle through for the whole box/card.
// Offset by 2 from the image cycle so the box and image don't always
// move in from the same direction on the same slide.
var boxAnimations = [
    'box-anim-left',
    'box-anim-bottom',
    'box-anim-zoom',
    'box-anim-right',
    'box-anim-top'
];

function applyEntranceAnimation(index) {
    // Remove any previous animation class
    entranceAnimations.forEach(function (cls) {
        slideImageEl.classList.remove(cls);
    });

    // Force reflow so the animation restarts even if the same class is reused
    void slideImageEl.offsetWidth;

    var animClass = entranceAnimations[index % entranceAnimations.length];
    slideImageEl.classList.add(animClass);
}

// NEW: apply an entrance animation to the whole card box
function applyBoxAnimation(index) {
    boxAnimations.forEach(function (cls) {
        slideCardEl.classList.remove(cls);
    });

    void slideCardEl.offsetWidth;

    var animClass = boxAnimations[index % boxAnimations.length];
    slideCardEl.classList.add(animClass);
}

function resetProgressBar() {
    progressFillEl.style.animation = 'none';
    void progressFillEl.offsetWidth; // force reflow to restart animation
    progressFillEl.style.animation = 'shrinkBar ' + (slideDurationSec * 1000) + 'ms linear forwards';
}

function updateCountdownDisplay() {
    timerCountdownEl.innerText = secondsLeft;
    if (secondsLeft <= 3) {
        timerCountdownEl.classList.add('is-low');
    } else {
        timerCountdownEl.classList.remove('is-low');
    }
}

function startCountdown() {
    clearInterval(countdownIntervalId);
    secondsLeft = slideDurationSec;
    updateCountdownDisplay();
    countdownIntervalId = setInterval(function () {
        secondsLeft--;
        if (secondsLeft < 0) {
            secondsLeft = 0;
        }
        updateCountdownDisplay();
    }, 1000);
}

function setChoiceButtonsEnabled(enabled) {
    choiceRightEl.disabled = !enabled;
    choiceWrongEl.disabled = !enabled;
}

function saveAnswerToServer(imageId, status, secondsUsed) {
    fetch('<?= base_url('save-answer') ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            image_id: imageId,
            status: status,
            time_taken: secondsUsed,
            cid: cidEl ? cidEl.value : null
        })
    })
    .then(function (res) { return res.json(); })
    .catch(function (err) {
        console.error('Failed to save answer:', err);
    });
}

function recordAnswer(status) {
    // Prevent double submission if the timer runs out right after a click
    if (answeredOnce) return;
    answeredOnce = true;

    answers[currentIndex] = status;

    var secondsUsed = Math.floor((Date.now() - slideStartTimestamp) / 1000);

    saveAnswerToServer(slideImages[currentIndex].id, status, secondsUsed);

    // RIGHT CLICK = CRACKER
    if (status === 'right') {
        showCrackerEffect();
    }

    setChoiceButtonsEnabled(false);
    clearInterval(countdownIntervalId);
    clearTimeout(autoAdvanceTimeoutId);

    // Brief pause so the cracker/feedback is visible before moving on
    autoAdvanceTimeoutId = setTimeout(function () {
        currentIndex++;
        showSlide(currentIndex);
    }, 500);
}

function autoAdvanceOnTimeout() {
    // Timer ran out with no answer chosen: record as unanswered ('wrong')
    if (answeredOnce) return;
    answeredOnce = true;

    answers[currentIndex] = null; // stays unanswered -> counted as wrong in results

    var secondsUsed = Math.floor((Date.now() - slideStartTimestamp) / 1000);
    saveAnswerToServer(slideImages[currentIndex].id, 'wrong', secondsUsed);

    setChoiceButtonsEnabled(false);

    autoAdvanceTimeoutId = setTimeout(function () {
        currentIndex++;
        showSlide(currentIndex);
    }, 300);
}

function showFinalResults() {
    var total = slideImages.length;
    var rightCount = 0;
    var wrongCount = 0;

    answers.forEach(function (a) {
        if (a === 'right') {
            rightCount++;
        } else {
            // unanswered images count as wrong
            wrongCount++;
        }
    });

    document.getElementById('totalCount').innerText = total;
    document.getElementById('rightCount').innerText = rightCount;
    document.getElementById('wrongCount').innerText = wrongCount;

    document.getElementById('slideCard').style.display = 'none';
    document.getElementById('slideCounter').style.display = 'none';
    document.getElementById('thankYouCard').style.display = 'flex';
    clearInterval(countdownIntervalId);
    clearTimeout(autoAdvanceTimeoutId);

    // CLAP effect once, on completion
    showClapEffect();
}

function showSlide(index) {
    if (index >= slideImages.length) {
        showFinalResults();
        return;
    }
    document.getElementById('slideImage').src = slideImages[index].url;
    document.getElementById('slideCounter').innerText = (index + 1) + ' / ' + slideImages.length;

    // Play a different entrance animation for each image
    applyEntranceAnimation(index);

    // NEW: play a different entrance animation for the whole box/card
    applyBoxAnimation(index);

    answeredOnce = false;
    setChoiceButtonsEnabled(true);
    slideStartTimestamp = Date.now();

    resetProgressBar();
    startCountdown();

    clearTimeout(autoAdvanceTimeoutId);
    autoAdvanceTimeoutId = setTimeout(autoAdvanceOnTimeout, slideDurationSec * 1000);
}

choiceRightEl.addEventListener('click', function () { recordAnswer('right'); });
choiceWrongEl.addEventListener('click', function () { recordAnswer('wrong'); });

// Init
if (slideImages.length > 0) {
    showSlide(currentIndex);
} else {
    showFinalResults();
}

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

function showCrackerEffect() {
    var container = document.createElement('div');
    container.className = 'cracker-effect';
    document.body.appendChild(container);

    var positions = [
        [5, 10], [15, 20], [35, 18], [45, 7], [65, 8], [75, 20], [95, 18],
        [8, 35], [20, 42], [45, 40], [58, 32], [82, 30], [94, 40],
        [5, 60], [18, 70], [42, 72], [55, 60], [80, 58], [94, 68],
        [8, 88], [20, 78], [50, 82], [65, 94], [90, 90]
    ];

    positions.forEach(function(position, index) {
        var burst = document.createElement('div');
        burst.className = 'cracker-burst';
        burst.style.left = position[0] + '%';
        burst.style.top = position[1] + '%';

        var angles = [0, 30, 60, 90, 120, 150, 180, 210, 240, 270, 300, 330];

        angles.forEach(function(angle) {
            var spark = document.createElement('span');
            spark.className = 'spark';
            spark.style.setProperty('--angle', angle + 'deg');
            spark.style.animationDelay = (index * 0.025) + 's';
            burst.appendChild(spark);
        });

        container.appendChild(burst);
    });

    setTimeout(function() {
        container.remove();
    }, 2200);
}

function showClapEffect() {
    var clap = document.createElement('div');
    clap.className = 'clap-effect';
    document.body.appendChild(clap);

    var positions = [
        [5, 8], [18, 15], [48, 13], [63, 6], [93, 8],
        [8, 28], [24, 35], [62, 30], [91, 34],
        [5, 48], [18, 55], [95, 45],
        [10, 70], [25, 65], [60, 68], [90, 66],
        [5, 90], [20, 82], [50, 86], [65, 95], [95, 92]
    ];

    positions.forEach(function(position, index) {
        var item = document.createElement('div');
        item.className = 'clap-item';

        if (index % 3 === 0) {
            item.classList.add('large');
        } else if (index % 3 === 1) {
            item.classList.add('medium');
        } else {
            item.classList.add('small');
        }

        item.innerHTML = '👏';
        item.style.left = position[0] + '%';
        item.style.top = position[1] + '%';
        item.style.animationDelay = (index * 0.035) + 's';

        clap.appendChild(item);
    });

    var message = document.createElement('div');
    message.className = 'final-clap-message';
    message.innerHTML = `
        <h2>🎉 Excellent! 🎉</h2>
        <p>All Images Completed!</p>
    `;

    clap.appendChild(message);
    setTimeout(function () {
        clap.remove();
    }, 3500);
}
</script>

<!-- JS -->
<script src="<?= base_url('assets/js/vendor-all.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>

</body>
</html>