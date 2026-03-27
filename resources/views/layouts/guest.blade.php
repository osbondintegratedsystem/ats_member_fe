<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ATS MEMBER | @yield('title', 'Login')</title>
    
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

        /* Background: dark + red spotlight */
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

        .guest-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 400px;
            padding: 40px 30px;
            background: var(--dark-2);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
            text-align: center;
            animation: fadeUp 0.6s ease-out both;
        }

        .brand-bar {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 30px;
        }

        .brand-name {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--white);
        }

        .brand-name span { color: var(--red); }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--gray);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-control {
            width: 100%;
            background: var(--dark-3);
            border: 1px solid rgba(255,255,255,0.1);
            color: var(--white);
            padding: 12px 16px;
            border-radius: 6px;
            font-family: 'Barlow', sans-serif;
            font-size: 15px;
            transition: all 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--red);
            box-shadow: 0 0 0 3px var(--red-glow);
        }

        .btn-primary {
            width: 100%;
            background: var(--red);
            color: var(--white);
            border: none;
            padding: 14px;
            border-radius: 6px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background: var(--red-dark);
            transform: translateY(-2px);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
    @stack('styles')
</head>
<body>

    <div class="bg-layer"></div>
    <div class="bg-stripes"></div>
    <div class="corner-br"></div>
    <div class="corner-tl"></div>

    <div class="guest-card">
        <div class="brand-bar">
            <!-- <div class="brand-name">ATS <span>MEMBER</span></div> -->
            <img src="{{ asset('assets/logo-01.png') }}" alt="ATS Member Logo" style="max-height: 60px; width: auto; object-fit: contain;">
        </div>
        
        @yield('content')
    </div>

</body>
</html>
