@extends('layouts.app')

@section('title', 'Home - Ghoroya Oishorjo')

@section('content')
<!-- Hero Slider Section -->
@if(count($sliderImages) > 0)
<section class="relative">
    <div class="slider-container relative overflow-hidden" style="height: 70vh;">
        @foreach($sliderImages as $index => $image)
            <div class="slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
                <div class="relative w-full h-full">
                    <img src="{{ $image['url'] }}" 
                         alt="{{ $image['title'] ?: 'Ghoroya Oishorjo' }}" 
                         class="w-full h-full object-cover">
                    
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                    
                    <!-- Content -->
                    @if($image['title'] || $image['description'])
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white max-w-4xl mx-auto px-6">
                                @if($image['title'])
                                    <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                                        {{ $image['title'] }}
                                    </h1>
                                @endif
                                
                                @if($image['description'])
                                    <p class="text-xl md:text-2xl mb-8 leading-relaxed opacity-90">
                                        {{ $image['description'] }}
                                    </p>
                                @endif
                                
                                <div class="space-x-4">
                                    <a href="{{ route('customer.register') }}" class="inline-block bg-gradient-to-r from-green-600 to-emerald-600 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:from-green-700 hover:to-emerald-700 transform hover:scale-105 transition-all duration-300 shadow-xl">
                                        <i class="fas fa-user-plus mr-2"></i>Get Started
                                    </a>
                                    <a href="#products" class="inline-block bg-white/20 backdrop-blur-sm text-white border-2 border-white/30 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white/30 transition-all duration-300">
                                        <i class="fas fa-leaf mr-2"></i>Browse Plants
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
        
        @if(count($sliderImages) > 1)
            <!-- Navigation Arrows -->
            <button class="slider-btn prev-btn absolute left-6 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur-sm text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-white/30 transition-all duration-300 z-10">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="slider-btn next-btn absolute right-6 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur-sm text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-white/30 transition-all duration-300 z-10">
                <i class="fas fa-chevron-right"></i>
            </button>
            
            <!-- Dots Indicator -->
            <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-3 z-10">
                @foreach($sliderImages as $index => $image)
                    <button class="dot w-3 h-3 rounded-full bg-white/50 hover:bg-white/80 transition-all duration-300 {{ $index === 0 ? 'bg-white' : '' }}" data-slide="{{ $index }}"></button>
                @endforeach
            </div>
        @endif
    </div>
</section>
@else
<!-- Default Hero Section -->
<section class="relative bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 py-20">
    <div class="container mx-auto px-6 text-center">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Welcome to <span class="text-green-600">Ghoroya Oishorjo</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-600 mb-8 leading-relaxed">
                Transform your space with our beautiful collection of artificial plants and home decorations
            </p>
            <div class="space-x-4">
                <a href="{{ route('customer.register') }}" class="inline-block bg-gradient-to-r from-green-600 to-emerald-600 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:from-green-700 hover:to-emerald-700 transform hover:scale-105 transition-all duration-300 shadow-xl">
                    <i class="fas fa-user-plus mr-2"></i>Get Started
                </a>
                <a href="{{ route('customer.login') }}" class="inline-block bg-white text-green-600 border-2 border-green-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-green-600 hover:text-white transition-all duration-300">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
            </div>
        </div>
    </div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-10 left-10 opacity-20">
        <i class="fas fa-leaf text-6xl text-green-600 transform rotate-12"></i>
    </div>
    <div class="absolute bottom-10 right-10 opacity-20">
        <i class="fas fa-seedling text-8xl text-emerald-600 transform -rotate-12"></i>
    </div>
</section>
@endif

<!-- Features Section -->
<section class="py-20 bg-white" id="products">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Why Choose Ghoroya Oishorjo?
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                We bring nature indoors with our premium collection of artificial plants and home decorations
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="text-center group">
                <div class="w-20 h-20 bg-gradient-to-br from-green-100 to-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-leaf text-3xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Premium Quality</h3>
                <p class="text-gray-600">
                    High-quality artificial plants that look and feel real, crafted with attention to detail
                </p>
            </div>
            
            <!-- Feature 2 -->
            <div class="text-center group">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-home text-3xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Home Delivery</h3>
                <p class="text-gray-600">
                    Fast and secure delivery to your doorstep across Bangladesh
                </p>
            </div>
            
            <!-- Feature 3 -->
            <div class="text-center group">
                <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-heart text-3xl text-purple-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Customer Care</h3>
                <p class="text-gray-600">
                    Dedicated customer support to help you choose the perfect plants for your space
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-green-600 to-emerald-600">
    <div class="container mx-auto px-6 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Ready to Transform Your Space?
            </h2>
            <p class="text-xl text-green-100 mb-8">
                Join thousands of satisfied customers who have beautified their homes with our artificial plants
            </p>
            <a href="{{ route('customer.register') }}" class="inline-block bg-white text-green-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-xl">
                <i class="fas fa-shopping-cart mr-2"></i>Start Shopping Now
            </a>
        </div>
    </div>
</section>

@push('styles')
<style>
/* Slider Styles */
.slider-container {
    position: relative;
}

.slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.8s ease-in-out;
}

.slide.active {
    opacity: 1;
}

.dot.active {
    background-color: white !important;
    transform: scale(1.2);
}

/* Animation for content */
.slide.active h1 {
    animation: slideInUp 1s ease-out 0.3s both;
}

.slide.active p {
    animation: slideInUp 1s ease-out 0.6s both;
}

.slide.active .space-x-4 {
    animation: slideInUp 1s ease-out 0.9s both;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .slider-container {
        height: 60vh !important;
    }
    
    .slide h1 {
        font-size: 2.5rem !important;
    }
    
    .slide p {
        font-size: 1.1rem !important;
    }
    
    .slider-btn {
        width: 2.5rem !important;
        height: 2.5rem !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    
    if (slides.length <= 1) return; // No need for slider functionality if only one slide
    
    let currentSlide = 0;
    
    function showSlide(index) {
        // Remove active class from all slides and dots
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        
        // Add active class to current slide and dot
        slides[index].classList.add('active');
        if (dots[index]) dots[index].classList.add('active');
        
        currentSlide = index;
    }
    
    function nextSlide() {
        const next = (currentSlide + 1) % slides.length;
        showSlide(next);
    }
    
    function prevSlide() {
        const prev = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prev);
    }
    
    // Event listeners for navigation
    if (nextBtn) nextBtn.addEventListener('click', nextSlide);
    if (prevBtn) prevBtn.addEventListener('click', prevSlide);
    
    // Event listeners for dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => showSlide(index));
    });
    
    // Auto-slide every 5 seconds
    setInterval(nextSlide, 5000);
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') prevSlide();
        if (e.key === 'ArrowRight') nextSlide();
    });
});
</script>
@endpush
@endsection 