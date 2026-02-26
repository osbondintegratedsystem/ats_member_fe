<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coming Soon | OSBOND ATS</title>
    
    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS 4 via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --mesh-color-1: oklch(0.6 0.15 280); /* Deep Blue */
            --mesh-color-2: oklch(0.65 0.2 320); /* Purpleish */
            --mesh-color-3: oklch(0.5 0.18 20);  /* Deep Red/Orange */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #050505;
            overflow: hidden;
        }

        .mesh-gradient {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: 
                radial-gradient(at 10% 20%, var(--mesh-color-1) 0px, transparent 50%),
                radial-gradient(at 90% 10%, var(--mesh-color-2) 0px, transparent 50%),
                radial-gradient(at 50% 90%, var(--mesh-color-3) 0px, transparent 50%);
            filter: blur(100px);
            opacity: 0.6;
            animation: meshMove 20s ease-in-out infinite alternate;
        }

        @keyframes meshMove {
            0% { transform: scale(1) translate(0, 0); }
            50% { transform: scale(1.1) translate(-5%, 5%); }
            100% { transform: scale(1) translate(5%, -5%); }
        }

        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        .heading-outfit {
            font-family: 'Outfit', sans-serif;
        }

        .fade-in {
            animation: fadeIn 1.2s ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .glow-text {
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen text-white antialiased">
    <div class="mesh-gradient"></div>

    <div class="max-w-2xl w-full px-6 text-center z-10">
        <div class="glass p-12 lg:p-16 rounded-[2.5rem] fade-in relative overflow-hidden">
            <!-- Subtle Radial Overlay -->
            <div class="absolute inset-0 bg-radial-at-t from-white/5 to-transparent pointer-events-none"></div>

            <!-- Logo / Brand -->
            <div class="mb-10 inline-flex items-center justify-center space-x-2">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-500 to-purple-600 flex items-center justify-center shadow-lg shadow-blue-500/20">
                    <span class="text-xl font-bold tracking-tighter">O</span>
                </div>
                <span class="text-2xl font-semibold tracking-tight heading-outfit glow-text">OSBOND <span class="text-blue-400">ATS</span></span>
            </div>

            <h2 class="text-blue-400 text-sm font-bold uppercase tracking-[0.3em] mb-4 heading-outfit">Exciting things are on the way</h2>
            <h1 class="text-5xl lg:text-7xl font-bold mb-8 heading-outfit tracking-tight leading-tight">
                COMING <br>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-white via-white to-white/40">SOON</span>
            </h1>
            
            <p class="text-white/60 text-lg leading-relaxed mb-10 max-w-lg mx-auto font-medium">
                We're building a more powerful and intelligent recruitment experience. Stay tuned for the unveiling of atsmember.osbondxxx.com.
            </p>

            <!-- Newsletter Sim (Premium Input Style) -->
            <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto relative group">
                <div class="relative flex-grow">
                    <input type="email" placeholder="Enter your email" class="w-full h-14 bg-white/5 border border-white/10 rounded-2xl px-6 outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all text-white placeholder-white/30 font-medium">
                </div>
                <button class="h-14 px-8 bg-white text-black font-bold rounded-2xl hover:bg-blue-400 hover:text-white transition-all transform hover:scale-[1.02] active:scale-[0.98] shadow-xl shadow-white/5">
                    Notify Me
                </button>
            </div>

            <!-- Social / Footer Mentions -->
            <div class="mt-12 pt-12 border-t border-white/5 flex items-center justify-center space-x-8 text-white/30 text-sm">
                <a href="#" class="hover:text-blue-400 transition-colors">Twitter</a>
                <a href="#" class="hover:text-blue-400 transition-colors">LinkedIn</a>
                <a href="#" class="hover:text-blue-400 transition-colors">Instagram</a>
            </div>
        </div>

        <p class="mt-8 text-white/20 text-xs tracking-widest uppercase">© 2026 OSBOND INTEGRATED SYSTEM. ALL RIGHTS RESERVED.</p>
    </div>
</body>
</html>
