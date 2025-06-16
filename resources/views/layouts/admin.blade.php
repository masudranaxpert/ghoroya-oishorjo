<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - Ghoroya Oishorjo')</title>
    
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
                        admin: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'ui-sans-serif', 'system-ui'],
                    },
                }
            }
        }
    </script>
    
    @stack('styles')
</head>
<body class="min-h-screen bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar for Desktop -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-b from-admin-800 to-admin-900 transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 shadow-2xl">
            <!-- Header Section -->
            <div class="flex items-center justify-center h-20 bg-gradient-to-r from-admin-900 to-slate-900 border-b border-admin-700">
                <div class="text-center">
                    <h1 class="text-xl font-bold text-white">Admin Panel</h1>
                    <p class="text-xs text-admin-300 font-medium">Ghoroya Oishorjo</p>
                </div>
            </div>
            

            
            <!-- Navigation Menu -->
            <nav class="px-3 py-4 flex-1 overflow-y-auto">
                <div class="space-y-1">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md' : 'text-admin-300 hover:bg-admin-700/50 hover:text-white' }} transition-all duration-200">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : 'bg-admin-700/50 group-hover:bg-admin-600/50' }}">
                            <i class="fas fa-tachometer-alt text-sm {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-admin-300 group-hover:text-white' }}"></i>
                        </div>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    
                    <!-- Products -->
                    <div class="space-y-1">
                        <button type="button" class="group w-full flex items-center px-3 py-2.5 text-left text-sm font-medium rounded-lg text-admin-300 hover:bg-admin-700/50 hover:text-white transition-all duration-200" onclick="toggleSubMenu('products')">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3 bg-admin-700/50 group-hover:bg-admin-600/50">
                                <i class="fas fa-box text-sm text-admin-300 group-hover:text-white"></i>
                            </div>
                            <span class="font-medium flex-1">Products</span>
                            <i class="fas fa-chevron-right ml-auto h-3 w-3 transform transition-transform duration-200" id="products-icon"></i>
                        </button>
                        <div class="ml-8 space-y-1 hidden" id="products-menu">
                            <a href="{{ route('admin.products.create') }}" class="group flex items-center px-3 py-2 text-xs font-medium rounded-md text-admin-400 hover:bg-admin-600/30 hover:text-white transition-all duration-150">
                                <i class="fas fa-plus mr-2 h-3 w-3"></i>
                                Add Product
                            </a>
                            <a href="{{ route('admin.products') }}" class="group flex items-center px-3 py-2 text-xs font-medium rounded-md text-admin-400 hover:bg-admin-600/30 hover:text-white transition-all duration-150">
                                <i class="fas fa-list mr-2 h-3 w-3"></i>
                                Manage Products
                            </a>
                        </div>
                    </div>
                    
                    <!-- Categories -->
                    <a href="#" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-admin-300 hover:bg-admin-700/50 hover:text-white transition-all duration-200">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3 bg-admin-700/50 group-hover:bg-admin-600/50">
                            <i class="fas fa-tags text-sm text-admin-300 group-hover:text-white"></i>
                        </div>
                        <span class="font-medium">Categories</span>
                    </a>
                    
                    <!-- Orders -->
                    <a href="#" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-admin-300 hover:bg-admin-700/50 hover:text-white transition-all duration-200">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3 bg-admin-700/50 group-hover:bg-admin-600/50">
                            <i class="fas fa-shopping-cart text-sm text-admin-300 group-hover:text-white"></i>
                        </div>
                        <span class="font-medium flex-1">Orders</span>
                        <span class="inline-block py-0.5 px-1.5 text-xs font-medium rounded-full bg-red-500 text-white">0</span>
                    </a>
                    
                    <!-- Customers -->
                    <a href="#" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-admin-300 hover:bg-admin-700/50 hover:text-white transition-all duration-200">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3 bg-admin-700/50 group-hover:bg-admin-600/50">
                            <i class="fas fa-users text-sm text-admin-300 group-hover:text-white"></i>
                        </div>
                        <span class="font-medium">Customers</span>
                    </a>
                    
                    <!-- Reports -->
                    <div class="space-y-1">
                        <button type="button" class="group w-full flex items-center px-2 py-2 text-left text-sm font-medium rounded-md text-admin-300 hover:bg-admin-700 hover:text-white transition-colors duration-150" onclick="toggleSubMenu('reports')">
                            <i class="fas fa-chart-bar mr-3 flex-shrink-0 h-6 w-6 text-admin-400 group-hover:text-admin-300"></i>
                            Reports
                            <i class="fas fa-chevron-right ml-auto h-5 w-5 transform transition-transform duration-200" id="reports-icon"></i>
                        </button>
                        <div class="ml-6 space-y-1 hidden" id="reports-menu">
                            <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-admin-300 hover:bg-admin-700 hover:text-white transition-colors duration-150">
                                <i class="fas fa-chart-line mr-2 h-4 w-4"></i>
                                Sales Report
                            </a>
                            <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-admin-300 hover:bg-admin-700 hover:text-white transition-colors duration-150">
                                <i class="fas fa-chart-pie mr-2 h-4 w-4"></i>
                                Analytics
                            </a>
                        </div>
                    </div>
                    
                    <!-- Settings -->
                    <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-admin-300 hover:bg-admin-700 hover:text-white transition-colors duration-150">
                        <i class="fas fa-cog mr-3 flex-shrink-0 h-6 w-6 text-admin-400 group-hover:text-admin-300"></i>
                        Settings
                    </a>
                </div>
                
                <!-- Logout -->
                <div class="mt-8 pt-4 border-t border-admin-700">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="group w-full flex items-center px-2 py-2 text-sm font-medium rounded-md text-red-300 hover:bg-red-600 hover:text-white transition-colors duration-150">
                            <i class="fas fa-sign-out-alt mr-3 flex-shrink-0 h-6 w-6 text-red-400 group-hover:text-red-300"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Mobile menu overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 transition-opacity lg:hidden hidden"></div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <!-- Mobile header (only for mobile menu) -->
            <header class="lg:hidden bg-admin-800 shadow-lg">
                <div class="flex items-center justify-between h-16 px-4">
                    <div class="flex items-center space-x-3">
                        <button type="button" class="text-white hover:text-admin-200" onclick="toggleSidebar()">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <div>
                            <h1 class="text-lg font-bold text-white">Admin Panel</h1>
                        </div>
                    </div>
                    
                    <!-- Mobile user menu -->
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-shield text-white text-sm"></i>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main content area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4 flex items-center" id="success-alert">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-500 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-green-800 font-medium">{{ session('success') }}</p>
                        </div>
                        <div class="ml-auto">
                            <button type="button" class="text-green-400 hover:text-green-600" onclick="document.getElementById('success-alert').remove()">
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
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // Toggle sidebar for mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Close sidebar when clicking overlay
        document.getElementById('sidebar-overlay').addEventListener('click', function() {
            toggleSidebar();
        });

        // Toggle submenu
        function toggleSubMenu(menuId) {
            const menu = document.getElementById(menuId + '-menu');
            const icon = document.getElementById(menuId + '-icon');
            
            menu.classList.toggle('hidden');
            icon.classList.toggle('rotate-90');
        }

        // Close mobile sidebar on larger screens
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html> 