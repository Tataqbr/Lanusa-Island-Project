<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acquisition Interrupted | Lanusa Island</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,600;1,600&family=Montserrat:wght@300;700;900" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-primary': '#0F172A',
                        'brand-gold': '#C5A059',
                        'brand-error': '#991B1B', // Muted deep red
                    },
                    fontFamily: {
                        serif: ['Cormorant Garamond', 'serif'],
                        sans: ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .fade-in { animation: fadeIn 1.2s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-brand-primary flex items-center justify-center min-h-screen p-6 overflow-hidden">
    
    <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] pointer-events-none select-none">
        <h1 class="text-[18vw] font-serif font-bold text-white uppercase tracking-tighter">FAILED</h1>
    </div>

    <div class="max-w-xl w-full bg-white p-12 lg:p-20 shadow-2xl relative z-10 fade-in border-t-4 border-brand-error">
        <div class="text-center space-y-10">
            
            <div class="flex justify-center">
                <div class="w-20 h-20 border border-red-50 flex items-center justify-center rounded-full bg-red-50/30">
                    <svg class="w-10 h-10 text-brand-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>

            <div class="space-y-4">
                <h5 class="text-brand-error font-black text-[10px] tracking-[0.5em] uppercase">Transaction Interrupted</h5>
                <h1 class="font-serif text-4xl lg:text-5xl text-brand-primary font-bold leading-tight">
                    Acquisition <br><span class="italic font-light">Unsuccessful.</span>
                </h1>
            </div>

            <div class="h-[1px] w-12 bg-gray-200 mx-auto"></div>

            <p class="text-gray-500 text-sm leading-relaxed font-light px-4">
                We encountered an institutional-grade error during the authorization of your payment. No funds were captured, and your membership status remains inactive.
            </p>

            <div class="pt-6 space-y-4">
                <a href="/" class="inline-block w-full py-5 bg-brand-primary text-white font-black text-[10px] uppercase tracking-[0.4em] hover:bg-brand-gold transition-all duration-500 shadow-xl">
                    Try Again
                </a>
                
                <div class="pt-4">
                    <p class="text-[9px] text-gray-400 uppercase tracking-widest leading-loose">
                        Need assistance? Contact our <br>
                        <a href="mailto:support@lanusaresorts.com" class="text-brand-primary font-bold underline">Institutional Support Team</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>