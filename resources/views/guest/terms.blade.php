@extends('layouts.guest')

@section('title', 'Terms of Service | Lanusa Island Membership Agreement')

@section('content')
    {{-- 1. FORMAL HEADER --}}
    <section class="relative pt-50 pb-20 bg-brand-primary overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px] relative z-20">
            <div class="max-w-4xl space-y-6" data-aos="fade-right">
                <div class="flex items-center gap-4">
                    <span class="w-12 h-[1px] bg-brand-gold"></span>
                    <span class="text-brand-gold font-black text-[10px] tracking-[0.5em] uppercase">Member Agreement</span>
                </div>
                <h1 class="font-serif text-white text-[40px] lg:text-[70px] leading-tight font-bold">
                    Terms <span class="italic font-light text-brand-gold">&</span> Conditions.
                </h1>
                <p class="text-gray-300 text-lg lg:text-xl font-light leading-relaxed max-w-2xl">
                    Last Updated: December 2025. These terms constitute a legally binding agreement between the Member and PT Raga Nusa Property regarding the Lanusa Island ecosystem.
                </p>
            </div>
        </div>
        {{-- Subtle Institutional Watermark --}}
        <div class="absolute bottom-0 right-0 opacity-[0.05] pointer-events-none">
            <span class="text-[200px] font-serif font-bold text-white mr-10 -mb-10 uppercase tracking-tighter">Legal</span>
        </div>
    </section>

    {{-- 2. TERMS CONTENT SECTION --}}
    <section class="py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-6 lg:px-[70px]">
            <div class="flex flex-col lg:flex-row gap-20">
                
                {{-- Left Sidebar: Index (Sticky) --}}
                <div class="lg:w-1/4 hidden lg:block">
                    <div class="sticky top-32 space-y-6 border-l border-gray-100 pl-8">
                        <h5 class="text-brand-primary font-black text-[10px] tracking-widest uppercase mb-10">Contract Index</h5>
                        <a href="#eligibility" class="block text-sm text-gray-400 hover:text-brand-gold transition font-bold uppercase tracking-wider">01. Eligibility</a>
                        <a href="#delivery" class="block text-sm text-gray-400 hover:text-brand-gold transition font-bold uppercase tracking-wider">02. Service Delivery</a>
                        <a href="#ownership" class="block text-sm text-gray-400 hover:text-brand-gold transition font-bold uppercase tracking-wider">03. Ownership Rights</a>
                        <a href="#financials" class="block text-sm text-gray-400 hover:text-brand-gold transition font-bold uppercase tracking-wider">04. Financial & Security</a>
                        <a href="#termination" class="block text-sm text-gray-400 hover:text-brand-gold transition font-bold uppercase tracking-wider">05. Refund & Termination</a>
                    </div>
                </div>

                {{-- Right Column: Detailed Clauses --}}
                <div class="lg:w-3/4 space-y-20">
                    
                    {{-- 01. Eligibility --}}
                    <div id="eligibility" class="space-y-6" data-aos="fade-up">
                        <h3 class="font-serif text-3xl font-bold text-brand-primary">01. Enrollment Eligibility</h3>
                        <p class="text-gray-600 leading-relaxed text-justify lg:text-lg">
                            To enroll in a Lanusa Island Membership, individuals must be at least 21 years of age and possess the legal capacity to enter into binding financial contracts. By initiating an enrollment application, you represent that all institutional and personal data provided—including your verified email address—is accurate and verifiable.
                        </p>
                    </div>

                    {{-- 02. Service Delivery (New - Mandatory for PG) --}}
                    <div id="delivery" class="space-y-6" data-aos="fade-up">
                        <h3 class="font-serif text-3xl font-bold text-brand-primary">02. Digital Service Delivery</h3>
                        <p class="text-gray-600 leading-relaxed text-justify">
                            As Lanusa Island operates on an automated direct-to-payment model, your Email Confirmation serves as the official proof of transaction. Upon successful payment, your Unique Membership Code and Digital Welcome Pack will be delivered to your registered email within a maximum of 24 hours.
                        </p>
                    </div>

                    {{-- 03. Booking & Membership Obligation --}}
                    <div id="booking" class="space-y-6" data-aos="fade-up">
                        <h3 class="font-serif text-3xl font-bold text-brand-primary">03. Booking & Membership Obligation</h3>
                        <p class="text-gray-600 leading-relaxed text-justify lg:text-lg">
                            Access to Lanusa Island’s global portfolio and concierge services is <strong>exclusive to active members</strong>. To initiate a property booking or utilize any member privileges, an individual must possess a valid <strong>Unique Membership Code</strong> issued by PT Raga Nusa Property. 
                        </p>
                        <p class="text-gray-600 leading-relaxed text-justify">
                            Reservations cannot be processed for non-members. By purchasing a membership, you understand that your access to the booking system is contingent upon the successful verification of your membership status and the availability of nights within your specific tier.
                        </p>
                    </div>

                    {{-- 04. Ownership Rights --}}
                    <div id="ownership" class="space-y-6" data-aos="fade-up">
                        <h3 class="font-serif text-3xl font-bold text-brand-primary">04. Nature of Ownership</h3>
                        <p class="text-gray-600 leading-relaxed text-justify">
                            Membership tiers (Silver, Gold, and Platinum) represent a "Right-to-Use" asset. Since no mandatory user dashboard is required for purchase, the Unique Membership Code is the sole identifier for your assets.
                        </p>
                        <div class="p-6 bg-gray-50 border-l-4 border-brand-gold italic text-brand-primary font-medium">
                            "Platinum Title holders possess fully transferable rights, allowing for the sale or inheritance of the asset under the supervision of our legal department."
                        </div>
                    </div>

                    {{-- 05. Financial & Security (Enhanced for PG) --}}
                    <div id="financials" class="space-y-6" data-aos="fade-up">
                        <h3 class="font-serif text-3xl font-bold text-brand-primary">05. Financial Integrity & Payment Security</h3>
                        <p class="text-gray-600 leading-relaxed text-justify">
                            The Member agrees to the one-time investment fee and the transparent Annual Maintenance Fee. All transactions are processed through PCI-DSS compliant payment gateways using 256-bit SSL encryption. 
                        </p>
                        <p class="text-gray-600 leading-relaxed text-justify font-bold text-brand-primary">
                            Lanusa Island does not store full credit card numbers or sensitive financial credentials on its local infrastructure.
                        </p>
                    </div>

                    {{-- 06. Termination & Refund (Crucial for PG) --}}
                    <div id="termination" class="space-y-6" data-aos="fade-up">
                        <h3 class="font-serif text-3xl font-bold text-brand-primary">06. Termination & Refund Policy</h3>
                        <p class="text-gray-600 leading-relaxed text-justify">
                            Members may terminate their agreement at any time. We offer a 14-day Cooling-Off Period for new enrollments. Approved refund requests within this window will be credited back to the original payment method within 7 to 14 working days, depending on the issuing bank's policy.
                        </p>
                        <p class="text-gray-600 leading-relaxed text-justify">
                            After the cooling-off period, investment fees are non-refundable. Any unauthorized chargebacks will result in immediate suspension of the Membership Code.
                        </p>
                    </div>

                    {{-- Footer of content --}}
                    <div class="pt-16 border-t border-gray-100">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">
                                Jurisdiction: Republic of Indonesia <br>
                                Management: PT Raga Nusa Property <br>
                                Contact: <span class="text-brand-primary">admin@lanusa-island.com</span>
                            </p>
                            <a href="{{ route('privacy') }}" class="text-[10px] text-brand-gold font-bold uppercase tracking-widest hover:underline">
                                View Privacy Policy
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection