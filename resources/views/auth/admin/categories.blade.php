@extends('layouts.admin')

@section('title', 'Categories - Admin Panel')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Categories Management</h1>
            <p class="text-gray-600 mt-1">Manage your plant categories and subcategories</p>
        </div>
        <button onclick="openCreateCategoryModal()" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl font-medium hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
            <i class="fas fa-plus mr-2"></i>Add New Category
        </button>
    </div>

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($categories as $category)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-gray-100">
                <!-- Category Header -->
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-tags text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">{{ $category->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $category->subcategories->count() }} subcategories</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button onclick="openSubcategoryModal({{ $category->id }}, '{{ $category->name }}')" class="text-green-600 hover:text-green-700 p-2 rounded-lg hover:bg-green-50 transition-colors">
                                <i class="fas fa-plus text-sm"></i>
                            </button>
                            <button onclick="deleteCategory({{ $category->id }})" class="text-red-600 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition-colors">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </div>
                    @if($category->description)
                        <p class="text-gray-600 mt-3 text-sm">{{ $category->description }}</p>
                    @endif
                </div>

                <!-- Subcategories -->
                <div class="p-6">
                    @if($category->subcategories->count() > 0)
                        <div class="space-y-3">
                            <h4 class="font-semibold text-gray-800 text-sm mb-3">Subcategories:</h4>
                            @foreach($category->subcategories as $subcategory)
                                <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3 hover:bg-gray-100 transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gray-300 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-tag text-gray-600 text-xs"></i>
                                        </div>
                                        <div>
                                            <h5 class="font-medium text-gray-800">{{ $subcategory->name }}</h5>
                                            @if($subcategory->description)
                                                <p class="text-xs text-gray-500">{{ Str::limit($subcategory->description, 50) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <button onclick="deleteSubcategory({{ $subcategory->id }})" class="text-red-500 hover:text-red-700 p-1 rounded hover:bg-red-50 transition-colors">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-inbox text-gray-400 text-xl"></i>
                            </div>
                            <p class="text-gray-500 text-sm">No subcategories yet</p>
                            <button onclick="openSubcategoryModal({{ $category->id }}, '{{ $category->name }}')" class="text-blue-600 hover:text-blue-700 text-sm font-medium mt-2">
                                Add first subcategory
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-tags text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">No Categories Found</h3>
                    <p class="text-gray-600 mb-6">Create your first category to get started organizing your plants.</p>
                    <button onclick="openCreateCategoryModal()" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl font-medium hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg">
                        <i class="fas fa-plus mr-2"></i>Create First Category
                    </button>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Create Category Modal -->
<div id="createCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 transform transition-all duration-300 scale-95 opacity-0" id="createCategoryModalContent">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">Create New Category</h3>
            <button onclick="closeCreateCategoryModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="category_name" class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                <input type="text" 
                       id="category_name" 
                       name="name" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                       placeholder="e.g., Indoor Plants"
                       required>
            </div>
            
            <div>
                <label for="category_description" class="block text-sm font-medium text-gray-700 mb-2">Description (Optional)</label>
                <textarea id="category_description" 
                          name="description" 
                          rows="3" 
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                          placeholder="Brief description of this category"></textarea>
            </div>
            
            <div class="flex space-x-3 pt-4">
                <button type="button" 
                        onclick="closeCreateCategoryModal()" 
                        class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button type="submit" 
                        class="flex-1 px-4 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200">
                    Create Category
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Create Subcategory Modal -->
<div id="createSubcategoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 transform transition-all duration-300 scale-95 opacity-0" id="createSubcategoryModalContent">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-xl font-bold text-gray-900">Add Subcategory</h3>
                <p class="text-sm text-gray-600" id="subcategoryParentName"></p>
            </div>
            <button onclick="closeSubcategoryModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form id="subcategoryForm" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="subcategory_name" class="block text-sm font-medium text-gray-700 mb-2">Subcategory Name</label>
                <input type="text" 
                       id="subcategory_name" 
                       name="name" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                       placeholder="e.g., Succulents"
                       required>
            </div>
            
            <div>
                <label for="subcategory_description" class="block text-sm font-medium text-gray-700 mb-2">Description (Optional)</label>
                <textarea id="subcategory_description" 
                          name="description" 
                          rows="3" 
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                          placeholder="Brief description of this subcategory"></textarea>
            </div>
            
            <div class="flex space-x-3 pt-4">
                <button type="button" 
                        onclick="closeSubcategoryModal()" 
                        class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button type="submit" 
                        class="flex-1 px-4 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl hover:from-green-700 hover:to-emerald-700 transition-all duration-200">
                    Add Subcategory
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
// Create Category Modal Functions
function openCreateCategoryModal() {
    const modal = document.getElementById('createCategoryModal');
    const content = document.getElementById('createCategoryModalContent');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeCreateCategoryModal() {
    const modal = document.getElementById('createCategoryModal');
    const content = document.getElementById('createCategoryModalContent');
    
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        
        // Reset form
        document.getElementById('category_name').value = '';
        document.getElementById('category_description').value = '';
    }, 300);
}

// Subcategory Modal Functions
function openSubcategoryModal(categoryId, categoryName) {
    const modal = document.getElementById('createSubcategoryModal');
    const content = document.getElementById('createSubcategoryModalContent');
    const form = document.getElementById('subcategoryForm');
    const parentName = document.getElementById('subcategoryParentName');
    
    // Set form action and parent name
    form.action = `/adminpanel/categories/${categoryId}/subcategories`;
    parentName.textContent = `for ${categoryName}`;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeSubcategoryModal() {
    const modal = document.getElementById('createSubcategoryModal');
    const content = document.getElementById('createSubcategoryModalContent');
    
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        
        // Reset form
        document.getElementById('subcategory_name').value = '';
        document.getElementById('subcategory_description').value = '';
    }, 300);
}

// Delete Functions
function deleteCategory(categoryId) {
    if (confirm('Are you sure you want to delete this category? All subcategories will also be deleted.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/adminpanel/categories/${categoryId}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}

function deleteSubcategory(subcategoryId) {
    if (confirm('Are you sure you want to delete this subcategory?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/adminpanel/subcategories/${subcategoryId}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}

// Close modals on outside click
document.getElementById('createCategoryModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeCreateCategoryModal();
    }
});

document.getElementById('createSubcategoryModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeSubcategoryModal();
    }
});
</script>
@endpush
@endsection 