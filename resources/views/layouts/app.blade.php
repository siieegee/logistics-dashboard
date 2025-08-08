<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Logistics Proximity Dashboard')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>

    <style>
        #map {
            height: 300px;
            width: 100%;
            border-radius: 0;
            margin-bottom: 1.5rem;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                        0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .alert-success {
            background-color: #d1fae5;
            border-color: #a7f3d0;
            color: #065f46;
        }

        .alert-danger {
            background-color: #fee2e2;
            border-color: #fecaca;
            color: #991b1b;
        }

        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        .spinner {
            border: 3px solid #f3f4f6;
            border-top: 3px solid #3b82f6;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-[#264653] text-white min-h-screen">

    <!-- Navbar -->
    <nav class="bg-[#1b3a4b] shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo / Brand -->
                <a href="{{ url('/') }}" class="text-lg font-bold text-white hover:text-green-400">
                    Logistics Dashboard
                </a>

                <!-- Menu Links -->
                <div class="hidden md:flex space-x-6">
                    <a href="{{ url('/') }}" class="hover:text-green-400">Home</a>
                    <a href="{{ route('proximity.form') }}" class="hover:text-green-400">Check Proximity</a>
                    <a href="{{ route('logs.index') }}" class="hover:text-green-400">Proximity History</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="w-full">
        @yield('content')
    </main>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
    <script>
        window.Laravel = {
            csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };

        if (window.fetch) {
            const originalFetch = window.fetch;
            window.fetch = function(url, options) {
                options = options || {};
                options.headers = options.headers || {};
                options.headers['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
                options.headers['X-Requested-With'] = 'XMLHttpRequest';
                return originalFetch(url, options);
            };
        }
    </script>

    @stack('scripts')
</body>
</html>
