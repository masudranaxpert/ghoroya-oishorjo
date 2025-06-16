<?php

namespace App\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Auth\Models\Category;
use App\Auth\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminCategoryController extends Controller
{
    /**
     * Show categories page
     */
    public function index()
    {
        $categories = Category::with('subcategories')->orderBy('name')->get();
        return view('auth.admin.categories', compact('categories'));
    }

    /**
     * Store new category
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'active',
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category created successfully!');
    }

    /**
     * Store new subcategory
     */
    public function storeSubcategory(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:subcategories,name',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category->subcategories()->create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'active',
        ]);

        return redirect()->route('admin.categories')->with('success', 'Subcategory created successfully!');
    }

    /**
     * Delete category
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully!');
    }

    /**
     * Delete subcategory
     */
    public function destroySubcategory(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('admin.categories')->with('success', 'Subcategory deleted successfully!');
    }
} 