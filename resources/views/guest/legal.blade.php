@extends('layouts.guest')

@section('title', 'Legal Framework & Asset Security | Lanusa Island')

@section('content')
    {{-- 1. AUTHORITATIVE HEADER --}}
    <section class="relative pt-50 pb-24 bg-brand-primary overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px] relative z-20">
            <div class="max-w-4xl space-y-8" data-aos="fade-right">
                <div class="flex items-center gap-4">
                    <span class="w-12 h-[2px] bg-brand-gold"></span>
                    <span class="text-brand-gold font-black text-[10px] tracking-[0.5em] uppercase">Trust & Integrity</span>
                </div>
                <h1 class="font-serif text-white text-[45px] lg:text-[80px] leading-[1.1] font-bold">
                    Legal <span class="italic font-light text-brand-gold">Fortress.</span>
                </h1>
                <p class="text-gray-300 text-lg lg:text-2xl font-light leading-relaxed max-w-2xl">
                    Protecting your investment through robust legal structures and institutional-grade security protocols managed by PT Raga Nusa Property.
                </p>
            </div>
        </div>
        {{-- Background Graphic --}}
        <div class="absolute top-0 right-0 w-1/2 h-full bg-white/5 skew-x-12 translate-x-32"></div>
    </section>

    {{-- 2. CORE SECURITY PILLARS --}}
    <section class="py-24 bg-white border-b border-gray-100">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                
                {{-- Pillar 1: Legal Compliance --}}
                <div class="space-y-6 p-10 bg-gray-50 border-t-4 border-brand-gold shadow-sm" data-aos="fade-up">
                    <div class="text-3xl">⚖️</div>
                    <h4 class="text-brand-primary font-black text-xs tracking-widest uppercase">Regulatory Compliance</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Lanusa Island operates in strict accordance with the Republic of Indonesia’s property and hospitality laws. All membership certificates are legally binding contracts under Indonesian jurisdiction.
                    </p>
                </div>

                {{-- Pillar 2: Asset Management --}}
                <div class="space-y-6 p-10 bg-gray-50 border-t-4 border-brand-gold shadow-sm" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-3xl">🏛️</div>
                    <h4 class="text-brand-primary font-black text-xs tracking-widest uppercase">Asset Custodianship</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Every property in our portfolio is held under PT Raga Nusa Property. We ensure that the underlying real estate is free of liens and maintained to international 5-star standards.
                    </p>
                </div>

                {{-- Pillar 3: Data Protection --}}
                <div class="space-y-6 p-10 bg-gray-50 border-t-4 border-brand-gold shadow-sm" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-3xl">🔐</div>
                    <h4 class="text-brand-primary font-black text-xs tracking-widest uppercase">Cybersecurity</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Our member portal utilizes 256-bit SSL encryption. All financial transactions are processed through PCI-DSS compliant gateways, ensuring your sensitive data never touches our servers.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- 3. DETAILED LEGAL FRAMEWORK --}}
    <section class="py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="relative" data-aos="fade-right">
                    <img src="{{ asset('assets/img/legal.avif') }}" class="w-full h-[600px] object-cover grayscale opacity-80 rounded-sm shadow-2xl">
                    <div class="absolute inset-0 border-[20px] border-brand-primary/10 -translate-x-10 translate-y-10 -z-10"></div>
                </div>
                <div class="space-y-10" data-aos="fade-left">
                    <div class="space-y-4">
                        <span class="text-brand-gold font-black text-[11px] tracking-[0.4em] uppercase">Transparency First</span>
                        <h2 class="font-serif text-4xl lg:text-5xl text-brand-primary font-bold leading-tight">Institutional <br> Accountability.</h2>
                    </div>
                    
                    <div class="space-y-8">
                        <div class="pb-8 border-b border-gray-100">
                            <h5 class="text-brand-primary font-bold uppercase tracking-widest text-xs mb-3">Escrow Protections</h5>
                            <p class="text-gray-500 text-sm leading-relaxed">Investment funds for future property acquisitions are managed through secure accounts, ensuring the expansion of the portfolio is always financially backed.</p>
                        </div>
                        <div class="pb-8 border-b border-gray-100">
                            <h5 class="text-brand-primary font-bold uppercase tracking-widest text-xs mb-3">Audit Standards</h5>
                            <p class="text-gray-500 text-sm leading-relaxed">We undergo annual third-party audits for both our financial health and the structural integrity of our properties to maintain member confidence.</p>
                        </div>
                        <div>
                            <h5 class="text-brand-primary font-bold uppercase tracking-widest text-xs mb-3">Title Insurance</h5>
                            <p class="text-gray-500 text-sm leading-relaxed">Each property within the Lanusa Island collection is protected by title insurance to guarantee the validity of the ownership rights provided to you.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. VERIFICATION LOGOS (TRUST BAR) --}}
    <section class="py-16 bg-gray-50 border-y border-gray-100">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="flex flex-wrap justify-center items-center gap-12 lg:gap-24 grayscale opacity-40">
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-bold">SSL</span>
                    <span class="text-[8px] font-black uppercase tracking-widest">Secure Socket Layer</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-bold">PCI</span>
                    <span class="text-[8px] font-black uppercase tracking-widest">Compliance Level 1</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-bold">ISO</span>
                    <span class="text-[8px] font-black uppercase tracking-widest">27001 Certified</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-bold">GDPR</span>
                    <span class="text-[8px] font-black uppercase tracking-widest">Ready Policy</span>
                </div>
            </div>
        </div>
    </section>


@endsection