<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\StoreSetting;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $setting = StoreSetting::first();
        $categories = Category::withCount('products')->get();
        
        $query = Product::where('status', 'active');

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Category Filter
        if ($request->has('category') && $request->category != '') {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();

        return view('guest.products.index', compact('products', 'categories', 'setting'));
    }

    public function show($slug)
    {
        $setting = StoreSetting::first();
        $product = Product::where('slug', $slug)->where('status', 'active')->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->take(4)
            ->get();

        return view('guest.products.show', compact('product', 'relatedProducts', 'setting'));
    }
}
