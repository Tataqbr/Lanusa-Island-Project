<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><style>
@page { margin: 0; size: a4 portrait; }
* { box-sizing: border-box; }
html, body { margin: 0; padding: 0; width: 100%; height: 100%; font-family: 'Times-Roman', serif; font-size: 11pt; color: #1a1a1a; }
.gold-bar { background: #C5A47E; height: 10pt; width: 100%; position: absolute; top: 0; left: 0; }
.watermark { position: absolute; top: 40%; left: 15%; transform: rotate(-45deg); font-size: 60pt; color: rgba(197, 164, 126, 0.05); z-index: -1; font-weight: bold; white-space: nowrap; }
.container { padding: 40pt 50pt; position: relative; }
.logo-container { text-align: center; margin: 15pt 0; }
.header-title { text-align: center; border-bottom: 1pt solid #f0f0f0; padding-bottom: 10pt; margin-bottom: 20pt; }
.subtitle { color: #C5A47E; font-size: 9pt; letter-spacing: 4pt; text-transform: uppercase; font-weight: bold; }
.main-title { font-size: 26pt; color: #0A1D29; margin: 5pt 0; font-style: italic; }
.section-label { color: #C5A47E; font-size: 8pt; letter-spacing: 1.5pt; text-transform: uppercase; margin-top: 15pt; font-weight: bold; border-left: 2pt solid #C5A47E; padding-left: 8pt; }
.data-grid { width: 100%; margin-top: 8pt; border-collapse: collapse; }
.data-grid td { padding: 6pt 0; vertical-align: top; border-bottom: 0.5pt solid #f9f9f9; }
.label { font-size: 9pt; color: #888; text-transform: uppercase; width: 35%; }
.value { font-size: 11pt; color: #0A1D29; font-weight: bold; }
.benefits-list { margin: 4pt 0 0 0; padding-left: 12pt; }
.benefits-list li { font-size: 10pt; color: #4b5563; margin-bottom: 2pt; }
.warning-box { margin-top: 20pt; background: #fdfaf7; border: 1pt dashed #C5A47E; padding: 12pt; }
.warning-title { font-size: 9pt; color: #C5A47E; font-weight: bold; text-transform: uppercase; margin-bottom: 4pt; }
.warning-text { font-size: 9pt; color: #4b5563; text-align: justify; line-height: 1.4; }
.footer-policy { margin-top: 20pt; font-size: 8.5pt; color: #777; border-top: 1pt solid #f0f0f0; padding-top: 10pt; }
.footer { position: absolute; bottom: 30pt; left: 0; width: 100%; text-align: center; font-size: 8pt; color: #9ca3af; }
</style></head><body><div class="gold-bar"></div><div class="watermark">PT RAGA NUSA PROPERTY</div><div class="container"><div class="logo-container">@if(isset($logo) && $logo)<img src="{{ $logo }}" style="width: 110pt;">@else<h2 style="color: #0A1D29; letter-spacing: 7pt; margin: 0; font-size: 20pt;">LANUSA</h2>@endif</div><div class="header-title"><span class="subtitle">Institutional Asset Verification</span><h1 class="main-title">Digital Membership Certificate.</h1><p style="font-size: 9pt; color: #666; margin: 5pt 0;">Reference: {{ strtoupper($data->transaction_id) }}</p></div><div class="section-label">01. Asset Holder Information</div><table class="data-grid"><tr><td class="label">Legal Name</td><td class="value">{{ $data->name }}</td></tr><tr><td class="label">Email Association</td><td class="value">{{ $data->email }}</td></tr><tr><td class="label">Acquisition Date</td><td class="value">{{ date('d F Y', strtotime($data->join_date)) }}</td></tr></table><div class="section-label">02. Tier, Contract & Benefits</div><table class="data-grid"><tr><td class="label">Membership Tier</td><td class="value" style="color: #C5A47E;">{{ $data->plan_name }} Edition</td></tr><tr><td class="label">Contract Duration</td><td class="value">{{ $data->contract }}</td></tr><tr><td class="label">Access Code</td><td class="value" style="letter-spacing: 2pt;">{{ $data->access_code }}</td></tr><tr><td class="label">Benefits</td><td class="value"><ul class="benefits-list">@foreach($data->features as $feature)<li>{{ $feature }}</li>@endforeach</ul></td></tr></table><div class="section-label">03. Financial Summary</div><table class="data-grid"><tr><td class="label">Investment Amount</td><td class="value">IDR {{ number_format($data->amount, 0, ',', '.') }}</td></tr></table><div class="warning-box"><div class="warning-title">Confidentiality Agreement</div><p class="warning-text">This document contains sensitive institutional data. The Unique Access Code is strictly personal. Unauthorized disclosure may compromise asset security.</p></div><div class="footer-policy">By holding this certificate, you agree to the institutional guidelines of Lanusa Island under PT Raga Nusa Property.</div></div><div class="footer">Verified & Secured by PT Raga Nusa Property &bull; {{ date('Y') }}</div></body></html>