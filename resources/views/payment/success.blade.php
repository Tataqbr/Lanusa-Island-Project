@extends('layouts.guest')

@section('content')
<section class="min-h-screen bg-gray-50 flex items-center justify-center py-20 px-6 relative overflow-hidden">
    
    {{-- Global Background Watermark --}}
    <div class="absolute inset-0 z-0 flex items-center justify-center opacity-[0.03] pointer-events-none select-none">
        <h1 class="text-[20vw] font-serif font-black tracking-tighter rotate-12">LANUSA ISLAND</h1>
    </div>

    {{-- Card Container --}}
    <div class="max-w-5xl w-full bg-white shadow-[0_40px_100px_rgba(0,0,0,0.1)] overflow-hidden flex flex-col md:flex-row border border-brand-gold/20 relative z-10">
        
        {{-- Sisi Kiri: Branding & Visual Asset --}}
        <div class="md:w-2/5 bg-brand-primary p-12 flex flex-col justify-between relative overflow-hidden">
            {{-- Decorative Watermark --}}
            <div class="absolute -right-10 -bottom-10 text-white/[0.03] text-[15rem] font-serif pointer-events-none">
                {{ substr($userData->plan_name ?? 'L', 0, 1) }}
            </div>

            <div class="relative z-10">
                <h2 class="text-brand-gold font-serif text-4xl italic tracking-tighter">Lanusa</h2>
                <p class="text-white/40 text-[10px] uppercase tracking-[0.4em] mt-2">Institutional Asset Management</p>
            </div>

            <div class="relative z-10 py-16">
                <div class="text-brand-gold text-7xl font-serif italic mb-4">{{ substr($userData->plan_name ?? 'L', 0, 1) }}</div>
                <div class="h-[2px] w-12 bg-brand-gold mb-6"></div>
                <p class="text-white text-lg font-light leading-relaxed">
                    Welcome to the <br> 
                    <span class="text-brand-gold font-bold italic">{{ $userData->plan_name }}</span> Ecosystem.
                </p>
            </div>

            <div class="relative z-10 space-y-4">
                <p class="text-white/30 text-[9px] uppercase tracking-[0.2em] leading-loose">
                    Verification ID: <br>
                    <span class="text-white/60">{{ $orderId }}</span>
                </p>
            </div>
        </div>

        {{-- Sisi Kanan: Operational Data --}}
        <div class="md:w-3/5 p-12 bg-white flex flex-col justify-center relative">
            {{-- Subtle Inner Watermark --}}
            <div class="absolute right-4 bottom-4 opacity-[0.05] pointer-events-none">
                <img src="/path/to/your/logo-icon.png" class="w-24 grayscale" alt="">
            </div>

            <div class="mb-10">
                <h3 class="text-brand-primary font-serif text-4xl font-bold italic">Acquisition Secured.</h3>
                <p class="text-gray-400 text-sm mt-2">Your institutional credentials have been generated.</p>
            </div>

            {{-- Info Grid --}}
            <div class="grid grid-cols-2 gap-x-10 gap-y-8 pb-10 border-b border-gray-100">
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-brand-gold uppercase tracking-widest">Asset Holder</p>
                    <p class="text-brand-primary font-bold text-lg uppercase">{{ $userData->name }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-brand-gold uppercase tracking-widest">Contract Period</p>
                    <p class="text-brand-primary font-bold text-lg uppercase">{{ $userData->contract ?? 'N/A' }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-brand-gold uppercase tracking-widest">Access Code</p>
                    <p class="text-brand-primary font-black text-xl tracking-[0.2em]">{{ $userData->access_code }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-brand-gold uppercase tracking-widest">Asset Status</p>
                    <p class="text-green-600 font-bold text-sm uppercase flex items-center gap-2">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </span>
                        Verified & Active
                    </p>
                </div>
            </div>

            {{-- Instructions --}}
            <div class="py-8">
                <p class="text-[11px] text-gray-500 leading-relaxed italic">
                    <strong class="text-brand-primary not-italic">Institutional Note:</strong> 
                    Please download your certificate below. Your Access Code is a private credential required for all property reservations. Do not share these details through unsecured channels.
                </p>
            </div>

            {{-- Actions --}}
            <div class="space-y-4">
                <a href="{{ route('payment.download_certificate', ['order_id' => $orderId]) }}" 
                   class="group relative block w-full text-center py-5 bg-brand-primary text-white font-bold text-xs uppercase tracking-[0.3em] hover:bg-brand-gold transition-all duration-500 overflow-hidden shadow-2xl">
                    <span class="relative z-10">Download Official Certificate</span>
                    <div class="absolute inset-0 w-0 bg-brand-gold transition-all duration-500 group-hover:w-full"></div>
                </a>
                
                <a href="{{ route('home') }}" class="block text-center text-[10px] text-gray-400 font-bold uppercase tracking-widest hover:text-brand-primary transition-colors">
                    Return to Ecosystem Portal
                </a>
            </div>
        </div>
    </div>
</section>
@endsection