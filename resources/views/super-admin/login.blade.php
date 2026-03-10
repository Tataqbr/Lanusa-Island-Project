<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login Super Admin - Lanusa Island</title>
    
    <link rel="shortcut icon" href="{{ asset('assets/icon.png') }}" type="image/x-icon">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-primary': '#0A1D37', // Biru gelap mewah sesuai tema
                        'brand-gold': '#C5A358',    // Emas khas Lanusa
                    }
                }
            }
        }
    </script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0A1D37; /* brand-primary */
            background-image: radial-gradient(circle at center, #162d4a 0%, #0A1D37 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1.5rem;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            background: #ffffff;
            border-radius: 4px; /* Lebih kotak untuk kesan elegan/formal */
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            padding: 3.5rem 2.5rem;
            border-top: 6px solid #C5A358; /* Aksen Gold di atas */
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 0;
            border: none;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.95rem;
            transition: all 0.3s;
            background-color: transparent;
            border-radius: 0;
        }

        .form-input:focus {
            outline: none;
            border-bottom-color: #C5A358;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background-color: #0A1D37;
            color: white;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            font-size: 0.75rem;
            transition: all 0.3s;
            margin-top: 2rem;
            border: 1px solid #0A1D37;
        }

        .submit-btn:hover {
            background-color: #C5A358;
            border-color: #C5A358;
            color: #0A1D37;
        }

        .toggle-password {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            background: none;
            border: none;
        }

        /* Custom Swal for consistency */
        .custom-swal-popup { border-radius: 0 !important; font-family: 'Plus Jakarta Sans', sans-serif; }
        .custom-swal-button { background-color: #0A1D37 !important; border-radius: 0 !important; text-transform: uppercase; font-size: 0.7rem !important; letter-spacing: 0.1em; }
    </style>
</head>

<body>
    <div class="login-container">
        <form action="{{ route('proccess-login-super-admin') }}" method="POST">
            @csrf
            <div class="text-center mb-10">
                <span class="text-brand-gold font-bold text-[10px] tracking-[0.4em] uppercase block mb-2">Internal Access</span>
                <h1 class="font-serif text-3xl text-brand-primary font-bold">Lanusa Island</h1>
                <div class="w-12 h-[2px] bg-brand-gold mx-auto mt-4"></div>
            </div>

            <div class="space-y-6">
                <div class="relative">
                    <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Username</label>
                    <input 
                        type="text" 
                        class="form-input @error('username') border-red-500 @enderror" 
                        required 
                        name="username" 
                        value="{{ old('username') }}"
                        placeholder="Enter your username"
                    >
                    @error('username')
                        <p class="text-red-500 text-[10px] mt-1 uppercase font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="relative">
                    <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Password</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password"
                            class="form-input @error('password') border-red-500 @enderror"
                            required 
                            placeholder="••••••••"
                        >
                        <button type="button" id="togglePassword" class="toggle-password">
                            <i class="far fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-[10px] mt-1 uppercase font-bold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <button type="submit" class="submit-btn">
                Authorize Login
            </button>
            
            <div class="mt-8 text-center">
                <p class="text-[10px] text-gray-400 uppercase tracking-[0.2em]">
                    &copy; 2025 Lanusa Island Management
                </p>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            let passwordField = document.getElementById('password');
            let eyeIcon = document.getElementById('eyeIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });

        // SweetAlert configurations
        document.addEventListener("DOMContentLoaded", function() {
            const commonConfig = {
                confirmButtonText: 'CLOSE',
                customClass: {
                    popup: 'custom-swal-popup',
                    confirmButton: 'custom-swal-button'
                }
            };

            @if (session('success'))
                Swal.fire({
                    ...commonConfig,
                    icon: 'success',
                    title: 'AUTHORIZED',
                    text: '{{ session('success') }}',
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    ...commonConfig,
                    icon: 'error',
                    title: 'ACCESS DENIED',
                    text: '{{ session('error') }}',
                });
            @endif
        });
    </script>
</body>
</html>