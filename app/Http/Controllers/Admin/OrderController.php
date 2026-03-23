<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusUpdated;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.orders', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->status = strtolower($request->status);
        
        // Auto-mark as paid if delivered
        if (strtolower($request->status) == 'delivered') {
            $order->payment_status = 'paid';
        }

        $order->save();

        // Send Status Update Email
        try {
            Mail::to($order->email)->send(new OrderStatusUpdated($order));
        } catch (\Exception $e) {
            \Log::error('Status Update Email failed for Order #' . $order->order_number . ': ' . $e->getMessage());
        }

        return redirect()->back()->with('success', "Order #{$order->order_number} status updated to {$order->status}.");
    }
}
