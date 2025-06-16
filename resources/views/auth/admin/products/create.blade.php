@extends('layouts.admin')

@section('title', 'Add Product - Admin Panel')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Add New Product</h1>
            <p class="text-gray-600 mt-1">Create a new artificial plant product</p>
        </div>
        <a href="{{ route('admin.products') }}" class="bg-gray-100 text-gray-700 px-4 lg:px-6 py-3 rounded-xl font-medium hover:bg-gray-200 transition-all duration-200 text-center">
            <i class="fas fa-arrow-left mr-2"></i>Back to Products
        </a>
    </div>

    <!-- Product Form -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-4 lg:p-8 space-y-6">
            @csrf
            
            <!-- Product Image Upload -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Product Image</h3>
                <div class="flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-6">
                    <div class="w-full sm:w-32 h-32 border-2 border-dashed border-gray-300 rounded-xl flex items-center justify-center bg-gray-50 hover:bg-gray-100 transition-colors" id="imagePreview">
                        <div class="text-center">
                            <i class="fas fa-image text-2xl text-gray-400 mb-2"></i>
                            <p class="text-sm text-gray-500">Preview</p>
                        </div>
                    </div>
                    <div class="flex-1">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Upload Product Image</label>
                        <input type="file" 
                               id="image" 
                               name="image" 
                               accept="image/*"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                               onchange="previewImage(this)">
                        <p class="text-sm text-gray-500 mt-2">Supported: JPG, PNG, GIF, WEBP (Max: 2MB)</p>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Product Information -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Product Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Product Name *</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                               placeholder="e.g., Monstera Deliciosa"
                               required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Stock -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Stock Quantity *</label>
                        <input type="number" 
                               id="stock" 
                               name="stock" 
                               value="{{ old('stock', 0) }}"
                               min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                               placeholder="0"
                               required>
                        @error('stock')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Multiple Categories -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="block text-sm font-medium text-gray-700">Categories *</label>
                        <button type="button" onclick="addCategoryRow()" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            <i class="fas fa-plus mr-1"></i>Add Another Category
                        </button>
                    </div>
                    
                    <div id="categoryContainer" class="space-y-3">
                        <div class="category-row grid grid-cols-1 md:grid-cols-2 gap-4 p-4 border border-gray-200 rounded-xl">
                            <div>
                                <select name="categories[]" 
                                        class="category-select w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                        onchange="loadSubcategoriesForRow(this)"
                                        required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center space-x-2">
                                <select name="subcategories[]" 
                                        class="subcategory-select w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="">Select Subcategory (Optional)</option>
                                </select>
                                <button type="button" onclick="removeCategoryRow(this)" class="text-red-600 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition-colors hidden remove-btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    @error('categories')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pricing -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Regular Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Regular Price (৳) *</label>
                        <input type="number" 
                               id="price" 
                               name="price" 
                               value="{{ old('price') }}"
                               step="0.01"
                               min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                               placeholder="0.00"
                               required>
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Sale Price -->
                    <div>
                        <label for="sale_price" class="block text-sm font-medium text-gray-700 mb-2">Sale Price (৳) - Optional</label>
                        <input type="number" 
                               id="sale_price" 
                               name="sale_price" 
                               value="{{ old('sale_price') }}"
                               step="0.01"
                               min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                               placeholder="0.00">
                        <p class="text-sm text-gray-500 mt-1">Leave empty if no discount</p>
                        @error('sale_price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Product Description</label>
                    <textarea id="description" 
                              name="description" 
                              rows="5" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                              placeholder="Describe your artificial plant product...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-3 sm:space-y-0 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.products') }}" class="w-full sm:flex-1 text-center px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="w-full sm:flex-1 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl hover:from-green-700 hover:to-emerald-700 transition-all duration-200 shadow-lg">
                    <i class="fas fa-save mr-2"></i>Save Product
                </button>
            </div>
        </form>
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

// Add Category Row Function
function addCategoryRow() {
    const container = document.getElementById('categoryContainer');
    const categoryRows = container.querySelectorAll('.category-row');
    
    const newRow = document.createElement('div');
    newRow.className = 'category-row grid grid-cols-1 md:grid-cols-2 gap-4 p-4 border border-gray-200 rounded-xl';
    newRow.innerHTML = `
        <div>
            <select name="categories[]" 
                    class="category-select w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    onchange="loadSubcategoriesForRow(this)"
                    required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-center space-x-2">
            <select name="subcategories[]" 
                    class="subcategory-select w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                <option value="">Select Subcategory (Optional)</option>
            </select>
            <button type="button" onclick="removeCategoryRow(this)" class="text-red-600 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition-colors remove-btn">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
    
    container.appendChild(newRow);
    updateRemoveButtons();
}

// Remove Category Row Function
function removeCategoryRow(button) {
    const row = button.closest('.category-row');
    row.remove();
    updateRemoveButtons();
}

// Update Remove Buttons Visibility
function updateRemoveButtons() {
    const container = document.getElementById('categoryContainer');
    const rows = container.querySelectorAll('.category-row');
    const removeButtons = container.querySelectorAll('.remove-btn');
    
    removeButtons.forEach((btn, index) => {
        if (rows.length > 1) {
            btn.classList.remove('hidden');
        } else {
            btn.classList.add('hidden');
        }
    });
}

// Load Subcategories for Specific Row
function loadSubcategoriesForRow(categorySelect) {
    const row = categorySelect.closest('.category-row');
    const subcategorySelect = row.querySelector('.subcategory-select');
    
    // Clear existing subcategories
    subcategorySelect.innerHTML = '<option value="">Select Subcategory (Optional)</option>';
    
    if (categorySelect.value) {
        fetch(`/adminpanel/categories/${categorySelect.value}/subcategories`)
            .then(response => response.json())
            .then(subcategories => {
                subcategories.forEach(subcategory => {
                    const option = document.createElement('option');
                    option.value = subcategory.id;
                    option.textContent = subcategory.name;
                    subcategorySelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error loading subcategories:', error);
            });
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateRemoveButtons();
});
</script>
@endpush
@endsection 