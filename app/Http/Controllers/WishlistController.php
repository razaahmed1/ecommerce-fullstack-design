<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index()
    {
        return view('pages.wishlist', [
            'wishlist' => session('wishlist', [])
        ]);
    }

    public function add(Request $request, $id)
    {
        $product = Product::with('images')->findOrFail($id);
        
        $wishlist = session()->get('wishlist', []);
        
        // Use id as array key
        $wishlist[$id] = [
            "name" => $product->name,
            "price" => $product->price,
            "image" => $product->images->where('is_primary', true)->first()?->image_path ?? $product->images->first()?->image_path ?? 'https://placehold.co/400x400/111111/D4AF37?text=VIP'
        ];
        
        session()->put('wishlist', $wishlist);
        
        return redirect()->back()->with('success', 'Successfully added to VIP Wishlist!');
    }

    public function remove(Request $request, $id)
    {
        $wishlist = session()->get('wishlist');
        if(isset($wishlist[$id])) {
            unset($wishlist[$id]);
            session()->put('wishlist', $wishlist);
        }
        
        return redirect()->back()->with('success', 'Item removed from Wishlist.');
    }
}
