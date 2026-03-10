@extends('layouts.guest')

@section('title', 'Membership Enrollment | Join Lanusa Island')

@section('content')
    {{-- Main Container - Added pt to clear the fixed navbar on mobile --}}
    <section class="relative min-h-screen flex flex-col lg:flex-row overflow-hidden bg-white pt-[80px] lg:pt-0">
        
        {{-- LEFT SIDE: BRANDING (Institutional Feel) --}}
        <div class="relative lg:w-1/3 hidden lg:flex flex-col justify-between px-16 py-50 bg-brand-primary overflow-hidden">
            <img src="{{ asset('assets/img/register.avif') }}" 
                 class="absolute inset-0 w-full h-full object-cover opacity-20 grayscale" alt="Luxury Interior">
            
            <div class="relative z-20 space-y-10" data-aos="fade-right">

                <div class="space-y-6 pt-10">
                    <h2 class="font-serif text-white text-5xl lg:text-6xl font-bold leading-tight">
                        Start Your <br> <span class="text-brand-gold italic">Legacy.</span>
                    </h2>
                    <p class="text-gray-300 text-xl font-light leading-relaxed">
                        Join an elite circle of property owners managed by PT Raga Nusa Property.
                    </p>
                </div>

                <div class="space-y-8 pt-10 border-t border-white/10">
                    <div class="flex items-center gap-5">
                        <div class="w-10 h-10 rounded-full border border-brand-gold/50 flex items-center justify-center text-brand-gold font-serif">I</div>
                        <p class="text-white/80 text-xs font-black uppercase tracking-[0.2em]">Institutional Security</p>
                    </div>
                    <div class="flex items-center gap-5">
                        <div class="w-10 h-10 rounded-full border border-brand-gold/50 flex items-center justify-center text-brand-gold font-serif">II</div>
                        <p class="text-white/80 text-xs font-black uppercase tracking-[0.2em]">Global Portofolio Access</p>
                    </div>
                </div>
            </div>

            <div class="relative z-20">
                <p class="text-[10px] text-brand-gold font-black uppercase tracking-[0.5em]">Enrollment Portal v.2025</p>
            </div>
            <div class="absolute inset-0 bg-gradient-to-b from-brand-primary/90 to-brand-primary"></div>
        </div>

        {{-- RIGHT SIDE: LARGE ENROLLMENT FORM --}}
        <div class="w-full lg:w-2/3 flex items-center justify-center bg-white lg:mt-34 py-12 lg:py-24 px-6 lg:px-20 overflow-y-auto">
            <div class="w-full max-w-4xl space-y-12" data-aos="fade-up">
                
                <div class="space-y-4 border-b border-gray-100 pb-8">
                    <span class="text-brand-gold font-black text-xs tracking-[0.5em] uppercase">Private Enrollment</span>
                    <h3 class="font-serif text-4xl lg:text-6xl font-bold text-brand-primary tracking-tighter">Become a Member</h3>
                    <p class="text-gray-500 text-base lg:text-xl font-light">Create your professional account to unlock institutional rates and exclusive estate access.</p>
                </div>

                <form action="#" method="POST" class="space-y-10">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        {{-- Legal Full Name --}}
                        <div class="space-y-2 group">
                            <label class="text-[11px] font-black text-brand-primary uppercase tracking-[0.2em]">Legal Full Name</label>
                            <input type="text" name="name" required 
                                   class="w-full p-5 bg-gray-50 border-b-2 border-gray-200 focus:border-brand-gold focus:bg-white outline-none text-base lg:text-lg transition-all"
                                   placeholder="Full name as per ID">
                        </div>

                        {{-- Official Email --}}
                        <div class="space-y-2 group">
                            <label class="text-[11px] font-black text-brand-primary uppercase tracking-[0.2em]">Official Email</label>
                            <input type="email" name="email" required 
                                   class="w-full p-5 bg-gray-50 border-b-2 border-gray-200 focus:border-brand-gold focus:bg-white outline-none text-base lg:text-lg transition-all"
                                   placeholder="member@corporate.com">
                        </div>

                        {{-- Phone Number --}}
                        <div class="space-y-2 group">
                            <label class="text-[11px] font-black text-brand-primary uppercase tracking-[0.2em]">Phone Number</label>
                            <input type="tel" name="phone" required 
                                   class="w-full p-5 bg-gray-50 border-b-2 border-gray-200 focus:border-brand-gold focus:bg-white outline-none text-base lg:text-lg transition-all"
                                   placeholder="+62 8xx xxxx xxxx">
                        </div>

                        {{-- Password --}}
                        <div class="space-y-2 group">
                            <label class="text-[11px] font-black text-brand-primary uppercase tracking-[0.2em]">Account Password</label>
                            <input type="password" name="password" required 
                                   class="w-full p-5 bg-gray-50 border-b-2 border-gray-200 focus:border-brand-gold focus:bg-white outline-none text-base lg:text-lg transition-all"
                                   placeholder="Min. 8 alphanumeric characters">
                        </div>
                    </div>

                    {{-- Terms --}}
                    <div class="p-6 lg:p-8 bg-brand-light/50 border border-brand-primary/5 rounded-sm">
                        <div class="flex items-start gap-4">
                            <input type="checkbox" id="terms" required 
                                   class="mt-1 w-5 h-5 text-brand-primary border-gray-300 focus:ring-brand-gold rounded-sm cursor-pointer">
                            <label for="terms" class="text-sm lg:text-base text-gray-600 leading-relaxed cursor-pointer">
                                I confirm that all provided information is accurate and I agree to the 
                                <a href="#" class="text-brand-primary font-bold hover:text-brand-gold underline underline-offset-4 transition">Membership Agreement</a> 
                                and policies managed by PT Raga Nusa Property.
                            </label>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="pt-4 space-y-8">
                        <button type="submit" 
                                class="w-full bg-brand-primary text-white font-black py-6 lg:py-8 text-[13px] lg:text-[14px] uppercase tracking-[0.4em] hover:bg-brand-gold hover:shadow-2xl transition-all duration-500 shadow-xl rounded-sm">
                            Submit Enrollment Application
                        </button>
                        
                        <div class="flex flex-col lg:flex-row items-center justify-center gap-4 text-gray-500 text-sm">
                            <span>Already an established member?</span>
                            <a href="{{ route('login') }}" class="text-brand-primary font-black uppercase tracking-widest text-[11px] border-b-2 border-brand-gold pb-1 hover:text-brand-gold transition">
                                Access Portal &rarr;
                            </a>
                        </div>
                    </div>
                </form>

                {{-- Trust Badges --}}
                <div class="pt-16 grid grid-cols-1 md:grid-cols-3 gap-10 opacity-40">
                    <div class="flex items-center gap-4">
                        <span class="text-3xl">🛡️</span>
                        <p class="text-[9px] font-black uppercase tracking-widest leading-tight">Institutional <br> Data Protection</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-3xl">🏛️</span>
                        <p class="text-[9px] font-black uppercase tracking-widest leading-tight">Asset Management <br> Licensed Entity</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-3xl">📜</span>
                        <p class="text-[9px] font-black uppercase tracking-widest leading-tight">Legal Ownership <br> Guaranteed Title</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection