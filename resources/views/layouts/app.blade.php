<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{-- <title>{{ $title ?? config('app.name') }}</title> --}}
        <title>Pemberkatan Nikah Erik & Darsini</title>


        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles


        <!-- SEO Meta Tags -->
        <meta name="author" content="Erik">
        <meta name="title" content="Erik & Darsini | Undangan Pernikahan">
        <meta name="description" content="Pemberkatan Nikah & Resepsi Pernikahan Erik & Darsini">
        <meta property="og:title" content="Erik & Darsini | Undangan Pernikahan">
        <meta property="og:description" content="Pemberkatan Nikah & Resepsi Pernikahan Erik & Darsini">
        <meta property="og:image" content="{{ asset('images/1.jpeg') }}">
        <meta property="og:type" content="website">

        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png')}}">
        
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">

        <!-- Fonts & FontAwesome -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Josefin+Sans:ital,wght@0,300;0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: {
                            brand: {
                                50: '#fdf8f6',
                                100: '#f2e8e5',
                                500: '#e0a996',
                                800: '#8c5040',
                                900: '#4a2820',
                            }
                        },
                        fontFamily: {
                            serif: ['Josefin Sans', 'sans-serif'],
                            esthetic: ['Alex Brush', 'cursive']
                        }
                    }
                }
            }
        </script>

        <!-- GSAP CDN -->
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js"></script>

       
        <style type="text/tailwindcss">
            @layer utilities {
                .bg-overlay {
                    @apply bg-black/40 backdrop-blur-xs;
                }
            }
            ::-webkit-scrollbar {
                width: 5px;
            }
            ::-webkit-scrollbar-track {
                background: rgba(0, 0, 0, 0.05);
            }
            ::-webkit-scrollbar-thumb {
                background: rgba(224, 169, 150, 0.5);
                border-radius: 10px;
            }

            .heart-particle {
                position: fixed;
                pointer-events: none;
                z-index: 9999;
                animation: floatUp 2.5s ease-out forwards;
            }
            @keyframes floatUp {
                0% {
                    opacity: 1;
                    transform: translateY(0) scale(0.8) rotate(0deg);
                }
                50% {
                    opacity: 0.8;
                    transform: translateY(-100vh) scale(1.2) rotate(180deg);
                }
                100% {
                    opacity: 0;
                    transform: translateY(-180vh) scale(0.5) rotate(360deg);
                }
            }

            :root {
                --paper: #fffaf5;
                --paper-2: #f8efe7;
                --ink: #51443f;
                --muted: #8b7b73;
                --gold: #c69b58;
                --rose: #d59b88;
                --line: rgba(198,155,88,.28);
            }

            body {
                background:
                    radial-gradient(circle at 15% 10%, rgba(214,174,126,.12), transparent 28%),
                    radial-gradient(circle at 85% 30%, rgba(213,155,136,.10), transparent 30%),
                    linear-gradient(180deg, #fffdf9 0%, #fbf4ed 48%, #fffaf6 100%);
            }

            html.dark body {
                background: #0c0a09;
            }

            body::before {
                content: "";
                position: fixed;
                inset: 0;
                pointer-events: none;
                z-index: 1;
                opacity: .22;
                background-image: radial-gradient(rgba(92,68,55,.16) .55px, transparent .55px);
                background-size: 7px 7px;
                mix-blend-mode: multiply;
            }

            html.dark body::before {
                opacity: .05;
            }

            #root { position: relative; z-index: 2; }

            .gold-dust {
                position: absolute;
                width: 5px; height: 5px;
                border-radius: 50%;
                background: rgba(198,155,88,.65);
                box-shadow: 0 0 14px rgba(198,155,88,.35);
                animation: dustFloat 5s ease-in-out infinite;
                pointer-events: none;
            }
            @keyframes dustFloat {
                0%,100% { opacity:.15; transform: translate3d(0,12px,0) scale(.7); }
                50% { opacity:.85; transform: translate3d(8px,-18px,0) scale(1); }
            }

            .ring-decor {
                width: 94px; height: 94px;
                border: 1px solid rgba(198,155,88,.45);
                border-radius: 50%;
                position: absolute;
                pointer-events:none;
            }
            .ring-decor::before, .ring-decor::after {
                content:"";
                position:absolute;
                inset:9px;
                border:1px dashed rgba(213,155,136,.4);
                border-radius:50%;
            }
            .ring-decor::after {
                inset:25px;
                border-style:solid;
                border-color: rgba(198,155,88,.3);
            }
            .ring-spin { animation: ringSpin 18s linear infinite; }
            @keyframes ringSpin { to { transform: rotate(360deg); } }

            .wedding-seal {
                width: 64px; height:64px;
                border-radius:50%;
                display:flex; align-items:center; justify-content:center;
                border:1px solid rgba(198,155,88,.55);
                background: rgba(255,250,245,.8);
                box-shadow: inset 0 0 0 4px rgba(198,155,88,.07), 0 8px 20px rgba(96,65,48,.08);
                color: var(--gold);
                position: relative;
            }
            html.dark .wedding-seal {
                background: rgba(28, 25, 23, 0.8);
            }
            .wedding-seal::after {
                content:"";
                position:absolute;
                inset:4px;
                border:1px dashed rgba(198,155,88,.45);
                border-radius:50%;
            }

            .motion-section {
                transform-style: preserve-3d;
                perspective: 1200px;
                overflow: hidden;
            }
            .motion-card {
                transform-style: preserve-3d;
                transition: box-shadow .4s ease, border-color .4s ease;
            }

            .section-kicker {
                display:inline-flex;
                align-items:center;
                gap:.55rem;
                color:#b18448;
                font-size:10px;
                letter-spacing:.22em;
                text-transform:uppercase;
            }
            .section-kicker::before,.section-kicker::after {
                content:"";
                width:22px;height:1px;background:rgba(198,155,88,.55);
            }

            .event-icon {
                width:42px;height:42px;
                border-radius:50%;
                display:flex;align-items:center;justify-content:center;
                margin:0 auto 10px;
                color:#b18448;
                border:1px solid rgba(198,155,88,.35);
                background:rgba(255,255,255,.8);
                box-shadow:0 8px 22px rgba(87,61,48,.07);
            }
            html.dark .event-icon {
                background: rgba(28, 25, 23, 0.8);
            }

            .countdown-tile {
                position:relative;
                overflow:hidden;
                transform-style:preserve-3d;
            }
            .countdown-tile::after {
                content:"";
                position:absolute;
                width:30px;height:30px;
                border-radius:50%;
                right:-13px;top:-13px;
                background:rgba(213,155,136,.13);
            }

            .gallery-item {
                transform-style:preserve-3d;
                transition: transform .5s cubic-bezier(.2,.8,.2,1), box-shadow .5s ease;
            }
            .gallery-item:hover {
                transform: translateY(-5px) rotateX(2deg) rotateY(-2deg);
                box-shadow:0 15px 30px rgba(0, 0, 0, 0.2);
            }

            .floating-heart {
                position:absolute;
                color:rgba(198,155,88,.38);
                animation: heartFloat 7s ease-in-out infinite;
                pointer-events:none;
            }
            @keyframes heartFloat {
                0%,100% { transform:translateY(8px) rotate(-8deg); opacity:.25; }
                50% { transform:translateY(-16px) rotate(8deg); opacity:.7; }
            }

            @keyframes floatSlow {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-8px) rotate(3deg); }
            }
            .animate-float-slow {
                animation: floatSlow 6s ease-in-out infinite;
            }

            .reveal-motion { opacity:0; transform:translateY(28px) scale(.985); }
            .reveal-motion.revealed { opacity:1; transform:none; }

            @media (prefers-reduced-motion: reduce) {
                *,*::before,*::after { animation-duration:.001ms !important; animation-iteration-count:1 !important; scroll-behavior:auto !important; transition-duration:.001ms !important; }
                .reveal-motion { opacity:1; transform:none; }
            }
        </style>

    </head>
    <body class="font-serif bg-stone-100 text-stone-800 dark:bg-stone-950 dark:text-stone-200 antialiased selection:bg-brand-500 selection:text-white transition-colors duration-300 relative overflow-x-hidden">
        {{ $slot }}

        @livewireScripts
    </body>
</html>
