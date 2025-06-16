@extends('layouts.admin')

@section('title', 'Home Settings - Admin Panel')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between space-y-4 lg:space-y-0">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Home Page Settings</h1>
            <p class="text-gray-600 mt-1">Manage slider images and home page content</p>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="bg-green-600 text-white px-4 lg:px-6 py-3 rounded-xl font-medium hover:bg-green-700 transition-all duration-200 shadow-lg text-center">
            <i class="fas fa-external-link-alt mr-2"></i>View Home Page
        </a>
    </div>

    <!-- Upload New Slider Image -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
            <h2 class="text-xl font-bold text-white">
                <i class="fas fa-upload mr-2"></i>Add New Slider Image
            </h2>
        </div>
        
        <form action="{{ route('admin.slider.upload') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Image Upload -->
                <div>
                    <label for="slider_image" class="block text-sm font-medium text-gray-700 mb-2">
                        Slider Image *
                        <span class="text-gray-500 text-xs">(Max: 5MB)</span>
                    </label>
                    <div class="flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-6">
                        <div class="w-full sm:w-48 h-32 border-2 border-dashed border-gray-300 rounded-xl flex items-center justify-center bg-gray-50 hover:bg-gray-100 transition-colors" id="imagePreview">
                            <div class="text-center">
                                <i class="fas fa-image text-2xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-500">Preview</p>
                            </div>
                        </div>
                        <div class="flex-1">
                            <input type="file" 
                                   id="slider_image" 
                                   name="slider_image" 
                                   accept="image/*"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                   onchange="previewImage(this)"
                                   required>
                            <p class="text-sm text-gray-500 mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Recommended size: 1920x600px for best results
                            </p>
                        </div>
                    </div>
                    @error('slider_image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Image Info -->
                <div class="space-y-4">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Slide Title <span class="text-gray-500 text-xs">(Optional)</span>
                        </label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                               placeholder="Enter slide title...">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Slide Description <span class="text-gray-500 text-xs">(Optional)</span>
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="3" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                  placeholder="Enter slide description...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-3 rounded-xl font-medium hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg">
                    <i class="fas fa-upload mr-2"></i>Upload Slider Image
                </button>
            </div>
        </form>
    </div>

    <!-- Existing Slider Images -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-6 py-4">
            <h2 class="text-xl font-bold text-white">
                <i class="fas fa-images mr-2"></i>Current Slider Images ({{ count($sliderImages) }})
            </h2>
        </div>
        
        @if(count($sliderImages) > 0)
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($sliderImages as $image)
                        <div class="bg-gray-50 rounded-xl overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300">
                            <!-- Image -->
                            <div class="relative h-48 bg-gray-100">
                                <img src="{{ $image['url'] }}" 
                                     alt="{{ $image['title'] ?: 'Slider Image' }}" 
                                     class="w-full h-full object-cover">
                                
                                <!-- Delete Button -->
                                <button onclick="deleteSliderImage('{{ $image['filename'] }}')" 
                                        class="absolute top-3 right-3 bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-red-600 transition-colors shadow-lg">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </div>
                            
                            <!-- Info -->
                            <div class="p-4">
                                @if($image['title'])
                                    <h3 class="font-bold text-gray-900 mb-2">{{ $image['title'] }}</h3>
                                @endif
                                
                                @if($image['description'])
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($image['description'], 100) }}</p>
                                @endif
                                
                                <div class="text-xs text-gray-500 space-y-1">
                                    <p><i class="fas fa-file mr-1"></i>{{ $image['filename'] }}</p>
                                    <p><i class="fas fa-clock mr-1"></i>{{ date('M j, Y g:i A', strtotime($image['uploaded_at'])) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-images text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">No Slider Images</h3>
                <p class="text-gray-600">Upload your first slider image to get started.</p>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
// Image Preview Function
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-lg">`;
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.innerHTML = `
            <div class="text-center">
                <i class="fas fa-image text-2xl text-gray-400 mb-2"></i>
                <p class="text-sm text-gray-500">Preview</p>
            </div>
        `;
    }
}

// Delete Slider Image
function deleteSliderImage(filename) {
    if (confirm('Are you sure you want to delete this slider image? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.slider.delete") }}';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const imageField = document.createElement('input');
        imageField.type = 'hidden';
        imageField.name = 'image_name';
        imageField.value = filename;
        
        form.appendChild(csrfToken);
        form.appendChild(imageField);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endpush
@endsection 