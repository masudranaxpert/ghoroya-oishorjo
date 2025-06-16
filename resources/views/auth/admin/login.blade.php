@extends('layouts.app')

@section('title', 'Admin Panel - Ghoroya Oishorjo')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto h-20 w-20 bg-gradient-to-br from-gray-700 to-gray-900 rounded-2xl flex items-center justify-center mb-6 shadow-lg border-2 border-yellow-400">
                <i class="fas fa-shield-alt text-yellow-400 text-3xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Admin Panel</h2>
            <p class="text-gray-600">Secure access to Ghoroya Oishorjo management</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-xl border border-gray-200 p-8">
            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf
                
                <!-- Admin Badge -->
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200">
                    <div class="flex items-center justify-center space-x-2">
                        <i class="fas fa-user-shield text-gray-600"></i>
                        <span class="text-sm font-semibold text-gray-700">Administrator Access</span>
                    </div>
                </div>
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-gray-500 mr-2"></i>Admin Email
                    </label>
                    <div class="relative">
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all duration-200 bg-white/80 backdrop-blur-sm @error('email') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                               placeholder="Enter admin email">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-user-tie text-gray-400"></i>
                        </div>
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-key text-gray-500 mr-2"></i>Admin Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all duration-200 bg-white/80 backdrop-blur-sm @error('password') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                               placeholder="Enter admin password">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" onclick="togglePassword()" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye" id="password-toggle"></i>
                            </button>
                        </div>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="remember" 
                               name="remember" 
                               class="h-4 w-4 text-gray-600 focus:ring-gray-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Keep me signed in
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-gray-600 hover:text-gray-500 transition-colors">
                            Reset password
                        </a>
                    </div>
                </div>

                <!-- Login Button -->
                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-800 hover:to-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-600 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-sign-in-alt text-gray-300 group-hover:text-gray-200"></i>
                        </span>
                        Access Admin Panel
                    </button>
                </div>
            </form>
            
            <!-- Security Notice -->
            <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-semibold text-yellow-800">Security Notice</h3>
                        <p class="text-xs text-yellow-700 mt-1">
                            This is a restricted area. All access attempts are logged and monitored.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Features -->
        <div class="grid grid-cols-3 gap-4 mt-8">
            <div class="text-center">
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-chart-bar text-gray-600"></i>
                </div>
                <p class="text-xs text-gray-600">Analytics</p>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-cog text-gray-600"></i>
                </div>
                <p class="text-xs text-gray-600">Management</p>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-shield-alt text-gray-600"></i>
                </div>
                <p class="text-xs text-gray-600">Security</p>
            </div>
        </div>
        
        <!-- Back to Site -->
        <div class="text-center">
            <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Ghoroya Oishorjo
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('password-toggle');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggle.classList.remove('fa-eye');
        passwordToggle.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        passwordToggle.classList.remove('fa-eye-slash');
        passwordToggle.classList.add('fa-eye');
    }
}
</script>
@endpush
@endsection 