<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Ghoroya Oishorjo')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Green Tree Theme
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        },
                        forest: {
                            50: '#f7fee7',
                            100: '#ecfccb',
                            200: '#d9f99d',
                            300: '#bef264',
                            400: '#a3e635',
                            500: '#84cc16',
                            600: '#65a30d',
                            700: '#4d7c0f',
                            800: '#3f6212',
                            900: '#365314',
                        },
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'ui-sans-serif', 'system-ui'],
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                        'tree-pattern': "url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\" fill=\"%23f0fdf4\"><circle cx=\"20\" cy=\"20\" r=\"2\" opacity=\"0.3\"/><circle cx=\"80\" cy=\"40\" r=\"1.5\" opacity=\"0.2\"/><circle cx=\"40\" cy=\"70\" r=\"1\" opacity=\"0.4\"/><circle cx=\"70\" cy=\"80\" r=\"2.5\" opacity=\"0.1\"/></svg>')",
                    }
                }
            }
        }
    </script>
    
    @stack('styles')
</head>
<body class="min-h-screen bg-gradient-to-br from-primary-50 via-emerald-50 to-forest-50 font-sans">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-lg border-b border-primary-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3">
                        <img src="{{ asset('logo/ঘরোয়া-1-1-300x158.webp') }}" 
                             alt="Ghoroya Oishorjo" 
                             class="h-12 w-auto object-contain">
                    </a>
                </div>
                
                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-4">
                    @guest('admin')
                        @guest('customer')
                            <a href="{{ route('customer.login') }}" class="text-primary-700 hover:text-primary-800 font-medium transition-colors">
                                <i class="fas fa-sign-in-alt mr-1"></i>Login
                            </a>
                            <a href="{{ route('customer.register') }}" class="bg-gradient-to-r from-primary-500 to-emerald-500 text-white px-4 py-2 rounded-xl hover:from-primary-600 hover:to-emerald-600 transition-all duration-200 font-medium">
                                <i class="fas fa-user-plus mr-1"></i>Sign Up
                            </a>
                        @endguest
                    @endguest
                    
                    @auth('admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-primary-700 hover:text-primary-800 font-medium">
                            <i class="fas fa-tachometer-alt mr-1"></i>Dashboard
                        </a>
                        <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-700 font-medium">
                                <i class="fas fa-sign-out-alt mr-1"></i>Logout
                            </button>
                        </form>
                    @endauth
                    
                    @auth('customer')
                        <a href="{{ route('customer.dashboard') }}" class="text-primary-700 hover:text-primary-800 font-medium">
                            <i class="fas fa-user mr-1"></i>Dashboard
                        </a>
                        <form method="POST" action="{{ route('customer.logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-700 font-medium">
                                <i class="fas fa-sign-out-alt mr-1"></i>Logout ({{ Auth::guard('customer')->user()->name }})
                            </button>
                        </form>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-primary-700 hover:text-primary-800">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-xl p-4 flex items-center" id="success-alert">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-emerald-500 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                    </div>
                    <div class="ml-auto">
                        <button type="button" class="text-emerald-400 hover:text-emerald-600" onclick="document.getElementById('success-alert').remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            @endif
            
            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 flex items-center" id="error-alert">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-red-800 font-medium">{{ session('error') }}</p>
                    </div>
                    <div class="ml-auto">
                        <button type="button" class="text-red-400 hover:text-red-600" onclick="document.getElementById('error-alert').remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            @endif
            
            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4" id="error-list">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-red-800 font-medium mb-2">Please correct the following errors:</h3>
                            <ul class="text-red-700 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li class="flex items-center">
                                        <i class="fas fa-dot-circle text-xs mr-2"></i>{{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="ml-auto">
                            <button type="button" class="text-red-400 hover:text-red-600" onclick="document.getElementById('error-list').remove()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-primary-800 to-emerald-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('logo/ঘরোয়া-1-1-300x158.webp') }}" 
                             alt="Ghoroya Oishorjo" 
                             class="h-10 w-auto object-contain bg-white/10 rounded-lg p-1">
                        <div>
                            <h3 class="text-xl font-bold">Ghoroya Oishorjo</h3>
                            <p class="text-primary-200 text-sm">Premium Artificial Plants</p>
                        </div>
                    </div>
                    <p class="text-primary-100 text-sm leading-relaxed">
                        Transform your space with our beautiful, lifelike artificial plants. 
                        No maintenance required, lasting beauty guaranteed.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-primary-200">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Products</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact Info</h4>
                    <ul class="space-y-2 text-sm text-primary-200">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2"></i>
                            info@ghoroyaoishorjo.com
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-2"></i>
                            +880 1234 567890
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            Dhaka, Bangladesh
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-primary-700 mt-8 pt-6 text-center">
                <p class="text-primary-200 text-sm">
                    &copy; {{ date('Y') }} Ghoroya Oishorjo. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html> 