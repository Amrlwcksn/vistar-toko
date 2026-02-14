<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhereHas('category', function($cq) use ($search) {
                      $cq->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        $slug = Str::slug($request->name);
        // Ensure slug uniqueness
        $count = Product::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) $slug .= '-' . ($count + 1);
        
        $validated['slug'] = $slug;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        Product::create($validated);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        if ($request->name !== $product->name) {
            $slug = Str::slug($request->name);
             $count = Product::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $product->id)->count();
            if ($count > 0) $slug .= '-' . ($count + 1);
            $validated['slug'] = $slug;
        }

        if ($request->hasFile('image')) {
            if ($product->image_url) {
                $oldPath = str_replace('/storage/', '', $product->image_url);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        $product->update($validated);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        if ($product->image_url) {
            $oldPath = str_replace('/storage/', '', $product->image_url);
            Storage::disk('public')->delete($oldPath);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus');
    }
}
