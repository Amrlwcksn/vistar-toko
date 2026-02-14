<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Product;
use App\Models\StoreSetting;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_highlight', true)->get();
        // If no highlighted services, take top 3
        if ($services->isEmpty()) {
            $services = Service::take(3)->get();
        }

        $all_services = Service::all();
        
        $products = Product::where('status', 'active')->with('category')->latest()->get();
        $setting = StoreSetting::first();
        
        // Group products by category for a nicer display if needed, or just list them
        $categories = Category::has('products')->get();

        return view('home', compact('services', 'all_services', 'products', 'setting', 'categories'));
    }
}
