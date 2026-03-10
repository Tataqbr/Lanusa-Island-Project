@extends('layouts.guest')

@section('title', 'Membership Investment Plans | Lanusa Island')

@section('content')
    {{-- 1. LUXURY HEADER --}}
      <section class="relative pt-50 pb-24 bg-brand-primary overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px] relative z-20">
            <div class="max-w-4xl space-y-8" data-aos="fade-right">
                <div class="flex items-center gap-4">
                    <span class="w-12 h-[1px] bg-brand-gold"></span>
                    <span class="text-brand-gold font-black text-[10px] tracking-[0.5em] uppercase">Investment Opportunities</span>
                </div>
                <h1 class="font-serif text-white text-[45px] lg:text-[80px] leading-[1.1] font-bold">
                   Choose Your <br> <span class="italic font-light text-brand-gold">Legacy Plan.</span>
                </h1>
                <p class="text-gray-300 text-lg lg:text-2xl font-light leading-relaxed max-w-2xl">
                     Secure institutional-grade holiday assets. One-time investment for a lifetime of premium experiences across the PT Raga Nusa Property portfolio.
                </p>
            </div>
        </div>
        {{-- Elegant subtle watermark --}}
        <div class="absolute bottom-0 right-0 opacity-[0.03] pointer-events-none">
            <h2 class="text-[300px] font-serif font-bold text-white -mb-20">LANUSA</h2>
        </div>
    </section>

    {{-- 2. TIER COMPARISON SECTION --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
    @foreach ($dataMemberships as $dm)
        @php
            $features = json_decode($dm->features, true);
            
            // Logika Nama & Deskripsi Manual sesuai Permintaan
            switch($dm->type) {
                case 'Silver':
                    $tierLabel = 'Entry Tier';
                    $planName = 'The Discovery Plan';
                    $description = 'Perfect for young families beginning their journey into professional holiday ownership.';
                    $buttonText = 'Select Silver';
                    break;
                case 'Gold':
                    $tierLabel = 'Premier Tier';
                    $planName = 'The Voyager Plan';
                    $description = 'Our most requested plan, offering the perfect balance of flexibility and elite resort access.';
                    $buttonText = 'Invest In Gold';
                    break;
                case 'Platinum':
                    $tierLabel = 'Elite Tier';
                    $planName = 'The Legacy Title';
                    $description = 'An intergenerational asset designed for connoisseurs of the world\'s most exclusive destinations.';
                    $buttonText = 'Request Platinum';
                    break;
                default:
                    $tierLabel = 'Membership';
                    $planName = 'Standard Plan';
                    $description = 'Explore our exclusive holiday ownership benefits.';
                    $buttonText = 'View Plan';
            }
        @endphp

        @if ($dm->type === 'Gold')
            {{-- GOLD TIER (FEATURED) --}}
            <div class="bg-brand-primary p-10 lg:p-14 flex flex-col justify-between shadow-[0_40px_80px_-15px_rgba(1,69,71,0.5)] scale-105 rounded-sm relative z-10 border-t-8 border-brand-gold" data-aos="zoom-in">
                <div class="absolute top-0 right-0 bg-brand-gold text-brand-primary px-6 py-2 text-[9px] font-black uppercase tracking-widest">Recommended Investment</div>
                <div class="space-y-8">
                    <div class="space-y-2">
                        <span class="text-brand-gold font-black text-[10px] tracking-widest uppercase">{{ $tierLabel }}</span>
                        <h3 class="font-serif text-4xl font-bold text-white">{{ $dm->type }}</h3>
                        <p class="text-brand-gold font-black text-[10px] tracking-widest uppercase italic">{{ $planName }}</p>
                    </div>
                    <div class="space-y-4 pt-6 border-t border-white/10">
                        <div class="text-[40px] font-serif font-bold text-white">Rp {{ number_format($dm->price, 0, ',', '.') }}<span class="text-sm font-sans text-white/50 font-normal"> / one-time</span></div>
                        <p class="text-gray-300 text-sm leading-relaxed">{{ $description }}</p>
                    </div>
                    <ul class="space-y-5 text-sm text-white/90">
                        @if(is_array($features))
                            @foreach($features as $feature)
                                <li class="flex items-center gap-4"><span class="w-4 h-[1px] bg-brand-gold"></span> {{ $feature }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <a href="{{ route('membership-detail',$dm->slug) }}" class="mt-12 block text-center py-6 bg-brand-gold text-brand-primary font-black text-[11px] uppercase tracking-[0.4em] hover:bg-white transition-all shadow-2xl">
                    {{ $buttonText }}
                </a>
            </div>
        @else
            {{-- SILVER & PLATINUM TIER --}}
            <div class="border border-gray-100 p-10 lg:p-14 flex flex-col justify-between hover:shadow-2xl transition-all duration-700 relative overflow-hidden bg-white" data-aos="fade-up">
                <div class="space-y-8">
                    <div class="space-y-2">
                        <span class="text-brand-primary font-black text-[10px] tracking-widest uppercase opacity-40">{{ $tierLabel }}</span>
                        <h3 class="font-serif text-4xl font-bold text-brand-primary">{{ $dm->type }}</h3>
                        <p class="text-brand-gold font-black text-[10px] tracking-widest uppercase">{{ $planName }}</p>
                    </div>
                    <div class="space-y-4 pt-6 border-t border-gray-50">
                        <div class="text-[40px] font-serif font-bold text-brand-primary">Rp {{ number_format($dm->price, 0, ',', '.') }}<span class="text-sm font-sans text-gray-400 font-normal"> / one-time</span></div>
                        <p class="text-gray-500 text-sm leading-relaxed">{{ $description }}</p>
                    </div>
                    <ul class="space-y-5 text-sm text-gray-700">
                        @if(is_array($features))
                            @foreach($features as $feature)
                                <li class="flex items-center gap-4"><span class="w-1.5 h-1.5 bg-brand-gold rounded-full"></span> {{ $feature }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <a href="{{ route('membership-detail',$dm->slug) }}" class="mt-12 block text-center py-5 border-2 border-brand-primary text-brand-primary font-black text-[11px] uppercase tracking-[0.3em] hover:bg-brand-primary hover:text-white transition-all">
                    {{ $buttonText }}
                </a>
            </div>
        @endif
    @endforeach
</div>
        </div>
    </section>

    {{-- 3. FINANCIAL TRANSPARENCY SECTION --}}
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="max-w-4xl mx-auto space-y-12">
                <div class="text-center space-y-4">
                    <h2 class="font-serif text-3xl lg:text-5xl font-bold text-brand-primary">Institutional Clarity</h2>
                    <p class="text-gray-500 uppercase tracking-widest text-[10px] font-black">Understanding your investment</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="bg-white p-8 border-l-4 border-brand-gold shadow-sm space-y-4">
                        <h4 class="font-bold text-brand-primary uppercase tracking-widest text-xs">No Hidden Maintenance</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">Unlike traditional real estate, members only contribute to a transparent annual maintenance fee, capped and managed by PT Raga Nusa Property.</p>
                    </div>
                    <div class="bg-white p-8 border-l-4 border-brand-gold shadow-sm space-y-4">
                        <h4 class="font-bold text-brand-primary uppercase tracking-widest text-xs">Full Transferability</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">Your membership is a legal asset. It can be sold, gifted, or inherited, ensuring your holiday legacy continues for generations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

        {{-- 5. FINAL CTA --}}
    <section class="py-20 bg-brand-primary text-center">
        <div class="container mx-auto px-6 lg:px-[70px] space-y-10">
            <h2 class="font-serif text-3xl lg:text-5xl text-white font-bold">Ready to Secure Your <span class="text-brand-gold">Legacy?</span></h2>
            <div class="flex justify-center gap-8">
                <div class="text-center">
                    <p class="text-brand-gold font-black text-2xl">Secure</p>
                    <p class="text-white/50 text-[10px] uppercase tracking-widest">Payment Gateway</p>
                </div>
                <div class="w-[1px] bg-white/10"></div>
                <div class="text-center">
                    <p class="text-brand-gold font-black text-2xl">Verified</p>
                    <p class="text-white/50 text-[10px] uppercase tracking-widest">Legal Assets</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. FAQ PREVIEW --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
                <div class="space-y-6">
                    <h2 class="font-serif text-4xl font-bold text-brand-primary">Common <br> Inquiries.</h2>
                    <p class="text-gray-500">Everything you need to know about the Lanusa Island ownership model.</p>
                    <a href="{{ route('faq') }}" class="inline-block text-brand-gold font-black text-[10px] uppercase tracking-[0.4em] border-b border-brand-gold pb-2">View Full FAQ</a>
                </div>
                <div class="space-y-8">
                    <div class="border-b border-gray-100 pb-6">
                        <h5 class="font-bold text-brand-primary mb-2 italic uppercase text-xs tracking-widest">How does the 10-year term work?</h5>
                        <p class="text-sm text-gray-500">The term begins from your first check-in. You retain all rights to the property nights for the entire duration, managed by our concierge.</p>
                    </div>
                    <div class="border-b border-gray-100 pb-6">
                        <h5 class="font-bold text-brand-primary mb-2 italic uppercase text-xs tracking-widest">What payment methods are accepted?</h5>
                        <p class="text-sm text-gray-500">We utilize high-security payment gateways. We accept major Credit Cards (with installment options), Bank Transfers (Virtual Accounts), and Corporate Checks. All transactions are handled through our encrypted institutional portal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection