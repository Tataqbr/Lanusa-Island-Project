<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('assets/icon.png') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
            scroll-behavior: smooth;
        }

        h1, h2, h3, h4, h5, .font-serif {
            font-family: 'Playfair Display', serif;
        }

        :root {
            --brand-primary: #014547; 
            --brand-secondary: #026669; 
            --brand-gold: #c5a358; 
            --brand-light: #f4fdfa;
        }

        .bg-brand-primary { background-color: var(--brand-primary); }
        .text-brand-primary { color: var(--brand-primary); }
        .border-brand-primary { border-color: var(--brand-primary); }
        .text-brand-gold { color: var(--brand-gold); }
        .bg-brand-gold { background-color: var(--brand-gold); }
    </style>
</head>

<body class="overflow-x-hidden bg-white text-gray-900">
    {{-- NAVIGATION --}}
    <nav class="hidden lg:flex items-center justify-between w-full lg:px-[70px] px-[20px] py-5 fixed bg-white/95 backdrop-blur-md z-[100] border-b border-gray-100 shadow-sm">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/logo.png') }}" alt="Lanusa Island Logo" class="w-[180px]">
        </a>

        <div class="flex gap-x-10 items-center">
            <a href="{{ route('home') }}" class="text-[13px] font-black tracking-[0.2em] text-gray-800 hover:text-brand-primary transition-colors">HOME</a>
            <a href="{{ route('destinations') }}" class="text-[13px] font-black tracking-[0.2em] text-gray-800 hover:text-brand-primary transition-colors">DESTINATIONS</a>
            <a href="{{ route('memberships') }}" class="text-[13px] font-black tracking-[0.2em] text-gray-800 hover:text-brand-primary transition-colors">MEMBERSHIP</a>
            <a href="{{ route('about-us') }}" class="text-[13px] font-black tracking-[0.2em] text-gray-800 hover:text-brand-primary transition-colors">ABOUT US</a>
            <a href="{{ route('contact') }}" class="text-[13px] font-black tracking-[0.2em] text-gray-800 hover:text-brand-primary transition-colors">CONTACT</a>
        </div>

        {{-- <div class="flex gap-x-6 items-center">
            <a href="" class="text-[12px] font-extrabold text-brand-primary tracking-widest hover:text-brand-secondary transition">SIGN IN</a>
            <a href="" class="text-[12px] font-bold text-white bg-brand-primary px-8 py-3.5 rounded-sm shadow-md hover:bg-brand-secondary transition-all transform hover:-translate-y-0.5">BECOME A MEMBER</a>
        </div> --}}
    </nav>

    {{-- MOBILE NAVIGATION --}}
    <nav x-data="{ open: false }" class="lg:hidden fixed top-0 left-0 w-full bg-white z-[100] shadow-sm">
        <div class="flex justify-between items-center px-6 py-5">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="w-[100px]">
            </a>
            <button @click="open = true" class="text-brand-primary focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="fixed inset-0 w-full h-full bg-white z-[110] p-8 flex flex-col">
            
            <div class="flex justify-between items-center mb-16">
                <img src="{{ asset('assets/logo.png') }}" class="w-[120px]" alt="Logo">
                <button @click="open = false" class="text-brand-primary focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="flex flex-col space-y-8 text-lg font-bold text-brand-primary tracking-widest">
                <a href="{{ route('home') }}" @click="open = false">HOME</a>
                <a href="{{ route('destinations') }}" @click="open = false">DESTINATIONS</a>
                <a href="{{ route('memberships') }}" @click="open = false">MEMBERSHIP</a>
                <a href="{{ route('about-us') }}" @click="open = false">ABOUT US</a>
                <a href="{{ route('contact') }}" @click="open = false">CONTACT</a>
            </div>

            {{-- <div class="mt-10 flex flex-col gap-4">
                <a href="" class="text-md w-full py-5 text-center bg-brand-primary text-white font-bold rounded-sm uppercase tracking-widest shadow-lg">BECOME A MEMBER</a>
                <a href="" class="text-md w-full py-5 text-center border-2 border-brand-primary text-brand-primary font-bold rounded-sm uppercase tracking-widest">SIGN IN</a>
            </div> --}}
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- PROFESSIONAL FOOTER --}}
  <footer class="bg-[#012a2c] text-white pt-24 pb-12 border-t-4 border-brand-gold">
    <div class="max-w-7xl mx-auto px-6 lg:px-[70px]">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 mb-20">
            
            {{-- Column 1: Brand Profile --}}
            <div class="lg:col-span-4 space-y-8">
                <img src="{{ asset('assets/logo.png') }}" alt="Lanusa Island" class="w-[120px] lg:w-[200px] brightness-0 invert">
                <p class="text-gray-300 text-base leading-relaxed pr-6">
                    Lanusa Island is professionally managed by PT Raga Nusa Property. We bring a new gold standard to flexible vacation ownership, providing secure and premium lifestyle assets for the modern family.
                </p>
            </div>

            {{-- Column 2: Discover --}}
            <div class="lg:col-span-2">
                <h5 class="text-brand-gold font-black text-[11px] tracking-[0.3em] uppercase mb-8 border-b border-white/10 pb-4">DISCOVER</h5>
                <ul class="space-y-4 text-sm font-medium">
                    <li><a href="{{ route('collections') }}" class="text-gray-300 hover:text-brand-gold transition">Our Collections</a></li>
                    <li><a href="{{ route('memberships') }}" class="text-gray-300 hover:text-brand-gold transition">Membership Plans</a></li>
                    <li><a href="{{ route('legal') }}" class="text-gray-300 hover:text-brand-gold transition">Legal & Security</a></li>
                </ul>
            </div>

            {{-- Column 3: Support --}}
            <div class="lg:col-span-2">
                <h5 class="text-brand-gold font-black text-[11px] tracking-[0.3em] uppercase mb-8 border-b border-white/10 pb-4">SUPPORT</h5>
                <ul class="space-y-4 text-sm font-medium">
                    <li><a href="{{ route('faq') }}" class="text-gray-300 hover:text-brand-gold transition">Help Center (FAQ)</a></li>
                    <li><a href="{{ route('concierge') }}" class="text-gray-300 hover:text-brand-gold transition">Contact Concierge</a></li>
                    <li><a href="{{ route('terms') }}" class="text-gray-300 hover:text-brand-gold transition">Terms of Service</a></li>
                    <li><a href="{{ route('privacy') }}" class="text-gray-300 hover:text-brand-gold transition">Privacy Policy</a></li>
                </ul>
            </div>

            {{-- Column 4: Payment & Trust --}}
            <div class="lg:col-span-4">
                <div class="bg-white/5 p-8 rounded-sm border border-white/10 shadow-2xl">
                    <h5 class="text-white font-bold text-lg mb-4">Payment Security</h5>
                    <p class="text-gray-400 text-xs mb-6 leading-relaxed">
                        All transactions are processed via encrypted institutional-grade payment gateways. We do not store sensitive cardholder data.
                    </p>
                    
                    {{-- Payment Icons (Direct SVG for Reliability) --}}
                    <div class="flex flex-wrap gap-3 opacity-80 mb-8">
                        {{-- Visa --}}
                        <div class="h-8 px-3 flex items-center bg-white rounded-sm">
                            <svg class="h-3" viewBox="0 0 24 8" xmlns="http://www.w3.org/2000/svg"><path d="M11.3 0l-1.5 6.8h1.6l1.5-6.8h-1.6zm-5.4 0L3.4 4.7 2.8 1.4c-.1-.7-.7-1.4-1.5-1.4H0l.1.3c1 .2 1.9.6 2.5 1.2L4.2 6.8h1.7L8.5 0H5.9zm10.7 4.9c0-1.8-2.5-1.9-2.5-2.7 0-.3.2-.6.7-.6h1.2l.2.8h1.5l-1.5-2.4H15c-1.3 0-2.2.7-2.2 1.7 0 1.8 2.5 1.9 2.5 2.8 0 .3-.3.6-.8.6h-1.3l-.3-.9H11.5l1.6 2.5h1.4c1.3 0 2.1-.7 2.1-1.9zM24 0h-1.5l-2.6 6.8h1.6l.3-.9h1.9l.2.9H24l-1.5-6.8zm-1.8 4.6l.6-1.7.4 1.7h-1z" fill="#1434CB"/></svg>
                        </div>
                        {{-- Mastercard --}}
                        <div class="h-8 px-3 flex items-center bg-white rounded-sm">
                            <svg class="h-5" viewBox="0 0 24 15" xmlns="http://www.w3.org/2000/svg"><circle cx="7" cy="7.5" r="7" fill="#EB001B"/><circle cx="17" cy="7.5" r="7" fill="#F79E1B" fill-opacity=".8"/><path d="M12 7.5a6.9 6.9 0 012.6-5.4 6.9 6.9 0 00-5.2 0 6.9 6.9 0 010 10.8 6.9 6.9 0 005.2 0A6.9 6.9 0 0112 7.5z" fill="#FF5F00"/></svg>
                        </div>
                        {{-- GPN/Bank Transfer Placeholder --}}
                        <div class="h-8 px-2 flex items-center bg-white/10 border border-white/20 rounded-sm text-[9px] font-black tracking-tighter">BANK TRANSFER</div>
                        <div class="h-8 px-2 flex items-center bg-white/10 border border-white/20 rounded-sm text-[9px] font-black tracking-tighter">QRIS</div>
                    </div>

                    <div class="flex items-center gap-3 text-[10px] text-brand-gold font-black uppercase tracking-widest border-t border-white/10 pt-6">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        PCI-DSS Compliant System
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom Section --}}
        <div class="border-t border-white/10 pt-12 flex justify-center md:justify-start">
            <div class="text-[10px] text-gray-400 tracking-[0.2em] font-bold uppercase text-center md:text-left leading-relaxed">
                © 2026 Lanusa Island. A Premium Asset by <span class="text-white font-black">PT Raga Nusa Property</span>.
            </div>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  AOS.init({
    // Menonaktifkan animasi jika lebar layar kurang dari 1024px (Mobile & Tablet)
    disable: function() {
      return window.innerWidth < 1024;
    },
    duration: 1000,
    once: true,
  });
</script>
</body>
</html>