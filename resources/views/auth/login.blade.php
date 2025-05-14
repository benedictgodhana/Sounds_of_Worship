<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sounds of Worship</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Futura LT';
            src: url('/fonts/futura-lt/FuturaLT-Book.ttf') format('woff2'),
                url('/fonts/futura-lt/FuturaLT.ttf') format('woff'),
                url('/fonts/futura-lt/FuturaLT-Condensed.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'Futura LT', sans-serif;
            background-color: #f9fafb;
            color: #1f2937;
        }

        .auth-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .auth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-gray-50 antialiased">
    @include ('layouts.navigation')

    <!-- Login Form -->
    <section class="py-16">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <div class="auth-card p-8">
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Email Address</label>
                        <div class="relative">
                            <input type="email"
                                   name="email"
                                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                   placeholder="name@example.com"
                                   value="{{ old('email') }}"
                                   required
                                   autocomplete="email"
                                   autofocus>
                            <i class="fas fa-envelope absolute right-3 top-3 text-gray-400"></i>
                        </div>
                        @error('email')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Password</label>
                        <div class="relative">
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                   placeholder="••••••••"
                                   required
                                   autocomplete="current-password">
                            <span class="password-toggle" onclick="togglePassword()">
                                <i class="fas fa-eye-slash text-gray-400"></i>
                            </span>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox"
                                   name="remember"
                                   id="remember"
                                   class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded"
                                   {{ old('remember') ? 'checked' : '' }}>
                            <label class="ml-2 text-gray-600" for="remember">Remember me</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-primary hover:text-primary-dark">
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                            class="w-full bg-primary text-white py-3 rounded-lg hover:bg-primary-dark transition-colors font-medium">
                        Sign In
                    </button>

                    <div class="relative text-center">
                        <span class="px-4 bg-white relative z-10 text-gray-500">Or continue with</span>
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                    </div>

                    <div class="flex gap-4 justify-center">
                        <a href="#" class="p-2 border rounded-lg hover:bg-gray-50">
                            <img src="https://img.icons8.com/color/48/000000/google-logo.png"
                                 class="w-6 h-6" alt="Google">
                        </a>
                        <a href="#" class="p-2 border rounded-lg hover:bg-gray-50">
                            <img src="https://img.icons8.com/color/48/000000/facebook.png"
                                 class="w-6 h-6" alt="Facebook">
                        </a>
                    </div>

                    <p class="text-center text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-primary hover:text-primary-dark">Sign up</a>
                    </p>
                </form>
            </div>
        </div>
    </section>


    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle i');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.innerHTML = `
                <span class="flex items-center justify-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing...
                </span>
            `;
            submitButton.disabled = true;
        });
    </script>
</body>
</html>
