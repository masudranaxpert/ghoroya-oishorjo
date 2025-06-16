@extends('layouts.app')

@section('title', 'Admin Registration - Ghoroya Oishorjo')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto h-20 w-20 bg-gradient-to-br from-gray-700 to-gray-900 rounded-2xl flex items-center justify-center mb-6 shadow-lg border-2 border-yellow-400">
                <i class="fas fa-user-plus text-yellow-400 text-3xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Admin Registration</h2>
            <p class="text-gray-600">Create new administrator account</p>
        </div>

        <!-- Register Form -->
        <div class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-xl border border-gray-200 p-8">
            <form method="POST" action="{{ route('admin.register') }}" class="space-y-6">
                @csrf
                
                <!-- Admin Badge -->
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl p-4 border border-yellow-200">
                    <div class="flex items-center justify-center space-x-2">
                        <i class="fas fa-crown text-yellow-600"></i>
                        <span class="text-sm font-semibold text-yellow-800">Administrator Registration</span>
                    </div>
                </div>
                
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user text-gray-500 mr-2"></i>Administrator Name
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all duration-200 bg-white/80 backdrop-blur-sm @error('name') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                           placeholder="Enter administrator name">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-gray-500 mr-2"></i>Admin Email Address
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all duration-200 bg-white/80 backdrop-blur-sm @error('email') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                           placeholder="Enter admin email address">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-key text-gray-500 mr-2"></i>Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all duration-200 bg-white/80 backdrop-blur-sm @error('password') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                   placeholder="Create secure password">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" onclick="togglePassword('password')" class="text-gray-400 hover:text-gray-600">
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

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-key text-gray-500 mr-2"></i>Confirm
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all duration-200 bg-white/80 backdrop-blur-sm"
                                   placeholder="Confirm password">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" onclick="togglePassword('password_confirmation')" class="text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye" id="password_confirmation-toggle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Agreement -->
                <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="security_agreement" 
                                   name="security_agreement" 
                                   type="checkbox" 
                                   required
                                   class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="security_agreement" class="text-gray-700">
                                <span class="font-semibold text-red-800">Security Acknowledgment:</span><br>
                                I understand that this account will have administrative privileges and I will maintain strict security practices.
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Register Button -->
                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-800 hover:to-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-600 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-shield-alt text-gray-300 group-hover:text-gray-200"></i>
                        </span>
                        Create Admin Account
                    </button>
                </div>
            </form>
            
            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Already have an admin account? 
                    <a href="{{ route('admin.login') }}" class="font-semibold text-gray-700 hover:text-gray-900 transition-colors">
                        Sign in here
                    </a>
                </p>
            </div>
        </div>

        <!-- Admin Privileges -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
            <div class="bg-white/50 backdrop-blur-sm rounded-xl p-4 text-center border border-gray-200">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-700 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-users-cog text-white"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">User Management</h3>
                <p class="text-xs text-gray-600">Manage customer accounts</p>
            </div>
            
            <div class="bg-white/50 backdrop-blur-sm rounded-xl p-4 text-center border border-gray-200">
                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-700 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-box text-white"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Product Control</h3>
                <p class="text-xs text-gray-600">Manage inventory & catalog</p>
            </div>
            
            <div class="bg-white/50 backdrop-blur-sm rounded-xl p-4 text-center border border-gray-200">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-700 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-chart-line text-white"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Analytics</h3>
                <p class="text-xs text-gray-600">Sales & performance data</p>
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
function togglePassword(fieldId) {
    const passwordInput = document.getElementById(fieldId);
    const passwordToggle = document.getElementById(fieldId + '-toggle');
    
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