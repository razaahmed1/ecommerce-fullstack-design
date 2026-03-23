<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['brand', 'images'])->where('status', 1);

        // Search Text Filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Category Filter
        if ($request->filled('category')) {
            $catSlug = $request->category;
            $query->whereHas('category', function($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        // Brand Filter
        if ($request->filled('brand')) {
            $brandSlug = $request->brand;
            $query->whereHas('brand', function($q) use ($brandSlug) {
                $q->where('slug', $brandSlug);
            });
        }

        // Enforce VIP aesthetic with a clean 9 grid
        $products = $query->paginate(9)->withQueryString();
        
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();

        return view('pages.shop', compact('products', 'categories', 'brands'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'images']);
        $relatedProducts = Product::with(['category', 'brand', 'images'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('pages.product', compact('product', 'relatedProducts'));
    }
}
