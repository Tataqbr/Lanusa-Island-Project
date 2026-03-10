<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page { margin: 0; }
        body { font-family: 'Times-Roman', serif; color: #1a1a1a; margin: 0; padding: 0; }
        
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 50px;
            color: rgba(197, 164, 126, 0.08);
            z-index: -1000;
            white-space: nowrap;
            font-weight: bold;
            letter-spacing: 10px;
        }

        .gold-bar { background: #C5A47E; height: 8px; width: 100%; }
        .container { padding: 50px; position: relative; }
        .logo-container { text-align: center; margin-bottom: 30px; }
        .logo { width: 140px; }
        
        .header-title { text-align: center; margin-bottom: 40px; }
        .subtitle { color: #C5A47E; font-size: 10px; letter-spacing: 5px; text-transform: uppercase; font-weight: bold; }
        .main-title { font-size: 38px; color: #0A1D29; margin: 10px 0; font-style: italic; }
        
        .category-label { color: #C5A47E; font-size: 11px; letter-spacing: 3px; text-transform: uppercase; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-top: 30px; margin-bottom: 15px; font-weight: bold; }
        .faq-item { margin-bottom: 25px; }
        .question { font-size: 15px; color: #0A1D29; font-weight: bold; margin-bottom: 8px; }
        .answer { font-size: 12px; color: #4b5563; line-height: 1.6; text-align: justify; }
        
        .footer { position: fixed; bottom: 30px; width: 100%; text-align: center; font-size: 10px; color: #9ca3af; }
    </style>
</head>
<body>
    <div class="watermark">PT RAGA NUSA PROPERTY</div>
    <div class="gold-bar"></div>
    
    <div class="container">
        <div class="logo-container">
            @if($logo)
                <img src="{{ $logo }}" class="logo">
            @else
                <h2 style="color: #0A1D29; letter-spacing: 5px; margin: 0;">LANUSA</h2>
            @endif
        </div>

        <div class="header-title">
            <span class="subtitle">Information Center</span>
            <h1 class="main-title">Institutional Clarity.</h1>
            <p style="font-size: 12px; color: #666;">Official Summary of Membership & Legal Structures</p>
        </div>

        {{-- CATEGORY 01: OWNERSHIP & LEGALITY --}}
        <div class="category-label">01. Ownership & Legality</div>
        <div class="faq-item">
            <div class="question">What exactly is the Lanusa Island timeshare model?</div>
            <div class="answer">
                It is a right-to-use property ownership model managed by PT Raga Nusa Property. This model provides a legally protected asset that can be used, sold, or inherited. Since we operate on a bespoke institutional level, your ownership is verified through an encrypted certificate issued directly to your legal identity.
            </div>
        </div>

        {{-- CATEGORY 02: PAYMENT, SECURITY & REFUNDS --}}
        <div class="category-label">02. Payment, Security & Refunds</div>
        <div class="faq-item">
            <div class="question">What are the accepted payment methods and security?</div>
            <div class="answer">
                We utilize PCI-DSS compliant gateways accepting <strong>Credit Cards (Visa/Mastercard) and Bank Transfers (Virtual Accounts)</strong>. To ensure maximum security, <strong>Lanusa Island does not store your card data</strong>; all financial processing is handled through 256-bit SSL encrypted institutional portals.
            </div>
        </div>
        <div class="faq-item">
            <div class="question">What is the refund and cancellation policy?</div>
            <div class="answer">
                We provide a <strong>14-day cooling-off period</strong>. Cancellations within this window are eligible for a full refund, processed back to your original payment method within <strong>7 to 14 working days</strong>. Reservation rescheduling is available if requested 30 days prior to the arrival date.
            </div>
        </div>

        {{-- CATEGORY 03: ACCESS & SERVICE DELIVERY --}}
        <div class="category-label">03. Access & Service Delivery</div>
        <div class="faq-item">
            <div class="question">Why is there no login or member dashboard on the website?</div>
            <div class="answer">
                To ensure maximum privacy and institutional security, <strong>Lanusa Island operates without a public-facing authentication system</strong>. We do not require you to create or manage an account. All membership interactions, credentials, and booking confirmations are managed securely via <strong>Direct Email Communication</strong> and your <strong>Unique Membership Code</strong>.
            </div>
        </div>
        <div class="faq-item">
            <div class="question">How and when will I receive my membership details?</div>
            <div class="answer">
                Upon successful payment, our system automatically generates your <strong>Digital Membership Certificate</strong> and <strong>Unique Access Code</strong>. These documents are delivered to your registered email address within 24 hours. For all future bookings, you simply provide this code to our digital concierge via email or official contact channels.
            </div>
        </div>
    </div>

    <div class="footer">
        Property of PT Raga Nusa Property &bull; Institutional Guidelines {{ date('Y') }}
    </div>
</body>
</html>