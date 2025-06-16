@extends('layouts.admin')

@section('title', 'Admin Dashboard - Ghoroya Oishorjo')
@section('page-title', 'Dashboard')
@section('page-description', 'Overview of your artificial plants business')

@section('content')
<!-- Welcome Message -->
<div class="mb-6">
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6">
        <div class="flex items-center">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl p-3 mr-4">
                <i class="fas fa-seedling text-white text-2xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">Welcome back, {{ $admin->name }}!</h2>
                <p class="text-gray-600">Here's what's happening with your artificial plants business today.</p>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Products -->
    <div class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-lg border border-blue-100 p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-600 text-sm font-semibold uppercase tracking-wider">Products</p>
                <p class="text-3xl font-bold text-gray-900">0</p>
                <p class="text-gray-500 text-sm">Items in inventory</p>
            </div>
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-4">
                <i class="fas fa-box text-white text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Customers -->
    <div class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-lg border border-emerald-100 p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-emerald-600 text-sm font-semibold uppercase tracking-wider">Customers</p>
                <p class="text-3xl font-bold text-gray-900">0</p>
                <p class="text-gray-500 text-sm">Registered users</p>
            </div>
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-2xl p-4">
                <i class="fas fa-users text-white text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Orders -->
    <div class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-xl border border-yellow-100 p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-yellow-600 text-sm font-semibold uppercase tracking-wider">Orders</p>
                <p class="text-3xl font-bold text-gray-900">0</p>
                <p class="text-gray-500 text-sm">Total orders</p>
            </div>
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-2xl p-4">
                <i class="fas fa-shopping-cart text-white text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-lg border border-purple-100 p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-600 text-sm font-semibold uppercase tracking-wider">Categories</p>
                <p class="text-3xl font-bold text-gray-900">3</p>
                <p class="text-gray-500 text-sm">Product categories</p>
            </div>
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl p-4">
                <i class="fas fa-tags text-white text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Quick Actions -->
    <div class="lg:col-span-2">
        <div class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-lg border border-gray-200 p-6">
            <div class="flex items-center mb-6">
                <div class="bg-gradient-to-r from-admin-600 to-admin-800 rounded-xl p-3 mr-4">
                    <i class="fas fa-tasks text-white text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-900">Quick Actions</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="#" class="group bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 border border-blue-200 rounded-xl p-4 transition-all duration-200 transform hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-center">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-3 mr-4">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 group-hover:text-blue-700">Add Product</h3>
                            <p class="text-sm text-gray-600">Create new plant listing</p>
                        </div>
                    </div>
                </a>

                <a href="#" class="group bg-gradient-to-r from-emerald-50 to-emerald-100 hover:from-emerald-100 hover:to-emerald-200 border border-emerald-200 rounded-xl p-4 transition-all duration-200 transform hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-center">
                        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-lg p-3 mr-4">
                            <i class="fas fa-list text-white"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 group-hover:text-emerald-700">Manage Products</h3>
                            <p class="text-sm text-gray-600">Edit inventory & pricing</p>
                        </div>
                    </div>
                </a>

                <a href="#" class="group bg-gradient-to-r from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 border border-purple-200 rounded-xl p-4 transition-all duration-200 transform hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-center">
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-3 mr-4">
                            <i class="fas fa-folder text-white"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 group-hover:text-purple-700">Categories</h3>
                            <p class="text-sm text-gray-600">Organize plant types</p>
                        </div>
                    </div>
                </a>

                <a href="#" class="group bg-gradient-to-r from-orange-50 to-orange-100 hover:from-orange-100 hover:to-orange-200 border border-orange-200 rounded-xl p-4 transition-all duration-200 transform hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-center">
                        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg p-3 mr-4">
                            <i class="fas fa-chart-bar text-white"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 group-hover:text-orange-700">View Orders</h3>
                            <p class="text-sm text-gray-600">Track customer orders</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Admin Profile & Activity -->
    <div class="space-y-6">
        <!-- Admin Profile -->
        <div class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-lg border border-gray-200 p-6">
            <div class="flex items-center mb-6">
                <div class="bg-gradient-to-r from-gray-600 to-gray-800 rounded-xl p-3 mr-4">
                    <i class="fas fa-user-shield text-white text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-900">Admin Profile</h2>
            </div>
            
            <div class="text-center">
                <div class="mx-auto w-20 h-20 bg-gradient-to-r from-gray-600 to-gray-800 rounded-2xl flex items-center justify-center mb-4">
                    <i class="fas fa-user-shield text-white text-2xl"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-lg">{{ $admin->name }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ $admin->email }}</p>
                
                <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">
                            <i class="fas fa-calendar mr-2"></i>Member since
                        </span>
                        <span class="font-medium text-gray-900">{{ $admin->created_at->format('M Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">
                            <i class="fas fa-circle mr-2 text-green-500"></i>Status
                        </span>
                        <span class="font-medium text-green-600">{{ ucfirst($admin->status) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-lg border border-gray-200 p-6">
            <div class="flex items-center mb-6">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-500 rounded-xl p-3 mr-4">
                    <i class="fas fa-clock text-white text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-900">Recent Activity</h2>
            </div>
            
            <div class="text-center py-8">
                <div class="mx-auto w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                    <i class="fas fa-inbox text-gray-400 text-2xl"></i>
                </div>
                <p class="text-gray-500 text-sm">No recent activity</p>
                <p class="text-gray-400 text-xs mt-1">Activities will appear here</p>
            </div>
        </div>
    </div>
</div>
@endsection 