<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ATS MEMBER | Coming Soon</title>
    
    <!-- Favicon (Browser Tab Logo) -->
    <link rel="icon" href="{{ asset('assets/logo-01.png') }}" type="image/png">

    <!-- Google Fonts: Barlow Condensed & Barlow -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800;900&family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS 4 via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --red:       #D42B2B;
            --red-dark:  #A81E1E;
            --red-glow:  rgba(212, 43, 43, 0.35);
            --dark:      #0d0d0d;
            --dark-2:    #1a1a1a;
            --dark-3:    #242424;
            --white:     #ffffff;
            --gray:      rgba(255,255,255,0.55);
            --gray-dim:  rgba(255,255,255,0.12);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Barlow', sans-serif;
            background-color: var(--dark);
            color: var(--white);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* ── Background: dark + red spotlight ── */
        .bg-layer {
            position: fixed;
            inset: 0;
            z-index: 0;
            background:
                radial-gradient(ellipse 70% 60% at 50% 110%, rgba(180, 20, 20, 0.45) 0%, transparent 70%),
                radial-gradient(ellipse 40% 30% at 20% 0%, rgba(255,255,255,0.03) 0%, transparent 60%),
                #0d0d0d;
        }

        .bg-layer::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 300px;
            background: radial-gradient(ellipse, rgba(212,43,43,0.3) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse 4s ease-in-out infinite alternate;
        }

        @keyframes pulse {
            0%   { opacity: 0.5; transform: translateX(-50%) scale(1); }
            100% { opacity: 1;   transform: translateX(-50%) scale(1.15); }
        }

        /* Diagonal stripe texture */
        .bg-stripes {
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image: repeating-linear-gradient(
                -55deg,
                transparent,
                transparent 40px,
                rgba(255,255,255,0.012) 40px,
                rgba(255,255,255,0.012) 41px
            );
            pointer-events: none;
        }

        /* Corner accents */
        .corner-br {
            position: fixed;
            bottom: 0; right: 0;
            width: 0; height: 0;
            border-style: solid;
            border-width: 0 0 120px 120px;
            border-color: transparent transparent var(--red) transparent;
            opacity: 0.15;
            z-index: 1;
        }
        .corner-tl {
            position: fixed;
            top: 0; left: 0;
            width: 0; height: 0;
            border-style: solid;
            border-width: 80px 80px 0 0;
            border-color: var(--red) transparent transparent transparent;
            opacity: 0.1;
            z-index: 1;
        }

        /* ── Main card ── */
        .card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 700px;
            padding: 0 24px;
            text-align: center;
        }

        /* ── Brand ── */
        .brand-bar {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 48px;
            animation: fadeUp 0.9s ease-out 0.1s both;
        }

        .brand-logo {
            width: 50px;
            height: 50px;
            background: var(--red);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 24px;
            font-weight: 900;
            color: white;
            box-shadow: 0 0 28px var(--red-glow);
        }

        .brand-name {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--white);
        }

        .brand-name span { color: var(--red); }

        /* ── Eyebrow ── */
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--red);
            margin-bottom: 20px;
            animation: fadeUp 0.9s ease-out 0.2s both;
        }

        .eyebrow::before,
        .eyebrow::after {
            content: '';
            display: block;
            width: 36px;
            height: 2px;
            background: var(--red);
        }

        /* ── Heading ── */
        .heading {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(80px, 16vw, 140px);
            font-weight: 900;
            line-height: 0.88;
            text-transform: uppercase;
            letter-spacing: -2px;
            margin-bottom: 40px;
            animation: fadeUp 0.9s ease-out 0.3s both;
        }

        .heading .line-white { color: var(--white); display: block; }
        .heading .line-outline {
            display: block;
            -webkit-text-stroke: 2px var(--red);
            color: transparent;
        }

        /* ── Countdown ── */
        .countdown {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-bottom: 44px;
            animation: fadeUp 0.9s ease-out 0.4s both;
        }

        .cd-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .cd-num {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(36px, 6vw, 52px);
            font-weight: 900;
            color: var(--white);
            line-height: 1;
            min-width: 76px;
            text-align: center;
            background: var(--dark-2);
            border: 1px solid rgba(255,255,255,0.07);
            border-bottom: 3px solid var(--red);
            padding: 14px 8px 12px;
            border-radius: 6px;
            letter-spacing: 2px;
        }

        .cd-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.4);
        }

        .cd-sep {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 44px;
            font-weight: 900;
            color: var(--red);
            align-self: flex-start;
            margin-top: 14px;
            line-height: 1;
        }

        /* ── Red divider ── */
        .divider {
            width: 60px;
            height: 3px;
            background: var(--red);
            margin: 0 auto 32px;
            animation: fadeUp 0.9s ease-out 0.45s both;
        }

        /* ── Description ── */
        .description {
            font-size: 16px;
            font-weight: 400;
            color: var(--gray);
            line-height: 1.8;
            max-width: 500px;
            margin: 0 auto 44px;
            animation: fadeUp 0.9s ease-out 0.5s both;
        }

        .description strong {
            color: var(--white);
            font-weight: 600;
        }

        /* ── Social links ── */
        .socials {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            animation: fadeUp 0.9s ease-out 0.55s both;
        }

        .social-link {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.45);
            text-decoration: none;
            padding: 10px 20px;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 4px;
            transition: all 0.2s;
        }

        .social-link:hover {
            color: var(--white);
            border-color: var(--red);
            background: rgba(212,43,43,0.12);
        }

        /* ── Footer ── */
        .footer-copy {
            position: fixed;
            bottom: 22px;
            left: 0; right: 0;
            text-align: center;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.15);
            z-index: 10;
        }

        /* ── Animation ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 480px) {
            .cd-num { min-width: 58px; padding: 10px 4px 8px; }
            .countdown { gap: 8px; }
            .cd-sep { font-size: 32px; margin-top: 10px; }
        }
    </style>
</head>
<body>

    <div class="bg-layer"></div>
    <div class="bg-stripes"></div>
    <div class="corner-br"></div>
    <div class="corner-tl"></div>

    <div class="card">

        <!-- Brand -->
        <div class="brand-bar">
            <img src="{{ asset('assets/logo-01.png') }}" alt="ATS Member Logo" style="max-height: 80px; width: auto; object-fit: contain;">
        </div>

        <!-- Eyebrow -->
        <div class="eyebrow">Lorem Ipsum is simply dummy text</div>

        <!-- Heading -->
        <h1 class="heading">
            <span class="line-white">COMING</span>
            <span class="line-outline">SOON</span>
        </h1>

        <!-- Countdown -->
        <!-- <div class="countdown">
            <div class="cd-item">
                <div class="cd-num" id="days">00</div>
                <div class="cd-label">Days</div>
            </div>
            <div class="cd-sep">:</div>
            <div class="cd-item">
                <div class="cd-num" id="hours">00</div>
                <div class="cd-label">Hours</div>
            </div>
            <div class="cd-sep">:</div>
            <div class="cd-item">
                <div class="cd-num" id="minutes">00</div>
                <div class="cd-label">Minutes</div>
            </div>
            <div class="cd-sep">:</div>
            <div class="cd-item">
                <div class="cd-num" id="seconds">00</div>
                <div class="cd-label">Seconds</div>
            </div>
        </div> -->

        <!-- Divider -->
        <div class="divider"></div>

        <!-- Description -->
        <p class="description">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. <strong>atsmember.osbondgym.com</strong>
        </p>

        <!-- Socials -->
        <!-- <div class="socials">
            <a href="#" class="social-link">Twitter</a>
            <a href="#" class="social-link">LinkedIn</a>
            <a href="#" class="social-link">Instagram</a>
        </div> -->

    </div>

    <p class="footer-copy">© 2026 Osbond Gym. All Rights Reserved.</p>

    <script>
        // Set your launch date here
        const target = new Date('2026-07-01T00:00:00');

        function pad(n) { return String(n).padStart(2, '0'); }

        function tick() {
            const diff = target - new Date();
            if (diff <= 0) {
                ['days','hours','minutes','seconds'].forEach(id => {
                    document.getElementById(id).textContent = '00';
                });
                return;
            }
            document.getElementById('days').textContent    = pad(Math.floor(diff / 86400000));
            document.getElementById('hours').textContent   = pad(Math.floor((diff % 86400000) / 3600000));
            document.getElementById('minutes').textContent = pad(Math.floor((diff % 3600000) / 60000));
            document.getElementById('seconds').textContent = pad(Math.floor((diff % 60000) / 1000));
        }

        tick();
        setInterval(tick, 1000);
    </script>

</body>
</html>