<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);

        $slug = Str::slug($validated['name']);
        
        // Ensure slug uniqueness
        $count = Category::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) $slug .= '-' . ($count + 1);

        Category::create([
            'name' => $validated['name'],
            'slug' => $slug
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id
        ]);

        $slug = Str::slug($validated['name']);
         // Ensure slug uniqueness
        $count = Category::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $category->id)->count();
        if ($count > 0) $slug .= '-' . ($count + 1);

        $category->update([
            'name' => $validated['name'],
            'slug' => $slug
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Category $category)
    {
        // Optional: Check if products exist before deleting
        if ($category->products()->count() > 0) {
            return back()->withErrors(['error' => 'Kategori tidak dapat dihapus karena masih digunakan oleh produk.']);
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus');
    }
}
