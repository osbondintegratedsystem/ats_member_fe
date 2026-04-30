<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ATS MEMBER | @yield('title', 'Dashboard')</title>

    <!-- Favicon (Browser Tab Logo) -->
    <link rel="icon" href="{{ asset('assets/logo-01.png') }}" type="image/png">

    <!-- Google Fonts: Barlow Condensed & Barlow -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800;900&family=Barlow:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS 4 via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --red: #D42B2B;
            --red-dark: #A81E1E;
            --red-glow: rgba(212, 43, 43, 0.35);
            --dark: #0d0d0d;
            --dark-2: #1a1a1a;
            --dark-3: #242424;
            --white: #ffffff;
            --gray: rgba(255, 255, 255, 0.7);
            --gray-dim: rgba(255, 255, 255, 0.12);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Barlow', sans-serif;
            background-color: var(--dark);
            color: var(--white);
            margin: 0;
            display: flex;
            min-height: 100vh;
        }

        /* Background: dark + red spotlight */
        .bg-layer {
            position: fixed;
            inset: 0;
            z-index: 0;
            background:
                radial-gradient(ellipse 70% 60% at 50% 110%, rgba(180, 20, 20, 0.2) 0%, transparent 70%),
                #0d0d0d;
            pointer-events: none;
        }

        /* Diagonal stripe texture */
        .bg-stripes {
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image: repeating-linear-gradient(-55deg,
                    transparent,
                    transparent 40px,
                    rgba(255, 255, 255, 0.01) 40px,
                    rgba(255, 255, 255, 0.01) 41px);
            pointer-events: none;
        }

        /* Layout */
        .sidebar {
            width: 260px;
            background: rgba(26, 26, 26, 0.8);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            padding: 24px 0;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 20;
        }

        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 30px 40px;
            position: relative;
            z-index: 10;
        }

        /* Sidebar Brand */
        .sidebar-brand {
            padding: 0 24px;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
        }

        .brand-name {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--white);
        }

        .brand-name span {
            color: var(--red);
        }

        /* Sidebar Menu */
        .menu-title {
            padding: 0 24px;
            font-size: 11px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.3);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 12px;
            margin-top: 24px;
        }

        .menu-list {
            list-style: none;
        }

        .menu-item {
            margin-bottom: 4px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            color: var(--gray);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .menu-link:hover,
        .menu-link.active {
            color: var(--white);
            background: rgba(255, 255, 255, 0.03);
            border-left-color: var(--red);
        }

        /* Common Components */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding-bottom: 20px;
        }

        .page-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 36px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-primary {
            background: var(--red);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            background: var(--red-dark);
        }

        .card {
            background: var(--dark-2);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 20px;
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
            border: 1px solid rgba(255, 255, 255, 0.1);
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
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.4);
            padding: 12px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        td {
            padding: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: var(--gray);
            font-size: 15px;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: rgba(255, 255, 255, 0.02);
            color: var(--white);
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .badge-green {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .badge-red {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        /* === FORM LAYOUT SYSTEM (NEW) === */
        .form-layout {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .form-row {
            display: flex;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 12px;
            /* override dari 20px */
            flex: 1;
        }

        .form-actions {
            margin-top: auto;
        }

        .btn-full {
            width: 100%;
        }
    </style>
    @stack('styles')
</head>

<body>

    <div class="bg-layer"></div>
    <div class="bg-stripes"></div>

    <aside class="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('assets/logo-03.png') }}" alt="ATS Member Logo"
                style="width: 100%; max-height: 120px; object-fit: contain;">
        </div>

        <div class="menu-title">Main</div>
        <ul class="menu-list">
            <li class="menu-item"><a href="{{ url('/checkin') }}"
                    class="menu-link {{ request()->is('checkin') ? 'active' : '' }}">Checkin & Checkout</a></li>
            <li class="menu-item"><a href="{{ url('/members') }}"
                    class="menu-link {{ request()->is('members') ? 'active' : '' }}">List Member</a></li>
            <li class="menu-item"><a href="{{ url('/recap') }}"
                    class="menu-link {{ request()->is('recap') ? 'active' : '' }}">Recap Daily Checkin</a></li>
        </ul>

        <div class="menu-title">Administration</div>
        <ul class="menu-list">
            <li class="menu-item"><a href="{{ url('/admin/users') }}"
                    class="menu-link {{ request()->is('admin/users') ? 'active' : '' }}">Master User</a></li>
            <li class="menu-item"><a href="{{ url('/admin/clubs') }}"
                    class="menu-link {{ request()->is('admin/clubs') ? 'active' : '' }}">Master Club</a></li>
        </ul>

        <div class="menu-title">Settings</div>
        <ul class="menu-list">
            <li class="menu-item"><a href="{{ url('/change-password') }}"
                    class="menu-link {{ request()->is('change-password') ? 'active' : '' }}">Change Password</a></li>
            <li class="menu-item"><a href="{{ url('/login') }}" class="menu-link">Logout</a></li>
        </ul>
    </aside>

    <main class="main-content">
        @yield('content')
    </main>

</body>

</html>