<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page { margin: 0; size: a4 portrait; }
        body { font-family: 'Times-Roman', serif; font-size: 11pt; color: #1a1a1a; margin: 0; padding: 40pt 50pt; }
        
        /* Layout Elements */
        .gold-bar { background: #C5A47E; height: 8pt; width: 100%; position: absolute; top: 0; left: 0; }
        .watermark { position: absolute; top: 35%; left: 10%; transform: rotate(-45deg); font-size: 45pt; color: rgba(197, 164, 126, 0.04); z-index: -1; font-weight: bold; white-space: nowrap; text-transform: uppercase; }
        
        .logo-container { text-align: center; margin-bottom: 20pt; }
        .logo-container img { width: 120pt; height: auto; }
        
        .header-title { text-align: center; border-bottom: 1pt solid #C5A47E; padding-bottom: 15pt; margin-bottom: 25pt; }
        .subtitle { color: #C5A47E; font-size: 9pt; letter-spacing: 4pt; text-transform: uppercase; font-weight: bold; }
        .main-title { font-size: 24pt; color: #0A1D29; margin: 8pt 0; font-style: italic; }
        
        .section-label { color: #C5A47E; font-size: 8.5pt; letter-spacing: 2pt; text-transform: uppercase; margin-top: 25pt; font-weight: bold; border-left: 3pt solid #C5A47E; padding-left: 10pt; background: #fdfaf7; padding: 4pt; }
        
        .data-grid { width: 100%; margin-top: 12pt; border-collapse: collapse; }
        .data-grid td { padding: 8pt 0; vertical-align: top; border-bottom: 0.5pt solid #f0f0f0; }
        .label { font-size: 9pt; color: #888; text-transform: uppercase; width: 40%; }
        .value { font-size: 11pt; color: #0A1D29; font-weight: bold; }
        
        .warning-box { margin-top: 30pt; background: #fdfaf7; border: 0.5pt solid #C5A47E; padding: 15pt; }
        .warning-title { font-size: 9pt; color: #C5A47E; font-weight: bold; text-transform: uppercase; margin-bottom: 6pt; }
        .warning-text { font-size: 9pt; color: #4b5563; text-align: justify; line-height: 1.5; }
        
        .footer { position: absolute; bottom: 30pt; left: 0; width: 100%; text-align: center; font-size: 8pt; color: #9ca3af; }
    </style>
</head>
<body>
    <div class="gold-bar"></div>
    <div class="watermark">PT RAGA NUSA PROPERTY</div>
    
    <div class="logo-container">
        <img src="{{ $base64Logo }}" alt="Logo">
    </div>

    <div class="header-title">
        <span class="subtitle">Official Reservation Certificate</span>
        <h1 class="main-title">Digital Membership Contract.</h1>
        <p style="font-size: 9pt; color: #666;">Reference: {{ strtoupper($booking->transaction_id) }}</p>
    </div>

    <div class="section-label">01. Principal Asset Holder</div>
    <table class="data-grid">
        <tr><td class="label">Legal Name</td><td class="value">{{ $booking->user_name }}</td></tr>
        <tr><td class="label">Contact Email</td><td class="value">{{ $booking->email }}</td></tr>
        <tr><td class="label">Verified Phone</td><td class="value">{{ $booking->phone }}</td></tr>
    </table>

    <div class="section-label">02. Reservation Details</div>
    <table class="data-grid">
        <tr><td class="label">Resort Estate</td><td class="value" style="color: #C5A47E;">{{ $booking->resort_name }}</td></tr>
        <tr><td class="label">Stay Duration</td><td class="value">{{ $booking->stay_duration }} Night(s)</td></tr>
        <tr><td class="label">Location</td><td class="value">{{ $booking->location }}</td></tr>
    </table>

    <div class="section-label">03. Financial Summary</div>
    <table class="data-grid">
        <tr><td class="label">Investment Amount</td><td class="value">IDR {{ number_format($booking->amount, 0, ',', '.') }}</td></tr>
    </table>

    <div class="warning-box">
        <div class="warning-title">Confidentiality Agreement</div>
        <p class="warning-text">This document serves as an official proof of acquisition. The details contained herein are strictly personal and intended for use at the Lanusa Island Concierge. Unauthorized reproduction or disclosure is strictly prohibited under PT Raga Nusa Property institutional guidelines.</p>
    </div>

    <div class="footer">
        Verified & Secured by PT Raga Nusa Property &bull; {{ $date }}
    </div>
</body>
</html>