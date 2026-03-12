@extends('layouts.guest')

@section('content')
<section class="min-h-screen bg-gray-50 flex items-center justify-center py-20 px-6 relative overflow-hidden">
    
    {{-- Global Background Watermark --}}
    <div class="absolute inset-0 z-0 flex items-center justify-center opacity-[0.03] pointer-events-none select-none">
        <h1 class="text-[20vw] font-serif font-black tracking-tighter rotate-12 text-brand-primary">LANUSA</h1>
    </div>

    {{-- Card Container --}}
    <div class="max-w-5xl w-full bg-white shadow-[0_40px_100px_rgba(0,0,0,0.05)] overflow-hidden flex flex-col md:flex-row border border-gray-100 relative z-10">
        
        {{-- Sisi Kiri: Branding & Visual Asset --}}
        <div class="md:w-2/5 bg-brand-primary p-12 flex flex-col justify-between relative overflow-hidden">
            {{-- Decorative Watermark --}}
            <div class="absolute -right-10 -bottom-10 text-white/[0.03] text-[15rem] font-serif pointer-events-none">L</div>

            <div class="relative z-10">
                <h2 class="text-brand-gold font-serif text-4xl italic tracking-tighter">Lanusa</h2>
                <p class="text-white/60 text-[10px] uppercase tracking-[0.4em] mt-2">Institutional Asset Management</p>
            </div>

            <div class="relative z-10 py-16">
                <div class="text-brand-gold text-7xl font-serif italic mb-4">L</div>
                <div class="h-[2px] w-12 bg-brand-gold mb-6"></div>
                <p class="text-white text-lg font-light leading-relaxed">
                    Welcome to the <br> 
                    <span class="text-brand-gold font-bold italic">{{ $booking->resort_name }}</span> Sanctuary.
                </p>
            </div>

            <div class="relative z-10 space-y-4">
                <p class="text-white/40 text-[9px] uppercase tracking-[0.2em] leading-loose">
                    Transaction ID: <br>
                    <span class="text-white font-mono tracking-widest">{{ $booking->transaction_id }}</span>
                </p>
            </div>
        </div>

        {{-- Sisi Kanan: Operational Data --}}
        <div class="md:w-3/5 p-12 bg-white flex flex-col justify-center relative">
            
            <div class="mb-10">
                <h3 class="text-brand-primary font-serif text-4xl font-bold italic">Reservation Secured.</h3>
                <p class="text-gray-400 text-sm mt-2">Your official documents are ready for review.</p>
            </div>

            {{-- Info Grid --}}
            <div class="grid grid-cols-2 gap-x-10 gap-y-8 pb-10 border-b border-gray-100">
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-brand-gold uppercase tracking-widest">Guest Name</p>
                    <p class="text-brand-primary font-bold text-lg uppercase">{{ $booking->user_name }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-brand-gold uppercase tracking-widest">Stay Duration</p>
                    <p class="text-brand-primary font-bold text-lg uppercase">{{ $booking->stay_duration }} Night(s)</p>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-brand-gold uppercase tracking-widest">Resort</p>
                    <p class="text-brand-primary font-bold text-lg uppercase">{{ $booking->resort_name }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-brand-gold uppercase tracking-widest">Status</p>
                    <p class="text-green-600 font-bold text-sm uppercase flex items-center gap-2">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </span>
                        Confirmed
                    </p>
                </div>
            </div>

            {{-- Instructions --}}
            <div class="py-8">
                <p class="text-[11px] text-gray-500 leading-relaxed italic">
                    <strong class="text-brand-primary not-italic">Institutional Note:</strong> 
                    Please download your contract below. This digital record serves as your primary credential for check-in verification at the concierge desk.
                </p>
            </div>

            {{-- Actions --}}
            <div class="space-y-4">
                <a href="{{ route('booking.download_contract', ['order_id' => $booking->transaction_id]) }}" 
                   class="group relative block w-full text-center py-5 bg-brand-primary text-white font-bold text-xs uppercase tracking-[0.3em] hover:bg-brand-gold transition-all duration-500 shadow-xl">
                    Download Contract
                </a>
                
                <a href="{{ route('home') }}" class="block text-center text-[10px] text-gray-400 font-bold uppercase tracking-widest hover:text-brand-primary transition-colors">
                    Back to Homepage
                </a>
            </div>
        </div>
    </div>
</section>
@endsection