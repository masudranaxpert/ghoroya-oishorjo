<?php

namespace App\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Auth\Models\Product;
use App\Auth\Models\Category;
use App\Auth\Models\Subcategory;
use App\Auth\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    /**
     * Show products page
     */
    public function index(Request $request)
    {
        $query = Product::with(['categories', 'subcategories'])->orderBy('created_at', 'desc');
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('keywords', 'like', "%{$search}%")
                  ->orWhereHas('categories', function($cat) use ($search) {
                      $cat->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        $products = $query->get();
        return view('auth.admin.products.index', compact('products'));
    }

    /**
     * Show create product page
     */
    public function create()
    {
        $categories = Category::with('subcategories')->orderBy('name')->get();
        return view('auth.admin.products.create', compact('categories'));
    }

    /**
     * Store new product
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'subcategories' => 'nullable|array',
            'subcategories.*' => 'nullable|exists:subcategories,id',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(['name', 'description', 'keywords', 'price', 'sale_price', 'stock']);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $uploadPath = public_path('product');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $image->move($uploadPath, $imageName);
            $data['image'] = $imageName;
        }

        $data['status'] = 'active';
        $data['slug'] = Str::slug($request->name);

        $product = Product::create($data);

        // Handle multiple categories
        $categories = $request->categories;
        $subcategories = $request->subcategories ?? [];
        
        foreach ($categories as $index => $categoryId) {
            $subcategoryId = null;
            if (isset($subcategories[$index]) && !empty($subcategories[$index])) {
                $subcategoryId = $subcategories[$index];
            }
            
            ProductCategory::create([
                'product_id' => $product->id,
                'category_id' => $categoryId,
                'subcategory_id' => $subcategoryId
            ]);
        }

        return redirect()->route('admin.products')->with('success', 'Product created successfully!');
    }

    /**
     * Show edit product page
     */
    public function edit(Product $product)
    {
        $categories = Category::with('subcategories')->orderBy('name')->get();
        return view('auth.admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update product
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image && file_exists(public_path('product/' . $product->image))) {
                unlink(public_path('product/' . $product->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            
            $uploadPath = public_path('product');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $image->move($uploadPath, $imageName);
            $data['image'] = $imageName;
        }

        $product->update($data);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    /**
     * Delete product
     */
    public function destroy(Product $product)
    {
        // Delete image file
        if ($product->image && file_exists(public_path('product/' . $product->image))) {
            unlink(public_path('product/' . $product->image));
        }
        
        $product->delete();
        
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }

    /**
     * Get subcategories by category (AJAX)
     */
    public function getSubcategories(Category $category)
    {
        return response()->json($category->subcategories);
    }
} 