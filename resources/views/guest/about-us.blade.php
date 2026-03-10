@extends('layouts.guest')

@section('title', 'About Our Legacy | Lanusa Island')

@section('content')
    {{-- 1. SOPHISTICATED HEADER --}}
    <section class="relative pt-50 pb-24 bg-brand-primary overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px] relative z-20">
            <div class="max-w-4xl space-y-8" data-aos="fade-right">
                <div class="flex items-center gap-4">
                    <span class="w-12 h-[1px] bg-brand-gold"></span>
                    <span class="text-brand-gold font-black text-[10px] tracking-[0.5em] uppercase">Company Profile</span>
                </div>
                <h1 class="font-serif text-white text-[45px] lg:text-[80px] leading-[1.1] font-bold">
                    The Vision Behind <br> <span class="italic font-light text-brand-gold">Lanusa Island.</span>
                </h1>
                <p class="text-gray-300 text-lg lg:text-2xl font-light leading-relaxed max-w-2xl">
                    Defining the future of luxury vacation ownership through institutional management and uncompromising hospitality standards.
                </p>
            </div>
        </div>
        {{-- Decorative skew --}}
        <div class="absolute top-0 right-0 w-1/2 h-full bg-white/5 skew-x-12 translate-x-32"></div>
    </section>

    {{-- 2. OUR STORY & PT RAGA NUSA PROPERTY --}}
    <section class="py-24 lg:py-40 bg-white">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24 items-center">
                <div class="lg:col-span-5 order-2 lg:order-1" data-aos="fade-right">
                    <div class="space-y-8">
                        <div class="space-y-4">
                            <span class="text-brand-gold font-black text-[11px] tracking-[0.4em] uppercase">The Foundation</span>
                            <h2 class="font-serif text-4xl lg:text-5xl text-brand-primary font-bold leading-tight">Institutional <br> Excellence.</h2>
                        </div>
                        <p class="text-gray-600 text-lg leading-relaxed text-justify">
                            Lanusa Island is an exclusive vacation ownership platform proudly managed by PT Raga Nusa Property. Our journey began with a single mission: to solve the complexities of luxury real estate ownership in Indonesia.
                        </p>
                        <p class="text-gray-600 text-lg leading-relaxed text-justify">
                            By combining high-end property development with a transparent timeshare model, we provide our members with an asset that is not only a gateway to world-class holidays but also a secure investment for future generations.
                        </p>
                        <div class="pt-6">
                            <div class="flex items-center gap-6">
                                <div class="bg-brand-light p-4">
                                    <p class="text-brand-primary font-serif font-bold text-xl">2025</p>
                                    <p class="text-[9px] uppercase tracking-widest font-black text-gray-400">Year Established</p>
                                </div>
                                <div class="bg-brand-light p-4">
                                    <p class="text-brand-primary font-serif font-bold text-xl">Official</p>
                                    <p class="text-[9px] uppercase tracking-widest font-black text-gray-400">Licensed Entity</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-7 order-1 lg:order-2 relative" data-aos="zoom-in">
                <img src="{{ asset('assets/img/about-lanusa.avif') }}" alt="Corporate Office" class="w-full h-[400px] lg:h-[600px] object-cover rounded-sm shadow-2xl">
                    <div class="absolute -bottom-6 -left-6 bg-brand-gold text-brand-primary p-10 hidden lg:block shadow-2xl">
                        <p class="font-serif italic text-2xl font-bold">Managed by</p>
                        <p class="text-[10px] font-black uppercase tracking-widest mt-2">PT Raga Nusa Property</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. VISION & MISSION (INSTITUTIONAL STYLE) --}}
    <section class="py-24 bg-brand-primary text-white">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
                <div class="space-y-8" data-aos="fade-up">
                    <h3 class="text-brand-gold font-black text-[12px] tracking-[0.4em] uppercase">Our Vision</h3>
                    <p class="font-serif text-3xl lg:text-5xl font-bold leading-tight">
                        To become the global gold standard for flexible luxury property ownership in Southeast Asia.
                    </p>
                </div>
                <div class="space-y-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="space-y-4">
                        <h3 class="text-brand-gold font-black text-[12px] tracking-[0.4em] uppercase">Our Mission</h3>
                        <ul class="space-y-8">
                            <li class="flex gap-6">
                                <span class="text-brand-gold font-serif text-2xl">01</span>
                                <div>
                                    <h5 class="font-bold uppercase tracking-widest text-sm mb-2">Asset Integrity</h5>
                                    <p class="text-gray-400 text-sm leading-relaxed">Maintaining the highest legal and physical standards across our entire property portfolio.</p>
                                </div>
                            </li>
                            <li class="flex gap-6">
                                <span class="text-brand-gold font-serif text-2xl">02</span>
                                <div>
                                    <h5 class="font-bold uppercase tracking-widest text-sm mb-2">Member Satisfaction</h5>
                                    <p class="text-gray-400 text-sm leading-relaxed">Delivering a seamless "check-in and relax" experience through our dedicated digital concierge.</p>
                                </div>
                            </li>
                            <li class="flex gap-6">
                                <span class="text-brand-gold font-serif text-2xl">03</span>
                                <div>
                                    <h5 class="font-bold uppercase tracking-widest text-sm mb-2">Sustainable Growth</h5>
                                    <p class="text-gray-400 text-sm leading-relaxed">Expanding into strategic destinations that offer both lifestyle pleasure and long-term value.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. CORE VALUES SECTION --}}
    <section class="py-24 lg:py-40 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="text-center mb-20 space-y-4">
                <span class="text-brand-gold font-black text-[10px] tracking-[0.5em] uppercase">Our Values</span>
                <h2 class="font-serif text-4xl lg:text-6xl text-brand-primary font-bold">The Pillars of Trust</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="bg-white p-12 text-center space-y-6 hover:shadow-xl transition-all duration-500 border-t-4 border-brand-gold" data-aos="fade-up">
                    <h4 class="text-brand-primary font-black tracking-widest text-xs uppercase">Transparency</h4>
                    <p class="text-gray-500 text-sm leading-relaxed font-light">Every contract, maintenance fee, and ownership title is clearly defined under PT Raga Nusa Property's oversight.</p>
                </div>
                <div class="bg-white p-12 text-center space-y-6 hover:shadow-xl transition-all duration-500 border-t-4 border-brand-gold" data-aos="fade-up" data-aos-delay="100">
                    <h4 class="text-brand-primary font-black tracking-widest text-xs uppercase">Quality</h4>
                    <p class="text-gray-500 text-sm leading-relaxed font-light">We only select properties in prime locations that meet our strict "5-Star Exclusive" resort criteria.</p>
                </div>
                <div class="bg-white p-12 text-center space-y-6 hover:shadow-xl transition-all duration-500 border-t-4 border-brand-gold" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="text-brand-primary font-black tracking-widest text-xs uppercase">Continuity</h4>
                    <p class="text-gray-500 text-sm leading-relaxed font-light">As a transferable asset, your membership is designed to provide holiday luxury for you and your heirs.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. CORPORATE REASSURANCE --}}
    <section class="py-24 bg-white border-b border-gray-100">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-32">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <h2 class="font-serif text-4xl lg:text-5xl text-brand-primary font-bold leading-tight">Legal & <br> Institutional <span class="text-brand-gold">Security.</span></h2>
                </div>
                <div class="lg:w-1/2 space-y-6 text-gray-500 text-lg font-light leading-relaxed" data-aos="fade-left">
                    <p>All Lanusa Island membership titles are legally registered and protected. We operate under the direct management of PT Raga Nusa Property, ensuring that the highest standards of Indonesian property law and international hospitality are met.</p>
                    <p>Our commitment is to your peace of mind. We handle the staff, the taxes, and the upkeep—you simply enjoy the legacy.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. FINAL CALL TO ACTION --}}
    <section class="py-32 bg-brand-light text-center">
        <div class="container mx-auto px-6 lg:px-[70px] space-y-12">
            <h2 class="font-serif text-3xl lg:text-5xl text-brand-primary font-bold max-w-4xl mx-auto">Ready to Join the <span class="text-brand-gold italic">Family?</span></h2>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="{{ route('memberships') }}" class="bg-brand-primary text-white font-black px-12 py-5 text-[11px] uppercase tracking-[0.4em] hover:bg-brand-gold transition shadow-2xl">Explore Memberships</a>
                <a href="{{ route('contact') }}" class="border border-brand-primary text-brand-primary font-black px-12 py-5 text-[11px] uppercase tracking-[0.4em] hover:bg-brand-primary hover:text-white transition">Contact Us</a>
            </div>
        </div>
    </section>
@endsection