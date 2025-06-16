@extends('layouts.admin')

@section('title', 'Products - Admin Panel')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between space-y-4 lg:space-y-0">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Products Management</h1>
            <p class="text-gray-600 mt-1">Manage your artificial plants inventory</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-4 lg:px-6 py-3 rounded-xl font-medium hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 text-center">
            <i class="fas fa-plus mr-2"></i>Add New Product
        </a>
    </div>

    <!-- Search Bar -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        <form method="GET" action="{{ route('admin.products') }}" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search products by name, description, or category..." 
                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors font-medium">
                    <i class="fas fa-search mr-2"></i>Search
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.products') }}" class="bg-gray-100 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-200 transition-colors font-medium">
                        <i class="fas fa-times mr-2"></i>Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 lg:gap-6">
        @forelse($products as $product)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-gray-100 overflow-hidden">
                <!-- Product Image -->
                <div class="relative h-48 bg-gray-100">
                    @if($product->image)
                        <img src="{{ asset('product/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                            <i class="fas fa-seedling text-4xl text-gray-400"></i>
                        </div>
                    @endif
                    
                    <!-- Status Badge -->
                    <div class="absolute top-3 left-3">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $product->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($product->status) }}
                        </span>
                    </div>
                    
                    <!-- Stock Badge -->
                    <div class="absolute top-3 right-3">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $product->stock > 0 ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->stock }} in stock
                        </span>
                    </div>
                    
                    @if($product->sale_price && $product->discount_percentage > 0)
                        <div class="absolute bottom-3 left-3">
                            <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                -{{ $product->discount_percentage }}%
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="p-4">
                    <div class="mb-3">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $product->name }}</h3>
                        <div class="flex flex-wrap gap-1 text-xs text-gray-500">
                            @foreach($product->categories as $category)
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full">{{ $category->name }}</span>
                            @endforeach
                            @foreach($product->subcategories as $subcategory)
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full">{{ $subcategory->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    
                    @if($product->description)
                        <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ Str::limit($product->description, 80) }}</p>
                    @endif
                    
                    @if($product->keywords)
                        <div class="mb-3">
                            <p class="text-xs text-gray-400 mb-1">Keywords:</p>
                            <div class="flex flex-wrap gap-1">
                                @foreach(explode(',', $product->keywords) as $keyword)
                                    @if(trim($keyword))
                                        <span class="bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded-full">{{ trim($keyword) }}</span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- Price -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            @if($product->sale_price)
                                <span class="text-lg font-bold text-red-600">{{ $product->formatted_sale_price }}</span>
                                <span class="text-sm text-gray-500 line-through">{{ $product->formatted_price }}</span>
                            @else
                                <span class="text-lg font-bold text-gray-900">{{ $product->formatted_price }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="flex-1 bg-blue-50 text-blue-600 text-center py-2 rounded-lg hover:bg-blue-100 transition-colors font-medium text-sm">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <button onclick="deleteProduct({{ $product->id }})" class="flex-1 bg-red-50 text-red-600 text-center py-2 rounded-lg hover:bg-red-100 transition-colors font-medium text-sm">
                            <i class="fas fa-trash mr-1"></i>Delete
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-seedling text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">No Products Found</h3>
                    <p class="text-gray-600 mb-6">Start building your plant inventory by adding your first product.</p>
                    <a href="{{ route('admin.products.create') }}" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl font-medium hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg">
                        <i class="fas fa-plus mr-2"></i>Add First Product
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>

@push('scripts')
<script>
function deleteProduct(productId) {
    if (confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/adminpanel/products/${productId}`;
        
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
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush
@endsection 