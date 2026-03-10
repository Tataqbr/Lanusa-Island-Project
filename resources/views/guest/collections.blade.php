@extends('layouts.guest')

@section('title', 'Property Collections | Lanusa Island Institutional Portofolio')

@section('content')
{{-- 1. SOPHISTICATED HEADER (Tetap seperti aslinya) --}}
    <section class="relative pt-50 pb-24 bg-brand-primary overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px] relative z-20">
            <div class="max-w-4xl space-y-8" data-aos="fade-right">
                <div class="flex items-center gap-4">
                    <span class="w-12 h-[1px] bg-brand-gold"></span>
                    <span class="text-brand-gold font-black text-[10px] tracking-[0.5em] uppercase">Curated Series</span>
                </div>
                <h1 class="font-serif text-white text-[45px] lg:text-[80px] leading-[1.1] font-bold">
                    The Collection <br> <span class="italic font-light text-brand-gold">Masterpieces.</span>
                </h1>
                <p class="text-gray-300 text-lg lg:text-2xl font-light leading-relaxed max-w-2xl">
                    A categorized showcase of our architectural heritage, featuring the pinnacle of luxury from each destination.
                </p>
            </div>
        </div>
        <div class="absolute bottom-0 right-0 opacity-[0.03] pointer-events-none select-none">
            <h2 class="text-[250px] font-serif font-bold text-white -mb-10 mr-20 uppercase">Collection</h2>
        </div>
    </section>

    {{-- 2. DYNAMIC COLLECTION SERIES --}}
    <section class="py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px]">
            
            @foreach($dataCollections as $index => $item)
            @php 
                $resortImages = json_decode($item->images);
                // Gunakan gambar resort jika ada, jika tidak pakai gambar destinasi
                $displayImage = (!empty($resortImages)) ? $resortImages[0] : $item->destination_bg;
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center mb-40 last:mb-0">
                {{-- Toggle posisi gambar: Genap di kiri, Ganjil di kanan --}}
                <div class="lg:col-span-7 {{ $index % 2 != 0 ? 'lg:order-2' : '' }}" data-aos="{{ $index % 2 == 0 ? 'fade-right' : 'fade-left' }}">
                    <div class="relative group overflow-hidden shadow-2xl">
                        <img src="{{ asset('assets/resorts/' . $displayImage) }}" 
                             class="w-full h-[550px] object-cover transition-transform duration-[2s] group-hover:scale-105" 
                             alt="{{ $item->resort_name }}">
                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/10 transition-all duration-700"></div>
                        
                        {{-- Label Destinasi --}}
                        <div class="absolute bottom-10 left-10 text-white">
                            <p class="text-brand-gold font-black text-[10px] tracking-[0.4em] uppercase mb-2">Portfolio 0{{ $index + 1 }}</p>
                            <h3 class="font-serif text-4xl lg:text-5xl font-bold">{{ $item->destination_name }}</h3>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 space-y-8 {{ $index % 2 != 0 ? 'lg:order-1' : '' }}" data-aos="{{ $index % 2 == 0 ? 'fade-left' : 'fade-right' }}">
                    <div class="space-y-4">
                        <h4 class="text-brand-primary font-serif text-3xl font-bold border-l-4 border-brand-gold pl-6 italic leading-tight">
                            {{ $item->resort_name }}
                        </h4>
                        <p class="text-gray-500 leading-relaxed text-lg font-light">
                            {{ Str::limit($item->description, 200) }}
                        </p>
                    </div>

                    {{-- High-End Details --}}
                    <div class="space-y-6 pt-6 border-t border-gray-100">
                        <div class="flex justify-between items-end">
                            <div>
                                <p class="text-[10px] font-black text-brand-gold uppercase tracking-widest mb-1">Asset Value</p>
                                <p class="font-serif text-2xl font-bold text-brand-primary italic">IDR {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('resort-detail', $item->resort_slug) }}" class="group inline-flex items-center gap-3">
                                <span class="text-brand-primary font-black text-[11px] uppercase tracking-[0.3em]">Explore Asset</span>
                                <div class="w-8 h-8 rounded-full border border-brand-gold flex items-center justify-center text-brand-gold group-hover:bg-brand-gold group-hover:text-white transition-all">
                                    →
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </section>

    {{-- 3. INSTITUTIONAL QUALITY SECTION --}}
    <section class="py-24 bg-brand-primary text-white border-t border-white/10">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="space-y-10" data-aos="fade-right">
                    <h2 class="font-serif text-4xl lg:text-6xl font-bold leading-tight">Managed with <br> <span class="text-brand-gold italic">Precision.</span></h2>
                    <p class="text-gray-400 text-xl font-light leading-relaxed max-w-lg">
                        Our collections are not just properties; they are managed assets under the PT Raga Nusa Property standard. Every unit is audited quarterly for structural and hospitality excellence.
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-10" data-aos="fade-left">
                    <div class="p-8 border border-white/10 bg-white/5 space-y-4">
                        <span class="text-brand-gold text-2xl">🏛️</span>
                        <h5 class="text-xs font-black uppercase tracking-widest leading-tight">Asset Protection</h5>
                        <p class="text-[10px] text-gray-500 uppercase tracking-tighter">Legal & Structural Assurance</p>
                    </div>
                    <div class="p-8 border border-white/10 bg-white/5 space-y-4">
                        <span class="text-brand-gold text-2xl">🛎️</span>
                        <h5 class="text-xs font-black uppercase tracking-widest leading-tight">Service Standards</h5>
                        <p class="text-[10px] text-gray-500 uppercase tracking-tighter">5-Star Elite Hospitality</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. FINAL CALL TO ACTION --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6 lg:px-[70px] text-center space-y-12">
            <div class="max-w-3xl mx-auto space-y-6">
                <h2 class="font-serif text-3xl lg:text-5xl font-bold text-brand-primary leading-tight">Your Portfolio <span class="text-brand-gold italic">Awaits.</span></h2>
                <p class="text-gray-500 text-lg font-light leading-relaxed">
                    Access all collections with a single membership investment. Secure your legacy today.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="{{ route('memberships') }}" class="bg-brand-primary text-white font-black px-12 py-5 text-[11px] uppercase tracking-[0.4em] hover:bg-brand-gold transition shadow-xl">Join The Club</a>
                <a href="{{ route('destinations') }}" class="border border-brand-primary text-brand-primary font-black px-12 py-5 text-[11px] uppercase tracking-[0.4em] hover:bg-brand-primary hover:text-white transition">Full Catalog</a>
            </div>
        </div>
    </section>
@endsection