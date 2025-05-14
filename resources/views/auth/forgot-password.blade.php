<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maritime System - Reset Password</title>
    <!-- Toastr for notifications -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

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
            margin: 0;
            font-family: 'Futura LT', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-cover bg-center" style="            background-image: url('https://images.unsplash.com/photo-1519681393784-d120267933ba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80'); /* Replace with your image URL */
">
    <div class="min-h-screen flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
        <div class="bg-white/95 backdrop-blur-sm rounded-lg w-full max-w-md p-6 sm:p-8">
            <!-- Maritime System Logo (Bigger) -->
            <div class="flex justify-center mb-6">
                <img src="/images/logo.png" alt="Maritime System Logo" class="w-32 h-32 sm:w-48 sm:h-48">
            </div>

            <h2 class="text-2xl sm:text-3xl font-semibold text-center text-gray-800 mb-6">
                Reset Password
            </h2>

            <div class="mb-6 text-sm text-gray-600">
                Forgot your password? No problem. Just let us know your email address, and we will email you a password reset link that will allow you to choose a new one.
            </div>

            <!-- Status Message Container -->
            <div id="status-message" class="mb-4 text-sm text-green-600 hidden"></div>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="space-y-1">
                    <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <input
                            id="email"
                            class="pl-10 w-full rounded-md border border-gray-300 py-2.5 px-3 focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            type="email"
                            name="email"
                            required
                            autofocus />
                        <div class="mt-1 text-red-500 text-sm" id="email-error"></div>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="w-full justify-center bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-md transition-colors">
                        Email Password Reset Link
                    </button>
                </div>

                <!-- Back to Login Link -->
                <div class="text-center mt-4">
                    <a href="/login" class="text-sm text-blue-600 hover:text-blue-700">
                        Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toast configuration
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };

        // Form submission handling
        document.getElementById('resetForm')?.addEventListener('submit', function(e) {
            e.preventDefault();

            toastr.info('Processing your request...', 'Maritime System');

            // Simulate API call
            setTimeout(() => {
                toastr.success('Password reset link has been sent to your email.', 'Success');
            }, 2000);
        });

        // Example error handling
        function showError(message) {
            toastr.error(message);
            document.getElementById('email-error').textContent = message;
        }

        // Example success handling
        function showSuccess(message) {
            toastr.success(message);
            document.getElementById('status-message').textContent = message;
            document.getElementById('status-message').classList.remove('hidden');
        }
    </script>
</body>
</html>
