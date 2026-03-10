@extends('layouts.guest')

@section('title', 'Lanusa Island | Premium Vacation Ownership & Management')

@section('content')
    {{-- 1. HERO SECTION (RETAINED) --}}
    <div class="relative w-full flex items-center overflow-hidden h-max py-30 lg:h-screen lg:py-0">
        <img src="{{ asset('assets/img/home.jpg') }}" alt="Lanusa Hero"
            class="absolute inset-0 w-full h-full object-cover scale-105">
        <div class="absolute inset-0 bg-black/50 z-10"></div>

        <div class="relative z-20 container mx-auto px-6 lg:px-[70px]" data-aos="fade-right">
            <div class="max-w-[850px] space-y-8">
                <div
                    class="inline-block px-4 py-1 border border-white text-white text-[11px] tracking-[0.4em] uppercase font-extrabold bg-white/20">
                    Official Property of PT Raga Nusa Property
                </div>
                <h1 class="font-serif text-white text-[50px] lg:text-[85px] leading-[1.05] font-bold drop-shadow-2xl">
                    The Art of <br> <span class="text-brand-gold">Smart</span> Ownership.
                </h1>
                <p class="text-gray-100 text-lg lg:text-2xl max-w-[650px] font-light leading-relaxed drop-shadow-md">
                    Experience Indonesia's most coveted destinations with a flexible ownership model designed for the modern
                    legacy.
                </p>
                <div class="flex flex-wrap gap-6 pt-6">
                    <a href="{{ route('memberships') }}"
                        class="bg-white text-brand-primary font-bold px-12 py-5 text-[13px] uppercase tracking-widest hover:scale-105 transition-all shadow-[0_20px_50px_rgba(197,163,88,0.3)]">
                        Become a Member
                    </a>
                    <a href="{{ route('destinations') }}"
                        class="bg-brand-primary text-white font-bold px-12 py-5 text-[13px] uppercase tracking-widest hover:scale-105 transition-all shadow-[0_20px_50px_rgba(197,163,88,0.3)]">
                        Explore Resorts
                    </a>
                </div>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex flex-col items-center space-y-3">
            <div class="w-[1px] h-16 bg-gradient-to-b from-transparent via-brand-gold to-brand-gold animate-bounce"></div>
            <span class="text-white/70 text-[10px] tracking-[0.5em] uppercase font-bold">Scroll</span>
        </div>
    </div>

    {{-- 2. ABOUT US SECTION --}}
    <section class="py-24 lg:py-40 bg-white">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-20 items-center">
                <div class="lg:col-span-6 relative" data-aos="zoom-in">
                    <div class="relative z-10 p-4 border border-gray-100 bg-white shadow-2xl">
                        <img src="{{ asset('assets/img/home-about.jpg') }}" alt="Luxury Interior"
                            class="w-full h-auto object-cover">
                    </div>

                </div>

                <div class="lg:col-span-6 space-y-10" data-aos="fade-left">
                    <div class="space-y-4">
                        <span class="text-brand-gold font-bold text-[12px] tracking-[0.4em] uppercase block">Elite
                            Management</span>
                        <h2 class="font-serif text-4xl lg:text-6xl text-brand-primary font-bold leading-tight">Integrity in
                            Every <br> Square Meter</h2>
                    </div>
                    <div class="space-y-6 text-gray-600 text-lg leading-relaxed">
                        <p class="font-medium text-brand-primary">"Luxury is not about ownership; it's about the freedom to
                            experience."</p>
                        <p>Under the stewardship of PT Raga Nusa Property, Lanusa Island ensures that your investment is
                            backed by legal transparency and world-class asset management. We take care of the maintenance,
                            so you can focus on the memories.</p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-10 pt-8 border-t border-gray-100">
                        <div class="flex items-center gap-4">
                            <span class="text-4xl font-serif text-brand-gold font-bold">15+</span>
                            <span
                                class="text-[11px] text-gray-400 uppercase tracking-widest font-bold leading-tight">Curated
                                <br> Destinations</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-4xl font-serif text-brand-gold font-bold">100%</span>
                            <span class="text-[11px] text-gray-400 uppercase tracking-widest font-bold leading-tight">Legal
                                <br> Guaranteed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. DESTINATIONS CATALOG WITH PRICING --}}
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="flex flex-col lg:flex-row justify-between items-end mb-16 gap-6">
                <div class="space-y-4 text-left">
                    <span class="text-brand-gold font-bold text-xs tracking-[0.4em] uppercase">Signature Collection</span>
                    <h2 class="font-serif text-4xl lg:text-5xl text-brand-primary font-bold">The Premier Destinations</h2>
                </div>
                <a href="{{ route('destinations') }}"
                    class="group flex items-center gap-3 text-brand-primary font-bold text-xs uppercase tracking-widest border-b-2 border-brand-gold pb-2 transition-all">
                    View All Resorts
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($featuredResorts as $fr)
                    @php
                        $resortImages = json_decode($fr->images, true);
                        $displayImage =
                            is_array($resortImages) && count($resortImages) > 0 ? $resortImages[0] : 'default.jpg';

                        $priceInIdr = number_format($fr->price, 0, ',', '.');
                    @endphp
                    <div class="group bg-white overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 rounded-sm"
                        data-aos="fade-up">
                        <div class="relative overflow-hidden aspect-[4/5]">
                            <img src="{{ asset('assets/resorts/' . $displayImage) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div
                                class="absolute top-4 right-4 bg-brand-primary text-white px-4 py-2 text-xs font-bold tracking-widest">
                                FROM Rp{{ $priceInIdr }} / NIGHT
                            </div>
                        </div>
                        <div class="p-8 space-y-4 text-left">
                            <div class="flex justify-between items-start">
                                <h4 class="text-brand-primary font-serif text-2xl font-bold">{{ $fr->name }}</h4>
                                <span
                                    class="text-brand-gold font-bold text-[10px] tracking-widest uppercase">{{ $fr->region }}</span>
                            </div>
                            <p class="text-gray-500 text-sm leading-relaxed">{{ $fr->description }}</p>
                            <div class="pt-4 flex items-center justify-between border-t border-gray-50">
                                <span
                                    class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">{{ $fr->destination }}</span>
                                <a href="{{ route('resort-detail', $fr->slug) }}"
                                    class="text-brand-primary font-bold text-xs uppercase tracking-widest hover:text-brand-gold transition">Details
                                    &rarr;</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    {{-- 5. CONTACT & SUPPORT SECTION (REFINED) --}}
    <section class="py-24 bg-brand-primary text-white border-b-4 border-brand-gold">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                {{-- Ditambahkan lg: agar AOS hanya aktif di layar besar --}}
                <div class="space-y-10 text-left" data-aos="fade-right" data-aos-disable-mobile="true">
                    <div class="space-y-4">
                        <span class="text-brand-gold font-bold text-xs tracking-[0.5em] uppercase">Get In Touch</span>
                        <h2 class="font-serif text-5xl lg:text-7xl font-bold leading-tight text-white">Ready to Own <br>
                            Your <span class="text-brand-gold italic">Holidays?</span></h2>
                    </div>
                    <p class="text-gray-300 text-xl leading-relaxed max-w-lg">Our professional consultants are standing by
                        to guide you through your holiday investment journey. Secure your future experiences today.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-10" data-aos="fade-left" data-aos-disable-mobile="true">
                    <div class="space-y-4 p-8 border border-white/10 bg-white/5 rounded-sm">
                        <h4 class="text-brand-gold font-bold uppercase tracking-widest text-sm">Direct Line</h4>
                        <p class="text-2xl font-serif">+62 21 1234 5678</p>
                        <p class="text-xs text-gray-400">Available Monday to Friday, <br> 9AM - 6PM</p>
                    </div>
                    <div class="space-y-4 p-8 border border-white/10 bg-white/5 rounded-sm">
                        <h4 class="text-brand-gold font-bold uppercase tracking-widest text-sm">Email Inquiry</h4>
                        <p class="text-lg font-bold break-words">admin@lanusa-island.com</p>
                        <p class="text-xs text-gray-400">Average response time: <br> 24 Hours</p>
                    </div>
                    <div
                        class="sm:col-span-2 p-8 border border-white/10 bg-white/5 rounded-sm flex items-center justify-between">
                        <div class="space-y-1">
                            <h4 class="text-brand-gold font-bold uppercase tracking-widest text-sm">Headquarters</h4>
                            <p class="text-sm text-gray-300">Eccos Plaza Bali, Unit L3 Jl. Sunset Road No. 77B, Kuta, Bali
                            </p>
                        </div>
                        <a href="https://maps.app.goo.gl/hpt65PZJk4voMFGk6"
                            class="bg-brand-gold text-brand-primary font-black px-6 py-3 text-[10px] uppercase tracking-widest hover:bg-white transition shadow-xl">Find
                            On Map</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. MEMBERSHIP TIERS --}}
    <section class="py-24 lg:py-40 bg-[#f9fafb]">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="flex flex-col items-center text-center mb-20 space-y-6">
                <span class="text-brand-gold font-bold text-xs tracking-[0.4em] uppercase">Membership Privileges</span>
                <h2 class="font-serif text-4xl lg:text-6xl text-brand-primary font-bold">Executive Ownership Plans</h2>
                <div class="w-24 h-[3px] bg-brand-gold"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-stretch">
    @foreach ($dataMemberships as $dm)
        @php
            $features = json_decode($dm->features, true);
            
            // Logika Manual untuk Nama & Deskripsi
            switch($dm->type) {
                case 'Gold':
                    $title = 'Voyager';
                    $description = 'The preferred selection for families seeking consistent excellence across our archipelago.';
                    break;
                case 'Platinum':
                    $title = 'Elite';
                    $description = 'The ultimate tier of luxury, offering unparalleled access and bespoke services.';
                    break;
                default: // Discovery / Silver
                    $title = 'Discovery';
                    $description = 'Perfect for individuals beginning their journey into smart holiday ownership.';
                    break;
            }
        @endphp

        @if ($dm->type === 'Gold')
            {{-- CARD GOLD (VOYAGER) --}}
            <div class="bg-brand-primary p-12 flex flex-col justify-between shadow-2xl scale-105 rounded-sm relative z-10 border-t-8 border-brand-gold"
                data-aos="zoom-in" data-aos-disable-mobile="true">
                
                <div class="absolute top-0 right-0 bg-brand-gold text-brand-primary px-6 py-2 text-[10px] font-black uppercase tracking-widest">
                    Most Requested
                </div>

                <div class="space-y-8">
                    <div class="flex justify-between items-start">
                        <span class="text-brand-gold font-black text-xs tracking-widest uppercase italic">{{ $dm->type }} Edition</span>
                        <svg class="w-8 h-8 text-brand-gold" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="font-serif text-4xl text-white font-bold">{{ $title }}</h3>
                        <p class="text-brand-gold font-bold mt-2">Rp {{ number_format($dm->price, 0, ',', '.') }}</p>
                    </div>

                    <p class="text-gray-300 text-sm leading-relaxed">{{ $description }}</p>

                    <div class="py-6 border-y border-white/10">
                        <div class="text-brand-gold font-black text-xs tracking-widest mb-4">PREMIUM BENEFITS:</div>
                        <ul class="space-y-4 text-sm text-white/80">
                            @if (is_array($features) && count($features) > 0)
                                @foreach ($features as $feature)
                                    <li class="flex items-center gap-3">
                                        <span class="w-1.5 h-1.5 bg-brand-gold rounded-full"></span>
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            @else
                                <p class="text-md text-center italic text-gray-400 font-medium">Feature Not Available.</p>
                            @endif
                        </ul>
                    </div>
                </div>

                <a href="{{ route('membership-detail', $dm->slug) }}"
                    class="mt-12 block text-center py-5 bg-brand-gold text-brand-primary font-black text-[10px] uppercase tracking-[0.3em] hover:bg-white transition-all shadow-xl">
                    Secure This Plan
                </a>
            </div>

        @else
            {{-- CARD NON-GOLD (DISCOVERY / ELITE) --}}
            <div class="bg-white border border-gray-100 p-12 flex flex-col justify-between hover:shadow-2xl transition-all duration-500 rounded-sm group"
                data-aos="fade-up" data-aos-disable-mobile="true">
                
                <div class="space-y-8">
                    <div class="flex justify-between items-start">
                        <span class="text-brand-primary font-black text-xs tracking-widest uppercase opacity-40 italic">{{ $dm->type }} Edition</span>
                        <div class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-[10px] text-gray-400">
                            0{{ $loop->iteration }}
                        </div>
                    </div>

                    <div>
                        <h3 class="font-serif text-4xl text-brand-primary font-bold">{{ $title }}</h3>
                        <p class="text-brand-primary font-bold mt-2">Rp {{ number_format($dm->price, 0, ',', '.') }}</p>
                    </div>

                    <p class="text-gray-500 text-sm leading-relaxed">{{ $description }}</p>

                    <div class="py-6 border-y border-gray-50">
                        <div class="text-brand-primary font-black text-xs tracking-widest mb-4">MEMBER BENEFITS:</div>
                        <ul class="space-y-4 text-sm text-gray-600">
                            @if (is_array($features) && count($features) > 0)
                                @foreach ($features as $feature)
                                    <li class="flex items-center gap-3">
                                        <span class="w-1.5 h-1.5 bg-brand-gold rounded-full"></span>
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            @else
                                <p class="text-md text-center italic text-gray-400 font-medium">Feature Not Available.</p>
                            @endif
                        </ul>
                    </div>
                </div>

                <a href="{{ route('membership-detail', $dm->slug) }}"
                    class="mt-12 block text-center py-5 border-2 border-brand-primary text-brand-primary font-bold text-[10px] uppercase tracking-[0.3em] group-hover:bg-brand-primary group-hover:text-white transition-all">
                    Explore Membership
                </a>
            </div>
        @endif
    @endforeach
</div>
        </div>
    </section>


@endsection
