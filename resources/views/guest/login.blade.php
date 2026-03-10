@extends('layouts.guest')

@section('title', 'Member Login | Lanusa Island Portal')

@section('content')
    <section class="relative h-screen flex flex-col lg:flex-row overflow-hidden bg-white items-center">
        
        {{-- LEFT SIDE: VISUAL BRANDING (Hidden on Mobile) --}}
        <div class="relative lg:w-1/2 h-full hidden lg:flex items-center justify-center overflow-hidden bg-brand-primary">
            <img src="{{ asset('assets/img/login.avif') }}" 
                 class="absolute inset-0 w-full h-full object-cover opacity-40 grayscale-[0.5] scale-110 animate-pulse duration-[10000ms]" alt="Luxury Resort">
            
            <div class="relative z-20 p-20 space-y-8 text-left" data-aos="fade-right">
                <div class="inline-block px-4 py-1 border border-brand-gold text-brand-gold text-[10px] tracking-[0.4em] uppercase font-black">
                    Private Access
                </div>
                <h2 class="font-serif text-white text-5xl font-bold leading-tight">
                    Welcome Back to <br> <span class="text-brand-gold italic">The Club.</span>
                </h2>
                <div class="w-20 h-[1px] bg-brand-gold"></div>
                <p class="text-gray-300 text-lg font-light leading-relaxed max-w-md">
                    Access your exclusive membership dashboard to manage stays, view new estates, and connect with your personal concierge.
                </p>
                <div class="pt-10 flex flex-col space-y-2">
                    <p class="text-[10px] text-white/40 uppercase tracking-[0.2em] font-bold">Managed by</p>
                    <p class="text-white font-serif text-xl opacity-80">PT Raga Nusa Property</p>
                </div>
            </div>
            
            {{-- Aesthetic Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-brand-primary via-transparent to-transparent"></div>
        </div>

        {{-- RIGHT SIDE: LOGIN FORM --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center mt-30 lg:mt-50 p-8 lg:p-24 bg-white relative">
            <div class="max-w-md w-full space-y-10" data-aos="fade-up">
                
                <div class="space-y-4">
                    <h3 class="font-serif text-3xl lg:text-4xl font-bold text-brand-primary uppercase tracking-tighter">Sign In</h3>
                    <p class="text-gray-500 text-sm">Please enter your institutional credentials to proceed.</p>
                </div>

                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <label for="email" class="text-[10px] font-black text-brand-primary uppercase tracking-widest">Email Address</label>
                            <input type="email" id="email" name="email" required 
                                   class="w-full p-4 bg-gray-50 border border-gray-100 focus:border-brand-gold focus:bg-white outline-none text-sm transition duration-300 rounded-sm"
                                   placeholder="e.g. member@legacy.com">
                        </div>
                        
                        <div class="space-y-1">
                            <div class="flex justify-between items-center">
                                <label for="password" class="text-[10px] font-black text-brand-primary uppercase tracking-widest">Password</label>
                                <a href="#" class="text-[10px] text-brand-gold font-bold uppercase tracking-widest hover:text-brand-primary transition">Forgot?</a>
                            </div>
                            <input type="password" id="password" name="password" required 
                                   class="w-full p-4 bg-gray-50 border border-gray-100 focus:border-brand-gold focus:bg-white outline-none text-sm transition duration-300 rounded-sm"
                                   placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <input type="checkbox" id="remember" class="w-4 h-4 border-gray-300 text-brand-primary focus:ring-brand-gold rounded-sm cursor-pointer">
                        <label for="remember" class="text-xs text-gray-500 cursor-pointer select-none">Remember this device for 30 days</label>
                    </div>

                    <div class="pt-4 space-y-6">
                        <button type="submit" 
                                class="w-full bg-brand-primary text-white font-black py-5 text-[11px] uppercase tracking-[0.3em] hover:bg-brand-gold hover:shadow-2xl transition-all duration-300 shadow-xl rounded-sm">
                            Authorize Access
                        </button>
                        
                        <div class="relative flex items-center justify-center">
                            <div class="w-full border-t border-gray-100"></div>
                            <span class="absolute bg-white px-4 text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em]">New to Lanusa?</span>
                        </div>

                        <a href="{{ route('register') }}" 
                           class="block w-full text-center border-2 border-brand-primary text-brand-primary font-black py-5 text-[11px] uppercase tracking-[0.3em] hover:bg-brand-primary hover:text-white transition-all rounded-sm">
                            Become a Member
                        </a>
                    </div>
                </form>

                {{-- Legal Footer --}}
                <div class="pt-12 text-center">
                    <p class="text-[9px] text-gray-400 uppercase tracking-widest leading-relaxed">
                        Secure Encryption Active. <br>
                        © 2025 PT Raga Nusa Property. All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection