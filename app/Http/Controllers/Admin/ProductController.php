<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand']);
        
        if ($request->has('low_stock')) {
            $query->where('stock', '<=', 5);
        }
        
        $products = $query->orderBy('stock', 'asc')->paginate(20);
        return view('admin.products', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products-create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name) . '-' . uniqid();
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->old_price = $request->old_price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->description = $request->description;
        $product->is_featured = $request->has('is_featured');
        $product->is_new = $request->has('is_new');
        $product->status = $request->has('status');
        $product->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/products'), $filename);
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => '/storage/products/' . $filename,
                    'is_primary' => $index === 0
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully with images!');
    }

    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|integer|min:0'
        ]);

        $product = Product::findOrFail($id);
        $product->stock = $request->stock;
        $product->save();

        return redirect()->back()->with('success', "Stock updated successfully for {$product->name}.");
    }
}
