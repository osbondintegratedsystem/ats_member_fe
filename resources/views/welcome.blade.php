<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ATS MEMBER | Osbond Gym </title>

    <link rel="icon" href="{{ asset('assets/logo-01.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800;900&family=Barlow:wght@400;500;600&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --red: #D42B2B;
            --red-dark: #A81E1E;
            --dark: #0d0d0d;
            --white: #ffffff;
            --gray: rgba(255, 255, 255, 0.5);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
            overflow: hidden;
        }

        body {
            font-family: 'Barlow', sans-serif;
            background: var(--dark);
            color: var(--white);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            background:
                radial-gradient(ellipse 70% 55% at 50% 110%, rgba(170, 18, 18, 0.4) 0%, transparent 65%),
                #0d0d0d;
        }

        .bg::after {
            content: '';
            position: absolute;
            bottom: -15%;
            left: 50%;
            transform: translateX(-50%);
            width: 560px;
            height: 260px;
            border-radius: 50%;
            background: radial-gradient(ellipse, rgba(212, 43, 43, 0.22) 0%, transparent 70%);
            animation: breathe 5s ease-in-out infinite alternate;
        }

        @keyframes breathe {
            from {
                transform: translateX(-50%) scale(0.92);
                opacity: 0.6;
            }

            to {
                transform: translateX(-50%) scale(1.1);
                opacity: 1;
            }
        }

        .bg-stripes {
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image: repeating-linear-gradient(-55deg,
                    transparent, transparent 48px,
                    rgba(255, 255, 255, 0.011) 48px, rgba(255, 255, 255, 0.011) 49px);
            pointer-events: none;
        }

        .corner {
            position: fixed;
            bottom: 0;
            right: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 0 90px 90px;
            border-color: transparent transparent var(--red) transparent;
            opacity: 0.13;
            z-index: 1;
        }

        .wrap {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 0 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo {
            margin-bottom: 36px;
            animation: up 0.7s ease-out 0.1s both;
        }

        .logo img {
            height: 72px;
            width: auto;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 4.5px;
            text-transform: uppercase;
            color: var(--red);
            margin-bottom: 18px;
            animation: up 0.7s ease-out 0.2s both;
        }

        .eyebrow::before,
        .eyebrow::after {
            content: '';
            display: block;
            width: 28px;
            height: 2px;
            background: var(--red);
        }

        h1 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(72px, 15vw, 128px);
            font-weight: 900;
            line-height: 0.87;
            text-transform: uppercase;
            letter-spacing: -2px;
            margin-bottom: 28px;
            animation: up 0.7s ease-out 0.3s both;
        }

        h1 .solid {
            display: block;
            color: var(--white);
        }

        h1 .hollow {
            display: block;
            -webkit-text-stroke: 2px rgba(212, 43, 43, 0.6);
            color: transparent;
        }

        .line {
            width: 48px;
            height: 2px;
            background: var(--red);
            margin-bottom: 28px;
            animation: up 0.7s ease-out 0.35s both;
        }

        .tagline {
            font-size: 15px;
            font-weight: 400;
            color: var(--gray);
            line-height: 1.75;
            max-width: 380px;
            margin-bottom: 48px;
            animation: up 0.7s ease-out 0.4s both;
        }

        .btn-login {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--white);
            background: var(--red);
            border: none;
            padding: 16px 52px;
            text-decoration: none;
            display: inline-block;
            clip-path: polygon(10px 0%, 100% 0%, calc(100% - 10px) 100%, 0% 100%);
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 0 36px rgba(212, 43, 43, 0.3);
            animation: up 0.7s ease-out 0.5s both;
        }

        .btn-login:hover {
            background: var(--red-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 40px rgba(212, 43, 43, 0.45);
        }

        .footer {
            position: fixed;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.13);
            z-index: 10;
        }

        @keyframes up {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .logo img {
                height: 56px;
            }
        }
    </style>
</head>

<body>

    <div class="bg"></div>
    <div class="bg-stripes"></div>
    <div class="corner"></div>

    <div class="wrap">

        <div class="logo">
            <img src="{{ asset('assets/logo-01.png') }}" alt="Osbond Gym">
        </div>

        <div class="eyebrow">Member Portal</div>

        <h1>
            <span class="solid">ATS</span>
            <span class="hollow">MEMBER</span>
        </h1>

        <div class="line"></div>

        <p class="tagline">
            Platform of Osbond Gym.<br>
            Please login to be continue.
        </p>

        <a href="{{ route('login') }}" class="btn-login">Login</a>

    </div>

    <p class="footer">© 2026 Osbond Gym · atsmember.osbondgym.com</p>

</body>

</html>