    @extends('layouts.guest')

    @section('title', 'Finalize Your Stay - ' . $resort->name)

    @section('content')
    <div class="bg-[#f8f9fa] min-h-screen pt-[120px] lg:pt-[150px] pb-20 relative overflow-hidden">
        
        {{-- Watermark Decorative --}}
        <div class="absolute top-20 -right-20 opacity-[0.03] select-none pointer-events-none">
            <h1 class="text-[200px] font-serif font-bold rotate-12">LANUSA</h1>
        </div>

        <div class="container mx-auto px-6 lg:px-[70px] relative z-10">
            
            {{-- Breadcrumb / Header --}}
            <div class="mb-12 space-y-2">
                <h4 class="text-[10px] font-black text-brand-gold uppercase tracking-[0.5em]">Reservation Process</h4>
                <h1 class="font-serif text-4xl lg:text-5xl font-bold text-brand-primary">Secure Your Sanctuary</h1>
            </div>

            <form id="bookingForm" class="grid grid-cols-1 lg:grid-cols-12 gap-16">
                @csrf
                <input type="hidden" name="resort_id" value="{{ $resort->id }}">
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                {{-- KIRI: FORM DETAIL --}}
                <div class="lg:col-span-7 space-y-10">
                    
                    {{-- Detail Form Card --}}
                    <div class="bg-white p-10 lg:p-14 shadow-[0_20px_50px_rgba(0,0,0,0.05)] border-t-4 border-brand-gold">
                        <div class="flex items-center justify-between mb-12">
                            <h2 class="font-serif text-2xl font-bold text-brand-primary italic">Guest Information</h2>
                            <span class="text-[9px] font-bold text-gray-300 uppercase tracking-widest">Verified Member</span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div class="space-y-2">
                                <label class="text-[9px] font-black uppercase tracking-[0.3em] text-brand-gold block">Primary Member</label>
                                <div class="border-b-2 border-gray-100 py-3 text-brand-primary font-bold text-lg">
                                    {{ $user->name }}
                                </div>
                            </div>
                            <div class="space-y-4">
                                <label class="text-[9px] font-black uppercase tracking-[0.3em] text-brand-gold block">Stay Duration</label>
                                <div class="relative group">
                                    <input type="number" name="stay_duration" id="stay_duration" min="1" value="1" 
                                        class="w-full border-2 border-gray-100 p-4 text-brand-primary font-bold focus:border-brand-gold outline-none transition-all" required>
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-bold text-gray-400 uppercase">Nights</span>
                                </div>
                            </div>
                        </div>

                        {{-- Important Information / Warning --}}
                        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="p-6 bg-gray-50 flex gap-4">
                                <i class="fa-solid fa-circle-info text-brand-gold mt-1"></i>
                                <div class="space-y-1">
                                    <h6 class="text-[10px] font-black text-brand-primary uppercase tracking-widest">Check-in Policy</h6>
                                    <p class="text-[10px] text-gray-500 leading-relaxed uppercase">Standard check-in time is 14:00. Early access is subject to availability.</p>
                                </div>
                            </div>
                            <div class="p-6 bg-gray-50 flex gap-4">
                                <i class="fa-solid fa-shield-halved text-brand-gold mt-1"></i>
                                <div class="space-y-1">
                                    <h6 class="text-[10px] font-black text-brand-primary uppercase tracking-widest">Member Exclusive</h6>
                                    <p class="text-[10px] text-gray-500 leading-relaxed uppercase">This rate is non-transferable and only valid for the registered member.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Terms Agreement WM Style --}}
                    <div class="p-8 border border-dashed border-gray-200 opacity-60 hover:opacity-100 transition-opacity">
                        <p class="text-[10px] text-gray-400 leading-loose text-justify uppercase tracking-tighter">
                            By proceeding with this reservation, you acknowledge that Lanusa Asset Management acts as the exclusive concierge. All bookings are final. Cancellation policies apply as per the membership handbook code 2024-B. Your security deposit might be required upon arrival at {{ $resort->name }}.
                        </p>
                    </div>
                </div>

                {{-- KANAN: RINGKASAN BIAYA (STICKY) --}}
                <div class="lg:col-span-5">
                    <div class="sticky top-[150px] bg-brand-primary p-12 shadow-[0_30px_60px_rgba(10,29,55,0.3)]">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <i class="fa-solid fa-crown text-4xl text-white"></i>
                        </div>
                        
                        <h3 class="font-serif text-2xl font-bold text-white mb-10 pb-4 border-b border-white/10 italic">Summary</h3>
                        
                        <div class="space-y-6">
                            <div class="flex justify-between items-end">
                                <div class="space-y-1">
                                    <span class="block text-[9px] text-white/50 uppercase tracking-[0.3em]">Destination</span>
                                    <span class="text-sm font-bold text-white uppercase tracking-widest">{{ $resort->name }}</span>
                                </div>
                            </div>

                            <div class="pt-6 space-y-4 border-t border-white/5">
                                <div class="flex justify-between text-xs">
                                    <span class="text-white/60 uppercase tracking-widest">Member Rate</span>
                                    <span class="font-bold text-white">Rp{{ number_format($resort->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-[10px]">
                                    <span class="text-white/40 uppercase tracking-widest">Tax & Service (Inc.)</span>
                                    <span class="font-bold text-white/40">Included</span>
                                </div>
                            </div>

                            <div class="pt-8 mt-4">
                                <div class="flex flex-col gap-2">
                                    <span class="text-[10px] font-black text-brand-gold uppercase tracking-[0.4em]">Total Investment</span>
                                    <span class="text-4xl font-bold text-brand-gold tracking-tighter" id="total_display">
                                        Rp{{ number_format($resort->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="submitBtn" class="cursor-pointer w-full mt-12 bg-brand-gold text-brand-primary py-6 text-[11px] font-black uppercase tracking-[0.5em] hover:bg-white transition-all shadow-xl">
                            Authorize Transaction
                        </button>

                        {{-- Concierge WM --}}
                        <div class="mt-8 pt-8 border-t border-white/5 text-center">
                            <p class="text-[8px] text-white/30 uppercase tracking-[0.3em]">Authorized by Lanusa Concierge Service</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

{{-- Dynamic Scripts --}}
@if(DB::table('payment_gateways')->where('code', 'midtrans')->where('status', 'active')->exists())
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const pricePerNight = {{ $resort->price }};
    const durationInput = document.getElementById('stay_duration');
    const totalDisplay = document.getElementById('total_display');

    durationInput.addEventListener('input', function() {
        if(this.value < 1) this.value = 1;
        const total = pricePerNight * (this.value || 0);
        totalDisplay.innerText = 'Rp' + new Intl.NumberFormat('id-ID').format(total);
    });

    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerText = 'AUTHORIZING...';
        
        Swal.fire({ title: 'Processing...', allowOutsideClick: false, didOpen: () => { Swal.showLoading() } });

        fetch("{{ route('booking.store') }}", {
            method: 'POST',
            body: new FormData(this),
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(response => response.json())
        .then(data => {
            if(!data.success) throw new Error(data.message);

            // Handle Dynamic Gateways
            if(data.type === 'midtrans') {
                snap.pay(data.snap_token, {
                    // PERBAIKAN: Gunakan concatenate string untuk ID transaksi
                    onSuccess: function(result) {
                        window.location.href = "/booking/success/" + data.transaction_id;
                    },
                    onPending: function(result) {
                        window.location.href = "/booking/success/" + data.transaction_id;
                    },
                    onError: function(result) {
                        Swal.fire({ icon: 'error', title: 'Payment Failed', text: 'Please try again.' });
                        btn.disabled = false;
                        btn.innerText = 'AUTHORIZE TRANSACTION';
                    }
                });
            } else if(data.type === 'xendit') {
                window.location.href = data.invoice_url; 
            } else {
                // PERBAIKAN: Redirect manual (Bank Transfer/Manual)
                window.location.href = "/booking/success/" + data.transaction_id;
            }
})
        .catch(err => {
            Swal.fire({ icon: 'error', title: 'Authorization Failed', text: err.message });
            btn.disabled = false;
            btn.innerText = 'AUTHORIZE TRANSACTION';
        });
    });
</script>
    @endsection