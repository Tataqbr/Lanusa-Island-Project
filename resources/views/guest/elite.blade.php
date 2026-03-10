@extends('layouts.guest')

@section('title', 'Elite Estates & Royal Residences | Lanusa Island')

@section('content')
    {{-- 1. ULTRA-PREMIUM HEADER --}}
    <section class="relative pt-50 pb-24 bg-[#012a2c] overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px] relative z-20">
            <div class="max-w-4xl space-y-8" data-aos="fade-right">
                <div class="flex items-center gap-4">
                    <span class="w-12 h-[2px] bg-brand-gold"></span>
                    <span class="text-brand-gold font-black text-[11px] tracking-[0.6em] uppercase">The Pinnacle Portfolio</span>
                </div>
                <h1 class="font-serif text-white text-[45px] lg:text-[85px] leading-[1.0] font-bold">
                    Elite <br> <span class="italic font-light text-brand-gold">Destinations.</span>
                </h1>
                <p class="text-gray-300 text-lg lg:text-2xl font-light leading-relaxed max-w-2xl">
                    A limited collection of ultra-private estates and royal residences, curated for those who demand the zenith of Indonesian luxury.
                </p>
            </div>
        </div>
        {{-- Decorative element --}}
        <div class="absolute top-0 right-0 w-1/3 h-full bg-brand-gold/5 -skew-x-12 translate-x-20"></div>
    </section>

    {{-- 2. ELITE FILTER & STATUS BAR --}}
    <section class="bg-white border-b border-gray-100 sticky top-[80px] lg:top-[90px] z-[40]">
        <div class="container mx-auto px-6 lg:px-[70px] py-6 flex flex-col lg:flex-row justify-between items-center">
            <div class="flex items-center gap-8 overflow-x-auto no-scrollbar w-full lg:w-auto">
                <span class="text-brand-primary font-black text-[10px] tracking-widest uppercase border-b-2 border-brand-gold pb-1 whitespace-nowrap">Tier-One Estates</span>
                <span class="text-gray-400 font-bold text-[10px] tracking-widest uppercase hover:text-brand-primary cursor-pointer transition whitespace-nowrap">Private Islands</span>
                <span class="text-gray-400 font-bold text-[10px] tracking-widest uppercase hover:text-brand-primary cursor-pointer transition whitespace-nowrap">Royal Penthouses</span>
            </div>
            <div class="mt-4 lg:mt-0 px-4 py-2 bg-brand-light border border-brand-primary/10 rounded-full hidden lg:flex items-center gap-3">
                <div class="w-2 h-2 bg-brand-gold rounded-full animate-pulse"></div>
                <span class="text-[9px] font-black text-brand-primary uppercase tracking-widest">Exclusive Access for Voyager & Legacy Members</span>
            </div>
        </div>
    </section>

    {{-- 3. ELITE RESIDENCES GRID --}}
    <section class="py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="space-y-32">
                
                {{-- Estate 1 --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center" data-aos="fade-up">
                    <div class="lg:col-span-7 relative group">
                        <div class="overflow-hidden shadow-2xl">
                            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80" class="w-full h-[500px] object-cover transition-transform duration-[2s] group-hover:scale-105">
                        </div>
                        <div class="absolute top-8 left-8 bg-brand-primary text-white p-6 shadow-2xl border-l-4 border-brand-gold backdrop-blur-md">
                            <p class="text-[9px] font-black uppercase tracking-widest text-brand-gold mb-1">Starting Price</p>
                            <p class="text-2xl font-serif font-bold">$450 <span class="text-xs font-sans font-light">/ NIGHT</span></p>
                        </div>
                    </div>
                    <div class="lg:col-span-5 space-y-6">
                        <span class="text-brand-gold font-black text-[10px] tracking-[0.4em] uppercase">Labuan Bajo • Royal Series</span>
                        <h3 class="font-serif text-4xl lg:text-5xl font-bold text-brand-primary leading-tight">Oceanic Pearl <br> Hilltop Estate</h3>
                        <p class="text-gray-500 leading-relaxed text-lg font-light">Perched on the highest point of Labuan Bajo, this estate offers 360-degree views of the Komodo archipelago with a private helipad and 24/7 dedicated staff.</p>
                        <div class="flex gap-10 py-6 border-y border-gray-100">
                            <div>
                                <p class="text-[9px] font-black text-brand-primary uppercase tracking-widest">Suites</p>
                                <p class="text-xl font-serif">5 Royal</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-brand-primary uppercase tracking-widest">Privilege</p>
                                <p class="text-xl font-serif">Private Yacht</p>
                            </div>
                        </div>
                        <a href="#" class="inline-block bg-brand-primary text-white font-black px-10 py-4 text-[11px] uppercase tracking-widest hover:bg-brand-gold transition shadow-xl">Request Access</a>
                    </div>
                </div>

                {{-- Estate 2 --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center" data-aos="fade-up">
                    <div class="lg:col-span-5 order-2 lg:order-1 space-y-6">
                        <span class="text-brand-gold font-black text-[10px] tracking-[0.4em] uppercase">Uluwatu • Azure Series</span>
                        <h3 class="font-serif text-4xl lg:text-5xl font-bold text-brand-primary leading-tight">The Majesty <br> Cliff Residence</h3>
                        <p class="text-gray-500 leading-relaxed text-lg font-light">A masterpiece of limestone and glass, hanging dramatically over the Indian Ocean. Features a 30-meter infinity pool that merges with the horizon.</p>
                        <div class="flex gap-10 py-6 border-y border-gray-100">
                            <div>
                                <p class="text-[9px] font-black text-brand-primary uppercase tracking-widest">Area</p>
                                <p class="text-xl font-serif">1,200 sqm</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-brand-primary uppercase tracking-widest">Staff</p>
                                <p class="text-xl font-serif">Private Chef</p>
                            </div>
                        </div>
                        <a href="#" class="inline-block bg-brand-primary text-white font-black px-10 py-4 text-[11px] uppercase tracking-widest hover:bg-brand-gold transition shadow-xl">Request Access</a>
                    </div>
                    <div class="lg:col-span-7 order-1 lg:order-2 relative group">
                        <div class="overflow-hidden shadow-2xl">
                            <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80" class="w-full h-[500px] object-cover transition-transform duration-[2s] group-hover:scale-105">
                        </div>
                        <div class="absolute top-8 right-8 bg-brand-primary text-white p-6 shadow-2xl border-r-4 border-brand-gold text-right backdrop-blur-md">
                            <p class="text-[9px] font-black uppercase tracking-widest text-brand-gold mb-1">Starting Price</p>
                            <p class="text-2xl font-serif font-bold">$380 <span class="text-xs font-sans font-light">/ NIGHT</span></p>
                        </div>
                    </div>
                </div>

                {{-- Estate 3 --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center" data-aos="fade-up">
                    <div class="lg:col-span-7 relative group">
                        <div class="overflow-hidden shadow-2xl">
                            <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&q=80" class="w-full h-[500px] object-cover transition-transform duration-[2s] group-hover:scale-105">
                        </div>
                        <div class="absolute top-8 left-8 bg-brand-primary text-white p-6 shadow-2xl border-l-4 border-brand-gold backdrop-blur-md">
                            <p class="text-[9px] font-black uppercase tracking-widest text-brand-gold mb-1">Starting Price</p>
                            <p class="text-2xl font-serif font-bold">$520 <span class="text-xs font-sans font-light">/ NIGHT</span></p>
                        </div>
                    </div>
                    <div class="lg:col-span-5 space-y-6">
                        <span class="text-brand-gold font-black text-[10px] tracking-[0.4em] uppercase">Private Island • Legacy Series</span>
                        <h3 class="font-serif text-4xl lg:text-5xl font-bold text-brand-primary leading-tight">Varying Island <br> Private Sanctuary</h3>
                        <p class="text-gray-500 leading-relaxed text-lg font-light">Total seclusion on a private island. This estate offers unparalleled privacy with a dedicated speedboat and coral garden access.</p>
                        <div class="flex gap-10 py-6 border-y border-gray-100">
                            <div>
                                <p class="text-[9px] font-black text-brand-primary uppercase tracking-widest">Type</p>
                                <p class="text-xl font-serif">Private Island</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-brand-primary uppercase tracking-widest">Privacy</p>
                                <p class="text-xl font-serif">100% Elite</p>
                            </div>
                        </div>
                        <a href="#" class="inline-block bg-brand-primary text-white font-black px-10 py-4 text-[11px] uppercase tracking-widest hover:bg-brand-gold transition shadow-xl">Request Access</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 4. INSTITUTIONAL REASSURANCE --}}
    <section class="py-24 bg-brand-light">
        <div class="container mx-auto px-6 lg:px-[70px] text-center space-y-12">
            <div class="max-w-3xl mx-auto space-y-6">
                <h2 class="font-serif text-4xl lg:text-6xl font-bold text-brand-primary">Uncompromising <br> <span class="text-brand-gold">Excellence.</span></h2>
                <p class="text-gray-500 text-lg lg:text-xl font-light leading-relaxed">
                    Elite Destinations are managed under a separate ultra-luxury protocol by PT Raga Nusa Property, ensuring the highest ratio of staff-to-guest and absolute discretion for our members.
                </p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-5xl mx-auto">
                <div class="space-y-2">
                    <span class="text-brand-gold text-2xl">🏛️</span>
                    <p class="text-[10px] font-black uppercase tracking-widest text-brand-primary">Institutional Audits</p>
                </div>
                <div class="space-y-2">
                    <span class="text-brand-gold text-2xl">👤</span>
                    <p class="text-[10px] font-black uppercase tracking-widest text-brand-primary">Personal Concierge</p>
                </div>
                <div class="space-y-2">
                    <span class="text-brand-gold text-2xl">🔒</span>
                    <p class="text-[10px] font-black uppercase tracking-widest text-brand-primary">Total Discretion</p>
                </div>
                <div class="space-y-2">
                    <span class="text-brand-gold text-2xl">🚁</span>
                    <p class="text-[10px] font-black uppercase tracking-widest text-brand-primary">Logistic Support</p>
                </div>
            </div>
        </div>
    </section>

@endsection