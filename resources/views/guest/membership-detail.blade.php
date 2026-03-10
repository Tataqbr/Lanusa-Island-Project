@extends('layouts.guest')

@section('title', $membership->type . ' Edition | Lanusa Island Membership')

@section('content')
    {{-- 1. ARCHITECTURAL HEADER --}}
    <section class="relative pt-52 pb-24 bg-brand-primary overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px] relative z-20">
            <div class="max-w-4xl space-y-8" data-aos="fade-right">
                <div class="flex items-center gap-4">
                    <span class="w-12 h-[1px] bg-brand-gold"></span>
                    <span class="text-brand-gold font-black text-[10px] tracking-[0.5em] uppercase">Asset Specification</span>
                </div>
                <h1 class="font-serif text-white text-[45px] lg:text-[80px] leading-[1.1] font-bold">
                    {{ $membership->type }} <span class="italic font-light text-brand-gold">Edition.</span>
                </h1>
                <div class="flex flex-col md:flex-row md:items-center gap-8 md:gap-16 pt-4">
                    <div class="space-y-1">
                        <p class="text-brand-gold font-black text-[10px] uppercase tracking-widest opacity-60">Investment Value</p>
                        <p class="text-white text-3xl font-bold tracking-tighter">Rp {{ number_format($membership->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="space-y-1 border-l border-white/10 pl-8">
                        <p class="text-brand-gold font-black text-[10px] uppercase tracking-widest opacity-60">Contract Status</p>
                        <p class="text-white text-3xl font-light tracking-tighter">{{ $membership->contract }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 right-0 opacity-[0.03] pointer-events-none">
            <span class="text-[250px] font-serif font-bold text-white mr-10 -mb-16 uppercase tracking-tighter">{{ substr($membership->type, 0, 1) }}</span>
        </div>
    </section>

    {{-- 2. TECHNICAL SPECIFICATIONS SECTION --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="flex flex-col lg:flex-row gap-24">
                <div class="lg:w-3/5 space-y-20">
                    <div class="space-y-10">
                        <div class="space-y-4">
                            <h3 class="font-serif text-4xl font-bold text-brand-primary italic">Overview</h3>
                            <div class="h-1 w-20 bg-brand-gold"></div>
                        </div>
                        <p class="text-gray-600 leading-relaxed text-justify text-lg font-light">
                            The {{ $membership->type }} Edition grants the holder strategic access to the Lanusa Island property ecosystem. This is an institutional-grade membership asset designed for consistent excellence and long-term holiday ownership.
                        </p>
                    </div>

                    <div class="space-y-10">
                        <h3 class="font-serif text-3xl font-bold text-brand-primary">Entitled Privileges</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            @php $features = json_decode($membership->features, true); @endphp
                            @foreach($features as $feature)
                                <div class="flex items-start gap-4 group">
                                    <span class="mt-2 w-2 h-2 bg-brand-gold rounded-full group-hover:scale-150 transition-transform"></span>
                                    <div class="space-y-1">
                                        <p class="text-brand-primary font-black text-xs tracking-wider uppercase">{{ $feature }}</p>
                                        <p class="text-gray-400 text-[10px] uppercase tracking-widest">Guaranteed Annual Benefit</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="lg:w-2/5">
                    <div class="sticky top-32 space-y-8">
                        <div class="p-12 bg-gray-50 border border-gray-100 rounded-sm space-y-10 shadow-sm">
                            <h5 class="text-brand-primary font-black text-[10px] tracking-widest uppercase border-b border-gray-200 pb-4">Acquisition Form</h5>
                            
                            <form id="payment-form" class="space-y-6">
                                @csrf
                                <input type="hidden" name="plan_id" value="{{ $membership->id }}">
                                
                                <div class="space-y-4">
                                    <div class="group">
                                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Full Name</label>
                                        <input type="text" name="name" required placeholder="AS PER IDENTITY CARD" class="w-full bg-transparent border-b border-gray-200 py-2 outline-none focus:border-brand-gold transition-colors text-sm">
                                    </div>

                                    <div class="group">
                                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Email Address</label>
                                        <input type="email" id="email-input" name="email" required placeholder="INSTITUTIONAL OR PERSONAL" class="w-full bg-transparent border-b border-gray-200 py-2 outline-none focus:border-brand-gold transition-colors text-sm">
                                        <p id="email-error" class="hidden text-[9px] text-red-500 font-bold uppercase tracking-widest mt-2 italic"></p>
                                    </div>

                                    <div class="grid grid-cols-2 gap-6">
                                        <div class="group">
                                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Phone Number</label>
                                            <input type="text" name="phone" required placeholder="+62..." class="w-full bg-transparent border-b border-gray-200 py-2 outline-none focus:border-brand-gold transition-colors text-sm">
                                        </div>
                                        <div class="group">
                                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">State / Province</label>
                                            <input type="text" name="state" required placeholder="E.G. JAKARTA" class="w-full bg-transparent border-b border-gray-200 py-2 outline-none focus:border-brand-gold transition-colors text-sm uppercase">
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-6">
                                    <button type="submit" id="pay-button" class="cursor-pointer block w-full text-center py-5 bg-brand-primary text-white font-black text-[10px] uppercase tracking-[0.4em] hover:bg-brand-gold transition-all duration-500">
                                        Initialize Acquisition
                                    </button>
                                </div>
                            </form>
                            <p class="text-[9px] text-gray-400 text-center leading-loose uppercase tracking-widest">
                                By proceeding, you agree to our <br>
                                <a href="/terms" class="text-brand-primary font-bold underline">Membership Agreement</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MODAL: MANUAL UPLOAD --}}
    <div id="manual-upload-modal" class="hidden fixed inset-0 bg-black/80 z-[60] flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white p-8 md:p-12 rounded-sm max-w-md w-full shadow-2xl overflow-y-auto max-h-[90vh]">
            <h3 class="font-serif text-2xl font-bold text-brand-primary mb-2 italic text-center">Transfer Verification</h3>
            <div class="h-[1px] w-12 bg-brand-gold mx-auto mb-6"></div>
            
            <p class="text-gray-600 text-xs uppercase tracking-wider text-center mb-8 leading-relaxed">
                Please transfer <span class="font-bold text-brand-primary">Rp {{ number_format($membership->price, 0, ',', '.') }}</span> to:<br>
                <span class="text-brand-gold font-bold">BCA 123456789</span> <br> a.n Lanusa Island
            </p>
            
            <form action="{{ route('payment.upload_proof') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="transaction_id" id="modal-transaction-id">
                
                <div class="space-y-4">
                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Upload Payment Proof</label>
                        <input type="file" name="proof" id="proof-input" accept="image/*" required 
                               class="w-full text-xs border border-gray-100 p-3 bg-gray-50 focus:outline-none focus:border-brand-gold">
                    </div>

                    <div id="preview-container" class="hidden space-y-2">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Preview</label>
                        <div class="relative group border border-gray-100 p-2 bg-gray-50">
                            <img id="image-preview" src="#" alt="Preview" class="w-full h-48 object-contain">
                            <button type="button" id="remove-preview" 
                                    class="cursor-pointer absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full hover:bg-red-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <button type="submit" class="cursor-pointer w-full py-4 bg-brand-primary text-white text-[10px] font-black uppercase tracking-widest hover:bg-brand-gold transition-colors">Submit Transaction</button>
                    <button type="button" onclick="closeManualModal()" class="cursor-pointer w-full py-4 text-gray-400 text-[9px] font-black uppercase tracking-widest italic">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    {{-- CUSTOM SUCCESS OVERLAY --}}
    <div id="success-overlay" class="hidden fixed inset-0 bg-brand-primary/95 z-[9999] flex items-center justify-center p-6 backdrop-blur-sm">
        <div class="max-w-md w-full bg-white p-12 text-center space-y-8 shadow-2xl">
            <div class="flex justify-center">
                <div class="w-20 h-20 bg-brand-gold rounded-full flex items-center justify-center animate-pulse">
                    <svg class="w-10 h-10 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            <div class="space-y-4">
                <h3 class="font-serif text-3xl font-bold text-brand-primary uppercase italic">Payment Received</h3>
                <div class="h-[1px] w-24 bg-brand-gold mx-auto"></div>
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.2em] leading-relaxed">
                    Transaction Verified. <br>
                    Please hold as we secure your asset.
                </p>
            </div>
            <div class="flex items-center justify-center gap-3">
                <div class="w-2 h-2 bg-brand-gold rounded-full animate-ping"></div>
                <span class="text-[9px] font-black text-brand-primary uppercase tracking-widest">Redirecting to Vault...</span>
            </div>
        </div>
    </div>

    {{-- SCRIPTS --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentForm = document.getElementById('payment-form');
            const payButton = document.getElementById('pay-button');
            const manualModal = document.getElementById('manual-upload-modal');
            const successOverlay = document.getElementById('success-overlay');
            const transactionIdInput = document.getElementById('modal-transaction-id');
            const emailError = document.getElementById('email-error');

            if (!paymentForm) return;

            paymentForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                payButton.disabled = true;
                payButton.innerHTML = 'PROCESSING...';
                emailError.classList.add('hidden');

                let formData = new FormData(this);

                fetch("{{ route('payment.pay') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json'
                    }
                })
                .then(async response => {
                    const text = await response.text(); 
                    let data;
                    try {
                        data = JSON.parse(text);
                    } catch (e) {
                        throw { message: "Server error: Unexpected response format." };
                    }
                    
                    if (!response.ok) throw data;
                    return data;
                })
                .then(data => {
                    // 1. HANDLER MIDTRANS
                    if(data.type === 'midtrans' && data.snap_token) {
                        window.snap.pay(data.snap_token, {
                            onSuccess: function(result) { 
                                successOverlay.classList.remove('hidden');
                                successOverlay.classList.add('flex');
                                setTimeout(() => { window.location.href = '/payment/success?order_id=' + result.order_id; }, 3500);
                            },
                            onPending: function(result) { window.location.href = '/payment/fail'; },
                            onError: function(result) { 
                                alert("Transaction Failed."); 
                                resetPayButton();
                            },
                            onClose: function() { resetPayButton(); }
                        });
                    } 
                    // 2. HANDLER XENDIT
                    else if (data.type === 'xendit') {
                        window.location.href = data.invoice_url;
                    }
                    // 3. HANDLER MANUAL
                    else if (data.type === 'manual') {
                        transactionIdInput.value = data.transaction_id;
                        manualModal.classList.remove('hidden');
                        resetPayButton();
                    }
                })
                .catch(error => {
                    emailError.innerText = error.message || 'Error occurred.';
                    emailError.classList.remove('hidden');
                    resetPayButton();
                });
            });

            function resetPayButton() {
                payButton.disabled = false;
                payButton.innerHTML = 'Initialize Acquisition';
            }
        });

        // PREVIEW LOGIC
        document.addEventListener('DOMContentLoaded', function() {
            const proofInput = document.getElementById('proof-input');
            const imagePreview = document.getElementById('image-preview');
            const previewContainer = document.getElementById('preview-container');
            const removePreview = document.getElementById('remove-preview');

            if (proofInput) {
                proofInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            imagePreview.setAttribute('src', e.target.result);
                            previewContainer.classList.remove('hidden');
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

            if (removePreview) {
                removePreview.addEventListener('click', function() {
                    proofInput.value = "";
                    imagePreview.setAttribute('src', '#');
                    previewContainer.classList.add('hidden');
                });
            }
        });

        function closeManualModal() {
            document.getElementById('manual-upload-modal').classList.add('hidden');
            document.getElementById('proof-input').value = "";
            document.getElementById('preview-container').classList.add('hidden');
        }
    </script>
@endsection