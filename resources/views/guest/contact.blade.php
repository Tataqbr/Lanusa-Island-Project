@extends('layouts.guest')

@section('title', 'Contact Our Concierge | Lanusa Island')

@section('content')
    {{-- 1. LUXURY HEADER --}}
    <section class="relative pt-50 pb-24 bg-brand-primary overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px] relative z-20">
            <div class="max-w-4xl space-y-8" data-aos="fade-right">
                <div class="flex items-center gap-4">
                    <span class="w-12 h-[1px] bg-brand-gold"></span>
                    <span class="text-brand-gold font-black text-[10px] tracking-[0.5em] uppercase">Connect With Us</span>
                </div>
                <h1 class="font-serif text-white text-[45px] lg:text-[80px] leading-[1.1] font-bold">
                    At Your <br> <span class="italic font-light text-brand-gold">Service.</span>
                </h1>
                <p class="text-gray-300 text-lg lg:text-2xl font-light leading-relaxed max-w-2xl">
                    Whether you are inquiring about a new membership or planning your next annual stay, our dedicated team is here to assist.
                </p>
            </div>
        </div>
         {{-- Elegant subtle watermark --}}
        <div class="absolute bottom-0 right-0 opacity-[0.03] pointer-events-none">
            <h2 class="text-[300px] font-serif font-bold text-white -mb-20">LANUSA</h2>
        </div>
    </section>

    {{-- 2. CONTACT HUB SECTION --}}
    <section class="py-24 lg:py-32 bg-white">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-8">
                
                {{-- Direct Line --}}
                <div class="p-10 border border-gray-100 space-y-6 hover:shadow-2xl transition-all duration-500 group" data-aos="fade-up">
                    <div class="w-12 h-12 rounded-full border border-brand-gold flex items-center justify-center text-brand-gold group-hover:bg-brand-gold group-hover:text-brand-primary transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h4 class="text-brand-primary font-black text-xs tracking-widest uppercase">Institutional Inquiries</h4>
                    <p class="font-serif text-2xl font-bold text-brand-primary">+62 21 1234 5678</p>
                    <p class="text-gray-500 text-sm leading-relaxed">Available Monday — Friday<br>09:00 AM to 06:00 PM (GMT+7)</p>
                </div>

                {{-- Email Support --}}
                <div class="p-10 border border-gray-100 space-y-6 hover:shadow-2xl transition-all duration-500 group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 rounded-full border border-brand-gold flex items-center justify-center text-brand-gold group-hover:bg-brand-gold group-hover:text-brand-primary transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 01-2-2H5a2 2 0 00-2 2v10a2 2 0 02 2z" />
                        </svg>
                    </div>
                    <h4 class="text-brand-primary font-black text-xs tracking-widest uppercase">Digital Concierge</h4>
                    <p class="font-serif text-xl font-bold text-brand-primary break-words">admin@lanusa-island.com</p>
                    <p class="text-gray-500 text-sm leading-relaxed">Average response time: <br>Within 24 business hours.</p>
                </div>

                {{-- Global HQ --}}
                <div class="p-10 border border-gray-100 space-y-6 hover:shadow-2xl transition-all duration-500 group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 rounded-full border border-brand-gold flex items-center justify-center text-brand-gold group-hover:bg-brand-gold group-hover:text-brand-primary transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h4 class="text-brand-primary font-black text-xs tracking-widest uppercase">Corporate Headquarters</h4>
                    <p class="font-serif text-lg font-bold text-brand-primary leading-tight">Eccos Plaza Bali, Unit	L3,	Lantai 3, Jalan	Sunset Road	No.	77 B, Lingkungan Abianbase,	Desa/Kelurahan Kuta, Kec. Kuta,	Kab. Badung, Provinsi Bali.</p>
                    <p class="text-gray-500 text-sm leading-relaxed">PT Raga Nusa Property <br>Level 45, Treasury Tower.</p>
                </div>

            </div>
        </div>
    </section>

    {{-- 3. DEPARTMENT DIRECTORY (NEW PROFESSIONAL CONTENT) --}}
    {{-- <section class="py-24 bg-gray-50 overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="flex flex-col lg:flex-row gap-16 items-start">
                <div class="lg:w-1/3 space-y-6" data-aos="fade-right">
                    <h2 class="font-serif text-4xl font-bold text-brand-primary leading-tight">Specific <br> Inquiries.</h2>
                    <p class="text-gray-500 font-light">Direct your message to the appropriate department for faster executive processing.</p>
                </div>
                <div class="lg:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-8" data-aos="fade-left">
                    <div class="bg-white p-8 border-l-2 border-brand-gold space-y-2">
                        <h5 class="text-brand-primary font-black text-[10px] uppercase tracking-widest">Membership Acquisitions</h5>
                        <p class="text-sm text-gray-500">acquisition@lanusaisland.com</p>
                    </div>
                    <div class="bg-white p-8 border-l-2 border-brand-gold space-y-2">
                        <h5 class="text-brand-primary font-black text-[10px] uppercase tracking-widest">Property Partnerships</h5>
                        <p class="text-sm text-gray-500">partnership@raganusa.com</p>
                    </div>
                    <div class="bg-white p-8 border-l-2 border-brand-gold space-y-2">
                        <h5 class="text-brand-primary font-black text-[10px] uppercase tracking-widest">Legal & Compliance</h5>
                        <p class="text-sm text-gray-500">legal@raganusa.com</p>
                    </div>
                    <div class="bg-white p-8 border-l-2 border-brand-gold space-y-2">
                        <h5 class="text-brand-primary font-black text-[10px] uppercase tracking-widest">Media & Press</h5>
                        <p class="text-sm text-gray-500">press@lanusaisland.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- 4. MAP PREVIEW SECTION --}}
    <section class="relative h-[400px] lg:h-[600px] bg-gray-200">
        {{-- Map placeholder - integrate Google Maps iframe here if needed --}}
        <div class="absolute inset-0 grayscale contrast-125 opacity-70">
            <img src="{{ asset('assets/img/contact-lanusa.avif') }}" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-brand-primary/20"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-white p-8 lg:p-12 shadow-2xl rounded-sm max-w-sm text-center space-y-4" data-aos="zoom-in">
                <h4 class="font-serif text-2xl font-bold text-brand-primary uppercase tracking-tighter">Visit the Gallery</h4>
                <p class="text-gray-500 text-sm">Experience the Lanusa Island model in person at our Jakarta Flagship Office.</p>
                <a href="https://maps.app.goo.gl/hpt65PZJk4voMFGk6" class="inline-block bg-brand-primary text-white font-black px-8 py-4 text-[10px] uppercase tracking-widest hover:bg-brand-gold transition">Open in Maps</a>
            </div>
        </div>
    </section>

    {{-- 5. FINAL CORPORATE STATEMENT --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6 lg:px-[70px] text-center space-y-12">
            <div class="max-w-3xl mx-auto space-y-6">
                <h2 class="font-serif text-3xl lg:text-5xl font-bold text-brand-primary leading-tight">Institutional Support <br> <span class="text-brand-gold italic">By PT Raga Nusa Property.</span></h2>
                <p class="text-gray-500 text-lg font-light leading-relaxed">
                    Our commitment to our members is lifelong. Every inquiry is handled with the discretion and professionalism that defines our brand heritage.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="{{ route('memberships') }}" class="bg-brand-primary text-white font-black px-12 py-5 text-[11px] uppercase tracking-[0.3em] hover:bg-brand-primary hover:text-white transition">View All Plans</a>
            </div>
        </div>
    </section>
@endsection