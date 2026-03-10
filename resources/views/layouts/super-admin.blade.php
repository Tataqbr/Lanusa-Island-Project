<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Lanusa Island</title>

    <link rel="shortcut icon" href="{{ asset('assets/icon.png') }}" type="image/x-icon">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.tailwindcss.min.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-primary': '#0A1D37',
                        'brand-gold': '#C5A358',
                    },
                    fontFamily: {
                        'jakarta': ['Plus Jakarta Sans', 'sans-serif'],
                        'serif': ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #C5A358; }
        
        .dt-container .dt-paging .dt-paging-button.current {
            background: #C5A358 !important;
            color: white !important;
            border-radius: 4px !important;
        }
    </style>
</head>

<body class="font-jakarta bg-gray-50 text-brand-primary">

    <div class="flex h-screen overflow-hidden">
        <aside class="hidden lg:flex lg:flex-col lg:w-72 bg-brand-primary text-white z-50">
            <div class="p-8 border-b border-white/10">
                <h1 class="font-serif text-2xl font-bold text-brand-gold">Lanusa Island</h1>
                <p class="text-[10px] tracking-[0.2em] uppercase text-gray-400 font-bold">Super Admin Panel</p>
            </div>

            <nav class="flex-1 p-6 overflow-y-auto">
                <ul class="space-y-2">
                    @php
                        $menus = [
                            ['route' => 'dashboard-super-admin', 'icon' => 'fa-home', 'label' => 'Dashboard'],
                            ['route' => 'destinations-super-admin', 'icon' => 'fa-earth-americas', 'label' => 'Destinations'],
                            ['route' => 'resorts-super-admin', 'icon' => 'fa-location-dot', 'label' => 'Resorts'],
                            ['route' => 'admins-super-admin', 'icon' => 'fa-users-gear', 'label' => 'Admins'],
                            ['route' => 'users-super-admin', 'icon' => 'fa-users', 'label' => 'Users'],
                            ['route' => 'membership-super-admin', 'icon' => 'fa-address-card', 'label' => 'Membership'],
                            ['route' => 'reports-super-admin', 'icon' => 'fa-file-invoice', 'label' => 'Reports'],
                            ['route' => 'contents-super-admin', 'icon' => 'fa-palette', 'label' => 'Contents'],
                        ];
                    @endphp

                    @foreach($menus as $menu)
                    <li>
                        <a href="{{ route($menu['route']) }}"
                            class="flex items-center p-3 rounded text-sm transition-all {{ Request::routeIs($menu['route']) ? 'bg-brand-gold text-brand-primary font-bold' : 'hover:bg-white/5 text-gray-300' }}">
                            <i class="fas {{ $menu['icon'] }} w-6 {{ Request::routeIs($menu['route']) ? 'text-brand-primary' : 'text-brand-gold' }}"></i>
                            <span>{{ $menu['label'] }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </nav>

            <div class="p-6 border-t border-white/10">
                <form method="POST" action="{{ route('logout-super-admin') }}">
                    @csrf
                    <button class="flex items-center w-full p-3 text-sm font-bold text-red-400 hover:bg-red-500/10 transition-colors">
                        <i class="fas fa-sign-out-alt w-6"></i>
                        <span>LOG OUT</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between shadow-sm">
                <div>
                    <h2 class="font-serif text-2xl font-bold text-brand-primary">@yield('title')</h2>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-xs font-bold uppercase tracking-widest text-brand-gold">Super Admin</span>
                    <div class="w-10 h-10 rounded-full bg-brand-primary border-2 border-brand-gold flex items-center justify-center text-brand-gold text-xs font-bold">SA</div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{-- Alpine.js harus sebelum Flowbite jika Anda memakai keduanya --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.tailwindcss.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable dengan opsi drawCallback
            // Ini PENTING agar Flowbite membaca ulang tombol modal setelah tabel berubah (paging/search)
            const tableConfig = {
                pageLength: 5,
                drawCallback: function() {
                    if (typeof initFlowbite === 'function') {
                        initFlowbite(); // Memanggil ulang inisialisasi Flowbite
                    }
                }
            };

            // Daftarkan semua ID tabel Anda di sini
            const tableIds = [
                '#booking-data', '#access-request', '#gateways', '#destinations-admin', 
                '#region', '#resorts-admin', '#users-admin', '#not-paid-admin', 
                '#membership-admin', '#available-space-admin', '#destination-history-admin', 
                '#payment-registration', '#admin-report', '#news', '#choose-plan'
            ];

            tableIds.forEach(id => {
                if ($(id).length) {
                    $(id).DataTable(tableConfig);
                }
            });
        });

        // Global Alert Functions
        @if (session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', timer: 2000, showConfirmButton: false });
        @endif

        @if (session('error'))
            Swal.fire({ icon: 'error', title: 'Gagal', text: '{{ session('error') }}' });
        @endif

        // Global Delete Confirmation
        function confirmDelete(event) {
            event.preventDefault();
            const form = event.target;
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data akan dihapus permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#C5A358",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        }
    </script>
</body>
</html>