@extends('layouts.app')

@section('title', 'Sign Up - Ghoroya Oishorjo')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-lg w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto h-20 w-20 bg-gradient-to-br from-emerald-500 to-primary-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                <i class="fas fa-seedling text-white text-3xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Join Ghoroya Oishorjo</h2>
            <p class="text-gray-600">Create your account and start your plant journey</p>
        </div>

        <!-- Register Form -->
        <div class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-xl border border-primary-100 p-8">
            <form method="POST" action="{{ route('customer.register') }}" class="space-y-6">
                @csrf
                
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user text-primary-500 mr-2"></i>Full Name
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 bg-white/80 backdrop-blur-sm @error('name') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                           placeholder="Enter your full name">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-primary-500 mr-2"></i>Email Address
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 bg-white/80 backdrop-blur-sm @error('email') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                           placeholder="Enter your email address">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Phone and Address Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Phone Field -->
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-phone text-primary-500 mr-2"></i>Phone Number
                        </label>
                        <input type="text" 
                               id="phone" 
                               name="phone" 
                               value="{{ old('phone') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 bg-white/80 backdrop-blur-sm @error('phone') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                               placeholder="Optional">
                        @error('phone')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Address Field -->
                <div>
                    <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt text-primary-500 mr-2"></i>Delivery Address
                    </label>
                    <textarea id="address" 
                              name="address" 
                              rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 bg-white/80 backdrop-blur-sm @error('address') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                              placeholder="Enter your delivery address (optional)">{{ old('address') }}</textarea>
                    @error('address')
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
                            <i class="fas fa-lock text-primary-500 mr-2"></i>Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 bg-white/80 backdrop-blur-sm @error('password') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                   placeholder="Create password">
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
                            <i class="fas fa-lock text-primary-500 mr-2"></i>Confirm Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 bg-white/80 backdrop-blur-sm"
                                   placeholder="Confirm password">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" onclick="togglePassword('password_confirmation')" class="text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye" id="password_confirmation-toggle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Terms Agreement -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" 
                               name="terms" 
                               type="checkbox" 
                               required
                               class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="text-gray-700">
                            I agree to the 
                            <a href="#" class="font-medium text-primary-600 hover:text-primary-500">Terms and Conditions</a> 
                            and 
                            <a href="#" class="font-medium text-primary-600 hover:text-primary-500">Privacy Policy</a>
                        </label>
                    </div>
                </div>

                <!-- Register Button -->
                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-emerald-600 to-primary-600 hover:from-emerald-700 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-seedling text-emerald-200 group-hover:text-emerald-100"></i>
                        </span>
                        Create Account
                    </button>
                </div>
            </form>
            
            <!-- Sign In Link -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Already have an account? 
                    <a href="{{ route('customer.login') }}" class="font-semibold text-primary-600 hover:text-primary-500 transition-colors">
                        Sign in here
                    </a>
                </p>
            </div>
        </div>

        <!-- Benefits -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
            <div class="bg-white/50 backdrop-blur-sm rounded-xl p-4 text-center border border-primary-100">
                <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-primary-500 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-shipping-fast text-white"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Free Delivery</h3>
                <p class="text-xs text-gray-600">On orders over ৳1000</p>
            </div>
            
            <div class="bg-white/50 backdrop-blur-sm rounded-xl p-4 text-center border border-primary-100">
                <div class="w-12 h-12 bg-gradient-to-r from-primary-500 to-emerald-500 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-award text-white"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Premium Quality</h3>
                <p class="text-xs text-gray-600">Handpicked artificial plants</p>
            </div>
            
            <div class="bg-white/50 backdrop-blur-sm rounded-xl p-4 text-center border border-primary-100">
                <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-primary-500 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-headset text-white"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">24/7 Support</h3>
                <p class="text-xs text-gray-600">Customer service anytime</p>
            </div>
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