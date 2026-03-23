<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Models\Product;
use App\Models\Coupon;
use App\Mail\OrderConfirmed;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (!$cart || count($cart) == 0) {
            return redirect('/cart')->with('error', 'Your VIP cart is empty. Add some premium items first.');
        }

        $total = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
        
        return view('pages.checkout', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart');
        
        if (!$cart || count($cart) == 0) {
            return redirect()->back()->with('error', 'Your VIP cart is empty.');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'payment_method' => 'required|in:cod,online',
            'online_payment_method' => 'required_if:payment_method,online|in:card,easypaisa,jazzcash',
            'payment_screenshot' => 'required_if:online_payment_method,easypaisa,jazzcash|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $total = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
        
        // Apply Coupon Discount
        $discount = 0;
        $coupon = session()->get('coupon');
        if ($coupon) {
            $discount = $coupon['type'] == 'fixed' ? $coupon['value'] : ($total * ($coupon['value'] / 100));
        }

        $tax = ($total - $discount) * 0.08;
        $grandTotal = ($total - $discount) + $tax;

        DB::beginTransaction();

        try {
            $orderNumber = 'ORD-' . strtoupper(Str::random(8));
            
            $screenshotPath = null;
            if ($request->hasFile('payment_screenshot')) {
                $screenshotPath = $request->file('payment_screenshot')->store('payments', 'public');
            }

            $orderId = DB::table('orders')->insertGetId([
                'user_id' => auth()->id(), // nullable
                'order_number' => $orderNumber,
                'customer_name' => $validated['customer_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'zip_code' => $validated['zip_code'],
                'total_amount' => $grandTotal,
                'status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'online_payment_method' => $validated['online_payment_method'] ?? null,
                'payment_status' => ($validated['payment_method'] == 'online' && ($validated['online_payment_method'] ?? '') == 'card') ? 'paid' : 'unpaid',
                'payment_screenshot' => $screenshotPath,
                'discount_amount' => $discount,
                'coupon_code' => $coupon['code'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Increment Coupon Usage
            if ($coupon) {
                Coupon::where('id', $coupon['id'])->increment('used_count');
            }

            foreach ($cart as $item) {
                // Insert Order Item
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Decrement Stock
                Product::where('id', $item['id'])->decrement('stock', $item['quantity']);
            }

            DB::commit();
            
            // Send Order Confirmation Email
            $order = Order::with('items.product')->find($orderId);
            try {
                Mail::to($order->email)->send(new OrderConfirmed($order));
            } catch (\Exception $e) {
                // Log email failure but don't fail the order
                \Log::error('Email failed to send for Order #' . $orderNumber . ': ' . $e->getMessage());
            }

            session()->forget('cart');
            
            return redirect('/')->with('success', "Your VIP order $orderNumber has been placed successfully!");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Checkout failed. Please try again.');
        }
    }
}
