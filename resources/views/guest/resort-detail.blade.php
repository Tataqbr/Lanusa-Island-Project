@extends('layouts.guest')

@section('title', $resort->name)

@section('content')
<div class="bg-white min-h-screen pt-[80px] lg:pt-[90px]"> {{-- Menghindari overlap dengan navbar --}}
    @php
        $photos = json_decode($resort->images, true) ?? [];
        $facilities = json_decode($resort->facilities, true) ?? [];
        $count = count($photos);
    @endphp

{{-- 1. DYNAMIC HEADER GALLERY (PERFECT BALANCE FIX) --}}
    <section class="px-6 lg:px-[70px] py-6">
        <div class="rounded-sm overflow-hidden h-[60vh] lg:h-[75vh]">
            @if($count == 1)
                <img src="{{ asset('assets/resorts/' . $photos[0]) }}" class="w-full h-full object-cover">
            @else
                <div class="grid grid-cols-12 h-full gap-2">
                    {{-- Foto Utama (Kiri) --}}
                    <div class="col-span-12 lg:col-span-8 h-full overflow-hidden group">
                        <img src="{{ asset('assets/resorts/' . $photos[0]) }}" 
                             class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    </div>

                    {{-- Foto Kecil (Kanan) - FIX: Menggunakan grid-rows-2 dan min-h-0 --}}
                    <div class="hidden lg:grid col-span-4 h-full grid-rows-2 gap-2">
                        
                        {{-- Foto Atas (50%) --}}
                        <div class="relative overflow-hidden group min-h-0">
                            <img src="{{ asset('assets/resorts/' . ($photos[1] ?? $photos[0])) }}" 
                                 class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                        </div>

                        {{-- Foto Bawah (50%) --}}
                        <div class="relative overflow-hidden group min-h-0">
                            <img src="{{ asset('assets/resorts/' . ($photos[2] ?? $photos[0])) }}" 
                                 class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                            
                            @if($count > 3)
                                <div class="absolute inset-0 bg-brand-primary/60 backdrop-blur-[2px] flex flex-col items-center justify-center border-4 border-white/10 m-2">
                                    <span class="text-white font-black text-3xl tracking-[0.2em]">+{{ $count - 3 }}</span>
                                    <span class="text-white text-[9px] font-bold tracking-[0.4em] uppercase opacity-80">Gallery</span>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- 2. MAIN CONTENT SECTION --}}
    <section class="py-16 container mx-auto px-6 lg:px-[70px]">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            
            {{-- LEFT COLUMN --}}
            <div class="lg:col-span-8 space-y-20">
                
                {{-- Header & Intro --}}
                <div class="space-y-8">
                    <div class="flex items-center gap-4 text-brand-gold font-black text-[10px] tracking-[0.4em] uppercase">
                        <span>{{ $resort->region_name }}</span>
                        <div class="w-8 h-[1px] bg-brand-gold/50"></div>
                        <span class="text-gray-400 font-bold uppercase">{{ $resort->destination_name }}</span>
                    </div>
                    <h1 class="font-serif text-5xl lg:text-7xl font-bold text-brand-primary leading-tight">
                        {{ $resort->name }}
                    </h1>
                    <div class="flex flex-wrap gap-8 py-6 border-y border-gray-100">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-expand text-brand-gold text-sm"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest text-brand-primary">Private Area</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-user-shield text-brand-gold text-sm"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest text-brand-primary">24/7 Concierge</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-map-location-dot text-brand-gold text-sm"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest text-brand-primary">{{ $resort->location }}</span>
                        </div>
                    </div>
                </div>

                {{-- About Content --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                    <div class="md:col-span-1">
                        <h3 class="font-serif text-2xl font-bold text-brand-primary">The Concept</h3>
                    </div>
                    <div class="md:col-span-3">
                        <p class="text-gray-500 text-lg leading-relaxed font-light first-letter:text-5xl first-letter:font-serif first-letter:text-brand-gold first-letter:mr-3 first-letter:float-left">
                            {{ $resort->description }}
                        </p>
                    </div>
                </div>

                {{-- Experience / Facilities --}}
                <div class="space-y-12 pt-16 border-t border-gray-100">
                    <div class="flex justify-between items-end">
                        <h3 class="font-serif text-3xl font-bold text-brand-primary italic">Signature Amenities</h3>
                        <span class="text-[9px] font-black text-brand-gold uppercase tracking-[0.3em]">Exclusively for Members</span>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                        @foreach($facilities as $facility)
                            <div class="p-8 bg-[#f9fafb] border border-gray-50 group hover:border-brand-gold transition-all duration-500">
                                <div class="w-12 h-[1px] bg-brand-gold mb-6 transition-all group-hover:w-full"></div>
                                <span class="text-[11px] font-black text-brand-primary uppercase tracking-[0.2em] block">{{ $facility }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Estate Rules / Extra Content --}}
                <div class="bg-brand-primary p-12 text-white flex flex-col md:flex-row justify-between items-center gap-8">
                    <div class="space-y-2">
                        <h4 class="font-serif text-2xl font-bold">Inquiry & Support</h4>
                        <p class="text-gray-400 text-xs tracking-widest uppercase">Need assistance with your booking?</p>
                    </div>
                    <a href="{{ route('concierge') }}" class="px-10 py-4 border border-brand-gold text-brand-gold text-[10px] font-black tracking-widest uppercase hover:bg-brand-gold hover:text-brand-primary transition">Contact Concierge</a>
                </div>
            </div>

            {{-- RIGHT COLUMN: STICKY BOOKING --}}
            <div class="lg:col-span-4">
                <div class="sticky top-32 space-y-8">
                    <div class="bg-white border border-gray-100 p-10 shadow-2xl space-y-8">
                        <div class="pb-6 border-b border-gray-100">
                            <p class="text-[10px] font-black text-brand-gold uppercase tracking-[0.4em] mb-2">Member Rate</p>
                            <div class="flex items-baseline gap-2">
                                <span class="font-serif text-5xl font-bold text-brand-primary">Rp{{ number_format($resort->price, 0, ',', '.') }}</span>
                                <span class="text-xs text-gray-400 font-bold uppercase tracking-widest">/ Night</span>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <p class="text-[11px] text-gray-400 leading-relaxed uppercase tracking-widest font-bold">
                                Perfect for smart holiday investments and exclusive private access.
                            </p>
                            <button onclick="handleBooking()" class="cursor-pointer w-full bg-brand-primary text-white py-6 text-[11px] font-black uppercase tracking-[0.4em] hover:bg-brand-gold hover:text-brand-primary transition-all shadow-xl">
                                Booking Resort
                            </button>
                        </div>

                        {{-- Additional Trust Info --}}
                        <div class="pt-6 space-y-4">
                            <div class="flex items-center gap-4 text-[9px] font-bold text-gray-400 uppercase tracking-widest">
                                <i class="fa-solid fa-circle-info text-brand-gold"></i>
                                <span>No Hidden Fees</span>
                            </div>
                            <div class="flex items-center gap-4 text-[9px] font-bold text-gray-400 uppercase tracking-widest">
                                <i class="fa-solid fa-calendar-check text-brand-gold"></i>
                                <span>Flexible Reschedule</span>
                            </div>
                        </div>
                    </div>

                    {{-- Local Info Box --}}
                    <div class="p-8 border border-gray-100 bg-[#f9fafb]">
                        <h5 class="text-[10px] font-black text-brand-primary uppercase tracking-[0.3em] mb-4">Location Highlight</h5>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            {{ $resort->name }} is strategically situated in {{ $resort->location }}, offering the perfect balance between serenity and accessibility.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
{{-- Pastikan SweetAlert2 sudah terpasang di layout --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function handleBooking() {
    Swal.fire({
        title: 'Exclusive Member Access',
        text: "Please enter your Member Access Code to continue.",
        input: 'text',
        inputPlaceholder: 'ACC-XXXXXXXX',
        showCancelButton: true,
        confirmButtonText: 'Verify Code',
        confirmButtonColor: '#0A1D37', // brand-primary
        cancelButtonText: 'Not a member yet?',
        cancelButtonColor: '#B89650', // brand-gold
        footer: '<a href="{{ route("memberships") }}" style="color: #B89650; font-weight: bold;">Click here to become a member</a>'
    }).then((result) => {
        if (result.isConfirmed) {
            if (result.value) {
                // Kirim kode ke backend untuk diverifikasi
                verifyAccessCode(result.value);
            } else {
                Swal.fire('Error', 'Access code is required', 'error');
            }
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Jika klik "Not a member yet?"
            window.location.href = "{{ route('memberships') }}";
        }
    });
}

function verifyAccessCode(code) {
    // Tampilkan loading
    Swal.fire({ title: 'Verifying...', allowOutsideClick: false, didOpen: () => { Swal.showLoading() } });

    fetch("{{ route('booking.verify') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ 
            access_code: code,
            resort_id: "{{ $resort->id }}"
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Access Granted',
                text: 'Redirecting to booking details...',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                // Arahkan ke halaman form booking final
                window.location.href = data.redirect_url;
            });
        } else {
            Swal.fire('Access Denied', data.message, 'error');
        }
    });
}
</script>
@endsection