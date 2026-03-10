@extends('layouts.guest')

@section('title', 'Frequently Asked Questions | Lanusa Island')

@section('content')
    {{-- 1. LUXURY HEADER --}}
    <section class="relative pt-50 pb-24 bg-brand-primary overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px] relative z-20">
            <div class="max-w-4xl space-y-8" data-aos="fade-right">
                <div class="flex items-center gap-4">
                    <span class="w-12 h-[1px] bg-brand-gold"></span>
                    <span class="text-brand-gold font-black text-[10px] tracking-[0.5em] uppercase">Information Center</span>
                </div>
                <h1 class="font-serif text-white text-[45px] lg:text-[80px] leading-[1.1] font-bold">
                    Institutional <br> <span class="italic font-light text-brand-gold">Clarity.</span>
                </h1>
                <p class="text-gray-300 text-lg lg:text-2xl font-light leading-relaxed max-w-2xl">
                    Detailed insights into our ownership model, legal structures, and member privileges managed by PT Raga Nusa Property.
                </p>
            </div>
        </div>
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none flex items-center justify-center">
            <span class="text-[500px] font-serif font-bold text-white">?</span>
        </div>
    </section>

    {{-- 2. FAQ ACCORDION SECTION --}}
    <section class="py-24 lg:py-32 bg-white">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="max-w-5xl mx-auto">
                <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white text-brand-primary"
                    data-inactive-classes="text-gray-500">

                    {{-- CATEGORY: OWNERSHIP --}}
                    <div class="mb-12">
                        <h4 class="text-brand-gold font-black text-[11px] tracking-[0.4em] uppercase mb-8 pb-4 border-b border-gray-100">
                            01. Ownership & Legality</h4>

                        {{-- Q1 --}}
                        <h2 id="accordion-flush-heading-1">
                            <button type="button" class="flex items-center justify-between w-full py-8 font-serif text-2xl text-left border-b border-gray-100 group" data-accordion-target="#accordion-flush-body-1">
                                <span>What exactly is the Lanusa Island timeshare model?</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-brand-gold" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-flush-body-1" class="hidden">
                            <div class="py-8 border-b border-gray-100">
                                <p class="text-gray-600 leading-relaxed lg:text-lg text-justify">It is a right-to-use property ownership model managed by PT Raga Nusa Property. This model provides a legally protected asset that can be used, sold, or inherited. Since we operate on a bespoke institutional level, your ownership is verified through an encrypted certificate issued directly to your legal identity.</p>
                            </div>
                        </div>
                    </div>

                    {{-- CATEGORY: FINANCE & COMPLIANCE (PG AUDIT POINTS) --}}
                    <div class="mb-12">
                        <h4 class="text-brand-gold font-black text-[11px] tracking-[0.4em] uppercase mb-8 pb-4 border-b border-gray-100">
                            02. Payment, Security & Refunds</h4>

                        {{-- Q2 --}}
                        <h2 id="accordion-flush-heading-2">
                            <button type="button" class="flex items-center justify-between w-full py-8 font-serif text-2xl text-left border-b border-gray-100 group" data-accordion-target="#accordion-flush-body-2">
                                <span>What are the accepted payment methods and security?</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-brand-gold" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-flush-body-2" class="hidden">
                            <div class="py-8 border-b border-gray-100">
                                <p class="text-gray-600 leading-relaxed lg:text-lg text-justify">We utilize PCI-DSS compliant gateways accepting <strong>Credit Cards (Visa/Mastercard) and Bank Transfers (Virtual Accounts)</strong>. To ensure maximum security, <strong>Lanusa Island does not store your card data</strong>; all financial processing is handled through 256-bit SSL encrypted institutional portals.</p>
                            </div>
                        </div>

                        {{-- Q3 --}}
                        <h2 id="accordion-flush-heading-3">
                            <button type="button" class="flex items-center justify-between w-full py-8 font-serif text-2xl text-left border-b border-gray-100 group" data-accordion-target="#accordion-flush-body-3">
                                <span>What is the refund and cancellation policy?</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-brand-gold" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-flush-body-3" class="hidden">
                            <div class="py-8 border-b border-gray-100">
                                <p class="text-gray-600 leading-relaxed lg:text-lg text-justify">We provide a <strong>14-day cooling-off period</strong>. Cancellations within this window are eligible for a full refund, processed back to your original payment method within <strong>7 to 14 working days</strong>. Reservation rescheduling is available if requested 30 days prior to the arrival date.</p>
                            </div>
                        </div>
                    </div>

                    {{-- CATEGORY: NO-AUTH MODEL (THE POINT YOU REQUESTED) --}}
                    <div class="mb-12">
                        <h4 class="text-brand-gold font-black text-[11px] tracking-[0.4em] uppercase mb-8 pb-4 border-b border-gray-100">
                            03. Access & Service Delivery</h4>

                        {{-- Q4: EXPLAINING NO-AUTH MODEL --}}
                        <h2 id="accordion-flush-heading-4">
                            <button type="button" class="flex items-center justify-between w-full py-8 font-serif text-2xl text-left border-b border-gray-100 group" data-accordion-target="#accordion-flush-body-4">
                                <span>Why is there no login or member dashboard on the website?</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-brand-gold" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-flush-body-4" class="hidden">
                            <div class="py-8 border-b border-gray-100">
                                <p class="text-gray-600 leading-relaxed lg:text-lg text-justify">To ensure maximum privacy and institutional security, <strong>Lanusa Island operates without a public-facing authentication system</strong>. We do not require you to create or manage an account. All membership interactions, credentials, and booking confirmations are managed securely via <strong>Direct Email Communication</strong> and your <strong>Unique Membership Code</strong>.</p>
                            </div>
                        </div>

                        {{-- Q5: EXPLAINING DELIVERY --}}
                        <h2 id="accordion-flush-heading-5">
                            <button type="button" class="flex items-center justify-between w-full py-8 font-serif text-2xl text-left border-b border-gray-100 group" data-accordion-target="#accordion-flush-body-5">
                                <span>How and when will I receive my membership details?</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-brand-gold" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-flush-body-5" class="hidden">
                            <div class="py-8 border-b border-gray-100">
                                <p class="text-gray-600 leading-relaxed lg:text-lg text-justify">Upon successful payment, our system automatically generates your <strong>Digital Membership Certificate</strong> and <strong>Unique Access Code</strong>. These documents are delivered to your registered email address within 24 hours. For all future bookings, you simply provide this code to our digital concierge via email or official contact channels.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- 3. UNANSWERED QUESTIONS CTA --}}
    <section class="py-24 bg-gray-50 border-t border-gray-100">
        <div class="container mx-auto px-6 lg:px-[70px] text-center space-y-10">
            <div class="space-y-4">
                <h2 class="font-serif text-3xl lg:text-5xl font-bold text-brand-primary">Still Seeking Answers?</h2>
                <p class="text-gray-500 text-lg max-w-2xl mx-auto">Our professional consultants are available for a one-on-one institutional briefing to explain the financial benefits in detail.</p>
            </div>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="{{ route('concierge') }}" class="bg-brand-primary text-white font-black px-12 py-5 text-[11px] uppercase tracking-[0.3em] hover:bg-brand-gold transition shadow-xl">Contact Concierge</a>
                <a href="{{ route('download-faq') }}" class="border border-brand-primary text-brand-primary font-black px-12 py-5 text-[11px] uppercase tracking-[0.3em] hover:bg-brand-primary hover:text-white transition">Download Brochure</a>
            </div>
        </div>
    </section>
@endsection