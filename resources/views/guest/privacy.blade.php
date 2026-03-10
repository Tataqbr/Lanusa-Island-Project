@extends('layouts.guest')

@section('title', 'Privacy Policy | Lanusa Island Institutional Standards')

@section('content')
    {{-- 1. FORMAL HEADER --}}
    <section class="relative pt-50 pb-20 bg-brand-primary overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px] relative z-20">
            <div class="max-w-4xl space-y-6" data-aos="fade-right">
                <div class="flex items-center gap-4">
                    <span class="w-12 h-[1px] bg-brand-gold"></span>
                    <span class="text-brand-gold font-black text-[10px] tracking-[0.5em] uppercase">Data Sovereignty</span>
                </div>
                <h1 class="font-serif text-white text-[40px] lg:text-[70px] leading-tight font-bold">
                    Privacy <span class="italic font-light text-brand-gold">&</span> Compliance.
                </h1>
                <p class="text-gray-300 text-lg lg:text-xl font-light leading-relaxed max-w-2xl">
                    Effective as of December 2025. This document outlines how PT Raga Nusa Property secures and manages your institutional data within the Lanusa Island ecosystem.
                </p>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-1/3 h-full bg-white/5 -skew-x-12 translate-x-20"></div>
    </section>

    {{-- 2. LEGAL CONTENT SECTION --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="flex flex-col lg:flex-row gap-20">
                
                {{-- Left Sidebar: Quick Nav (Sticky) --}}
                <div class="lg:w-1/4 hidden lg:block">
                    <div class="sticky top-32 space-y-6 border-l border-gray-100 pl-8">
                        <h5 class="text-brand-primary font-black text-[10px] tracking-widest uppercase mb-10">Document Sections</h5>
                        <a href="#introduction" class="block text-sm text-gray-400 hover:text-brand-gold transition font-bold uppercase tracking-wider">01. Introduction</a>
                        <a href="#collection" class="block text-sm text-gray-400 hover:text-brand-gold transition font-bold uppercase tracking-wider">02. Data Collection</a>
                        <a href="#usage" class="block text-sm text-gray-400 hover:text-brand-gold transition font-bold uppercase tracking-wider">03. Usage of Info</a>
                        <a href="#protection" class="block text-sm text-gray-400 hover:text-brand-gold transition font-bold uppercase tracking-wider">04. Data Protection</a>
                        <a href="#third-party" class="block text-sm text-gray-400 hover:text-brand-gold transition font-bold uppercase tracking-wider">05. Third-Party Policy</a>
                    </div>
                </div>

                {{-- Right Column: The Actual Policy --}}
                <div class="lg:w-3/4 space-y-16">
                    
                    {{-- 01. Introduction --}}
                    <div id="introduction" class="space-y-6" data-aos="fade-up">
                        <h3 class="font-serif text-3xl font-bold text-brand-primary">01. Introduction</h3>
                        <p class="text-gray-600 leading-relaxed lg:text-lg text-justify">
                            Lanusa Island ("we," "our," or "the Platform"), managed by PT Raga Nusa Property, is committed to protecting the privacy and security of our members' personal information. This Privacy Policy explains our practices regarding the collection, use, and disclosure of certain information, including your personal information, in connection with the Lanusa Island service.
                        </p>
                    </div>

                    {{-- 02. Data Collection --}}
                    <div id="collection" class="space-y-6" data-aos="fade-up">
                        <h3 class="font-serif text-3xl font-bold text-brand-primary">02. Data Collection</h3>
                        <p class="text-gray-600 leading-relaxed text-justify">
                            We receive and store information about you such as:
                        </p>
                        <ul class="space-y-4 list-disc pl-6 text-gray-600">
                            <li><strong>Personal Credentials:</strong> Name, professional email address, and verified contact numbers during the enrollment process.</li>
                            <li><strong>Financial Data:</strong> Secure billing information required for membership title acquisitions and annual maintenance fees processed through our institutional payment gateway.</li>
                            <li><strong>Stay Preferences:</strong> History of resort bookings and concierge requests to enhance your customized holiday experience.</li>
                        </ul>
                    </div>

                    {{-- 03. Usage of Information --}}
                    <div id="usage" class="space-y-6" data-aos="fade-up">
                        <h3 class="font-serif text-3xl font-bold text-brand-primary">03. Usage of Information</h3>
                        <p class="text-gray-600 leading-relaxed text-justify">
                            The data collected by PT Raga Nusa Property is utilized strictly for:
                        </p>
                        <ul class="space-y-4 list-disc pl-6 text-gray-600">
                            <li>Facilitating legally binding property ownership titles and certificates.</li>
                            <li>Optimizing resort management and staff preparation for your arrival.</li>
                            <li>Sending institutional updates regarding your investment portfolio and new property additions.</li>
                        </ul>
                    </div>

                    {{-- 04. Data Protection --}}
                    <div id="protection" class="space-y-6" data-aos="fade-up">
                        <h3 class="font-serif text-3xl font-bold text-brand-primary">04. Data Protection</h3>
                        <p class="text-gray-600 leading-relaxed text-justify italic font-medium text-brand-primary">
                            "Your data is treated as a high-value asset, protected by 256-bit institutional encryption standards."
                        </p>
                        <p class="text-gray-600 leading-relaxed text-justify">
                            We use reasonable administrative, logical, physical, and managerial measures to safeguard your personal information against loss, theft, and unauthorized access, use, and modification. These measures are designed to provide a level of security appropriate to the risks of processing your personal information.
                        </p>
                    </div>

                    {{-- 05. Third-Party Policy --}}
                    <div id="third-party" class="space-y-6" data-aos="fade-up">
                        <h3 class="font-serif text-3xl font-bold text-brand-primary">05. Third-Party Policy</h3>
                        <p class="text-gray-600 leading-relaxed text-justify">
                            Lanusa Island will never sell your data to third-party advertisers. Information is only shared with verified institutional partners (such as bank payment gateways and legal title offices) necessary to execute your membership rights.
                        </p>
                    </div>

                    <div class="pt-12 border-t border-gray-100">
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest leading-relaxed">
                        Questions regarding this policy or data protection should be directed to: <br>
                        <span class="text-brand-primary">admin@lanusa-island.com</span> <br>
                        <span class="text-[10px] mt-2 block text-gray-300 italic">Managed by PT Raga Nusa Property</span>
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. FINAL REASSURANCE --}}
    <section class="py-24 bg-brand-light">
        <div class="container mx-auto px-6 lg:px-[70px] text-center space-y-8">
            <h2 class="font-serif text-3xl lg:text-4xl font-bold text-brand-primary italic">Trust is our primary asset.</h2>
            <div class="flex justify-center">
                <a href="{{ route('memberships') }}" class="bg-brand-primary text-white font-black px-12 py-5 text-[11px] uppercase tracking-[0.4em] hover:bg-brand-gold transition shadow-xl">Back to Membership</a>
            </div>
        </div>
    </section>
@endsection