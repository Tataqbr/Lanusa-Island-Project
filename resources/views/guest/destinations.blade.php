@extends('layouts.guest')

@section('title', 'Exclusive Destinations | Lanusa Island')

@section('content')
    {{-- 1. SOPHISTICATED HEADER --}}
    <section class="relative pt-50 pb-24 bg-brand-primary overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px] relative z-20">
            <div class="max-w-4xl space-y-8" data-aos="fade-right">
                <div class="flex items-center gap-4">
                    <span class="w-12 h-[1px] bg-brand-gold"></span>
                    <span class="text-brand-gold font-black text-[10px] tracking-[0.5em] uppercase">Global Portfolio</span>
                </div>
                <h1 class="font-serif text-white text-[45px] lg:text-[80px] leading-[1.1] font-bold">
                    The Signature <br> <span class="italic font-light text-brand-gold">Resort Collection</span>
                </h1>
                <p class="text-gray-300 text-lg lg:text-2xl font-light leading-relaxed max-w-2xl">
                    A deliberate selection of Indonesia's most exclusive estates, managed under the institutional standards of PT Raga Nusa Property.
                </p>
            </div>
        </div>
        {{-- Elegant subtle watermark --}}
        <div class="absolute bottom-0 right-0 opacity-[0.03] pointer-events-none">
            <h2 class="text-[300px] font-serif font-bold text-white -mb-20">LANUSA</h2>
        </div>
    </section>

{{-- 2. REFINED FILTER BAR --}}
    <section class="sticky top-[80px] lg:top-[90px] z-[40] bg-white/95 backdrop-blur-md border-b border-gray-100">
        <div class="container mx-auto px-6 lg:px-[70px] py-8">
            <div class="flex flex-col gap-8">
                
                <div class="flex items-center gap-10 overflow-x-auto w-full no-scrollbar border-b border-gray-100 pb-2">
                    @foreach($regions as $region)
                        <a href="{{ route('destinations', ['region' => $region->id]) }}" 
                           class="{{ $selectedRegionId == $region->id ? 'text-brand-primary border-brand-gold' : 'text-gray-400 border-transparent' }} font-black text-[11px] tracking-[0.3em] border-b-2 pb-3 whitespace-nowrap uppercase transition-all duration-300">
                           {{ $region->name }}
                        </a>
                    @endforeach
                </div>

                <div class="flex flex-col lg:flex-row justify-between items-center gap-6">
                    <div class="flex items-center gap-8 overflow-x-auto w-full lg:w-auto no-scrollbar">
                        {{-- Button All Destinations dalam Region tersebut --}}
                        <a href="{{ route('destinations', ['region' => $selectedRegionId]) }}" 
                           class="flex items-center gap-2 {{ !$selectedDestId ? 'text-brand-primary' : 'text-gray-400' }} font-bold text-[10px] tracking-widest uppercase whitespace-nowrap transition-colors">
                           @if(!$selectedDestId) <span class="w-1.5 h-1.5 bg-brand-gold rounded-full"></span> @endif
                           All Estates
                        </a>

                        @foreach($destinations as $dest)
                            <a href="{{ route('destinations', ['region' => $selectedRegionId, 'destination' => $dest->id]) }}" 
                               class="flex items-center gap-2 {{ $selectedDestId == $dest->id ? 'text-brand-primary' : 'text-gray-400' }} font-bold text-[10px] tracking-widest hover:text-brand-primary transition-colors whitespace-nowrap uppercase">
                               @if($selectedDestId == $dest->id) <span class="w-1.5 h-1.5 bg-brand-gold rounded-full"></span> @endif
                               {{ $dest->name }}
                            </a>
                        @endforeach
                    </div>

                    {{-- Sort & Info --}}
                    <div class="flex items-center gap-4 w-full lg:w-auto border-l border-gray-100 pl-0 lg:pl-8">
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Showing {{ $resorts->count() }} Properties</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

{{-- 3. THE ELITE RESORT CATALOG --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-28 gap-x-12">
                
                @forelse($resorts as $resort)
                    @php
                        $resortImages = json_decode($resort->images, true);
                        $displayImage = (is_array($resortImages) && count($resortImages) > 0) 
                                        ? $resortImages[0] 
                                        : 'default.jpg';
                        
                        $priceInUsd = number_format($resort->price, 0, ',', '.'); 
                    @endphp

                    <div class="group flex flex-col h-full" data-aos="fade-up">
                        {{-- Image Section --}}
                        <div class="relative overflow-hidden aspect-[4/5] mb-8 shadow-xl">
                            <img src="{{ asset('assets/resorts/' . $displayImage) }}" 
                                 alt="{{ $resort->name }}"
                                 class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-105">
                            
                            {{-- Badge Region di atas Gambar --}}
                            <div class="absolute top-6 left-6">
                                <span class="bg-white/90 backdrop-blur-md text-brand-primary px-4 py-2 text-[9px] font-black tracking-[0.2em] uppercase shadow-sm">
                                    {{ $resort->region_name }}
                                </span>
                            </div>
                        </div>

                        {{-- Content Section --}}
                        <div class="flex flex-col flex-1 px-1">
                            {{-- Price & Category - Ditampilkan Jelas --}}
                            <div class="flex items-end justify-between mb-4">
                                <div class="space-y-1">
                                    <span class="text-brand-gold font-black text-[10px] tracking-[0.3em] uppercase block">Starting From</span>
                                    <div class="flex items-baseline gap-1">
                                        <span class="font-serif text-3xl font-bold text-brand-primary">Rp{{ $priceInUsd }}</span>
                                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">/ Night</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-gray-400 font-bold text-[9px] tracking-[0.2em] uppercase">{{ $resort->destination_name }}</span>
                                </div>
                            </div>

                            <div class="w-full h-[1px] bg-gray-100 mb-6"></div>

                            {{-- Title --}}
                            <h3 class="font-serif text-3xl font-bold text-brand-primary leading-tight mb-4 group-hover:text-brand-gold transition-colors duration-300">
                                {{ $resort->name }}
                            </h3>

                            {{-- Description --}}
                            <p class="text-gray-500 text-sm leading-relaxed font-light line-clamp-3 mb-10">
                                {{ $resort->description }}
                            </p>

                            {{-- Action Button --}}
                            <div class="mt-auto">
                                <a href="{{ route('resort-detail', $resort->slug) }}" 
                                   class="group/btn relative inline-flex items-center justify-center w-full px-8 py-5 bg-brand-primary overflow-hidden transition-all duration-300 hover:bg-brand-gold">
                                    {{-- Animasi Slide Background --}}
                                    <span class="relative z-10 text-white font-black text-[10px] uppercase tracking-[0.4em] transition-colors duration-300 group-hover/btn:text-brand-primary">
                                        Explore Details
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-40">
                        <p class="text-gray-400 font-serif italic text-2xl">No exclusive estates match your selection.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </section>

    {{-- 4. INSTITUTIONAL STATEMENT SECTION --}}
    <section class="py-32 bg-brand-primary border-t border-white/5">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="space-y-10" data-aos="fade-right">
                    <h2 class="font-serif text-4xl lg:text-6xl text-white font-bold leading-tight">Uncompromising <br> <span class="text-brand-gold italic">Standards.</span></h2>
                    <p class="text-gray-400 text-xl font-light leading-relaxed">
                        Every property in the Lanusa Island portfolio undergoes rigorous quality audits to ensure the integrity of your investment and the excellence of your stay.
                    </p>
                    <div class="grid grid-cols-2 gap-8 pt-8 border-t border-white/10">
                        <div class="space-y-2">
                            <span class="text-brand-gold font-black text-[10px] tracking-widest uppercase">Management</span>
                            <p class="text-white text-sm font-bold uppercase">Asset Protection</p>
                        </div>
                        <div class="space-y-2">
                            <span class="text-brand-gold font-black text-[10px] tracking-widest uppercase">Hospitality</span>
                            <p class="text-white text-sm font-bold uppercase">Personal Concierge</p>
                        </div>
                    </div>
                </div>
                <div class="relative" data-aos="fade-left">
                    <img src="{{ asset('assets/img/institutional.avif') }}" class="w-full h-[550px] object-cover grayscale opacity-60">
                    <div class="absolute inset-0 border-[20px] border-brand-primary translate-x-10 -translate-y-10 -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. CONVERSION BLOCK --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="bg-gray-50 p-12 lg:p-24 text-center space-y-10 rounded-sm">
                <h2 class="font-serif text-3xl lg:text-5xl font-bold text-brand-primary max-w-3xl mx-auto leading-tight">
                    Guest Rates are Standard. <br> <span class="text-brand-gold">Membership is Permanent.</span>
                </h2>
                <p class="text-gray-500 max-w-xl mx-auto text-lg leading-relaxed font-light">
                    Why pay retail for every visit? Join the families who have secured their future holidays at institutional rates through PT Raga Nusa Property.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-6 pt-4">
                    <a href="{{ route('memberships') }}" class="bg-brand-primary text-white font-black px-12 py-5 text-[11px] uppercase tracking-[0.3em] hover:bg-brand-gold transition shadow-xl">Become a Member</a>
                </div>
            </div>
        </div>
    </section>
@endsection