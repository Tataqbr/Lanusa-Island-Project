@extends('layouts.guest')

@section('title', 'Elite Concierge Services | Lanusa Island')

@section('content')
    {{-- 1. LUXURY HEADER --}}
    <section class="relative pt-50 pb-24 bg-[#012a2c] overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px] relative z-20">
            <div class="max-w-4xl space-y-8" data-aos="fade-right">
                <div class="flex items-center gap-4">
                    <span class="w-12 h-[1px] bg-brand-gold"></span>
                    <span class="text-brand-gold font-black text-[10px] tracking-[0.5em] uppercase">Member Exclusivity</span>
                </div>
                <h1 class="font-serif text-white text-[45px] lg:text-[80px] leading-[1.1] font-bold">
                    Personalized <br> <span class="italic font-light text-brand-gold">Hospitality.</span>
                </h1>
                <p class="text-gray-300 text-lg lg:text-2xl font-light leading-relaxed max-w-2xl">
                    Dedicated to our members. Our concierge team ensures that every stay across the PT Raga Nusa Property portfolio is seamless, private, and exceptional.
                </p>
            </div>
        </div>
        {{-- Subtle Gold Pattern Overlay --}}
        <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: url('https://www.transparenttextures.com/patterns/pinstriped-suit.png');"></div>
    </section>

    {{-- 2. THE THREE PILLARS OF SERVICE --}}
    <section class="py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16 lg:gap-24">
                <div class="space-y-6" data-aos="fade-up">
                    <div class="text-brand-gold text-4xl font-serif italic">01.</div>
                    <h4 class="text-brand-primary font-black text-xs tracking-widest uppercase">Travel Planning</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">From flight coordination to inter-island transfers, we handle the logistics of your journey before you even leave home.</p>
                </div>
                <div class="space-y-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-brand-gold text-4xl font-serif italic">02.</div>
                    <h4 class="text-brand-primary font-black text-xs tracking-widest uppercase">In-Resort Requests</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Private chefs, spa reservations, or celebratory arrangements. Your villa will be prepared exactly to your specifications.</p>
                </div>
                <div class="space-y-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-brand-gold text-4xl font-serif italic">03.</div>
                    <h4 class="text-brand-primary font-black text-xs tracking-widest uppercase">Priority Access</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">As a member, you receive preferred seating at partner restaurants and exclusive entry to local cultural events.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. INTERACTIVE SERVICE HIGHLIGHT --}}
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="relative" data-aos="fade-right">
                    <img src="{{ asset('assets/img/concierge.avif') }}" class="w-full h-[600px] object-cover rounded-sm shadow-2xl">
                    <div class="absolute -bottom-10 -right-10 bg-brand-primary p-12 hidden lg:block border-l-8 border-brand-gold shadow-2xl">
                        <p class="text-white font-serif text-2xl italic">"Expect nothing <br> short of perfection."</p>
                    </div>
                </div>
                <div class="space-y-12" data-aos="fade-left">
                    <div class="space-y-4">
                        <span class="text-brand-gold font-black text-[11px] tracking-[0.4em] uppercase">White Glove Service</span>
                        <h2 class="font-serif text-4xl lg:text-6xl text-brand-primary font-bold leading-tight">Your Digital <br> Butler.</h2>
                    </div>
                    <div class="space-y-8">
                        <div class="flex gap-6 pb-8 border-b border-gray-200">
                            <span class="text-2xl">📱</span>
                            <div>
                                <h5 class="text-brand-primary font-bold uppercase tracking-widest text-xs mb-2">Instant Communication</h5>
                                <p class="text-gray-500 text-sm">Direct access to our concierge via WhatsApp or our secure Member Portal for real-time assistance.</p>
                            </div>
                        </div>
                        <div class="flex gap-6 pb-8 border-b border-gray-200">
                            <span class="text-2xl">🥂</span>
                            <div>
                                <h5 class="text-brand-primary font-bold uppercase tracking-widest text-xs mb-2">Bespoke Experiences</h5>
                                <p class="text-gray-500 text-sm">Customized itineraries built by local experts who understand the hidden gems of Indonesia.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <span class="text-2xl">🛡️</span>
                            <div>
                                <h5 class="text-brand-primary font-bold uppercase tracking-widest text-xs mb-2">Institutional Support</h5>
                                <p class="text-gray-500 text-sm">Every request is backed by the management integrity of PT Raga Nusa Property.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        {{-- 5. FINAL CALL TO ACTION
    <section class="py-24 bg-brand-primary">
        <div class="container mx-auto px-6 lg:px-[70px] text-center space-y-10">
            <h2 class="font-serif text-3xl lg:text-5xl text-white font-bold leading-tight max-w-4xl mx-auto">
                "We don't just provide rooms; we provide a life of extraordinary moments."
            </h2>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="#" class="bg-brand-gold text-brand-primary font-black px-12 py-5 text-[11px] uppercase tracking-[0.4em] hover:bg-white transition shadow-xl">Go to Dashboard</a>
                <a href="#" class="border border-white text-white font-black px-12 py-5 text-[11px] uppercase tracking-[0.4em] hover:bg-white hover:text-black transition">Emergency Support</a>
            </div>
        </div>
    </section> --}}

    {{-- 4. CONTACT CHANNELS (HIGH CONTRAST) --}}
    <section class="py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px] text-center space-y-16">
            <div class="max-w-2xl mx-auto space-y-4">
                <h2 class="font-serif text-3xl lg:text-5xl font-bold text-brand-primary">How May We Assist You?</h2>
                <p class="text-gray-500 uppercase tracking-widest text-[10px] font-black">Members-Only Access Channels</p>
            </div>

            <div class="grid grid-cols-1 gap-12 w-[400px] mx-auto">
               
                <a href="mailto:admin@lanusa-island.com" class="p-10 border-2 border-brand-primary hover:bg-brand-primary group transition-all duration-500 flex flex-col items-center space-y-4">
                    <span class="text-3xl group-hover:scale-110 transition-transform">✉️</span>
                    <h4 class="text-brand-primary group-hover:text-black font-black text-xs tracking-widest uppercase">Official Request</h4>
                    <p class="text-gray-400 group-hover:text-black/60 text-sm uppercase font-bold tracking-tighter">Send an Email Inquiry</p>
                </a>
            </div>
        </div>
    </section>


@endsection