@extends('layouts.admin')

@section('title', 'Order Management')

@section('content')

<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="font-syncopate text-2xl font-black text-gray-900 tracking-widest leading-none">
            ORDER <span class="text-gold">LOGS</span>
        </h1>
        <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-2">Manage customer transactions and fulfillment statuses.</p>
    </div>
</div>

<div class="glass-panel border-t-[4px] border-t-gold rounded flex flex-col overflow-hidden">
    <div class="p-6 overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold px-4">UID</th>
                    <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold px-4">Date</th>
                    <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold px-4">Client Detail</th>
                    <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold px-4">Total</th>
                    <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold px-4">Payment</th>
                    <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold px-4">Status & Control</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($orders as $order)
                    <tr class="hover:bg-black/5 transition-colors group border-b border-gray-200">
                        <td class="py-5 px-4 font-orbitron text-gray-800 font-bold group-hover:text-gold transition-colors">#{{ $order->order_number }}</td>
                        <td class="py-5 px-4 text-xs text-gray-600 font-bold uppercase">{{ $order->created_at->format('M j Y, H:i') }}</td>
                        <td class="py-5 px-4 flex flex-col">
                            <span class="text-gray-800 font-bold">{{ $order->customer_name ?? $order->user->name ?? 'Guest User' }}</span>
                            <span class="text-[10px] text-gray-500 font-medium">{{ $order->email ?? $order->user->email ?? 'N/A' }}</span>
                        </td>
                        <td class="py-5 px-4 text-gray-900 font-black">${{ number_format($order->total_amount, 2) }}</td>
                        <td class="py-5 px-4 flex flex-col gap-1">
                            <span class="text-[10px] font-black uppercase tracking-widest {{ $order->payment_method == 'cod' ? 'text-orange-500' : 'text-blue-500' }}">
                                {{ $order->payment_method == 'cod' ? 'Cash on Delivery' : ($order->online_payment_method ? ucwords($order->online_payment_method) : 'Online') }}
                            </span>
                            <span class="text-[9px] font-bold uppercase tracking-widest px-1.5 py-0.5 rounded w-max {{ $order->payment_status == 'paid' ? 'bg-green-500/10 text-green-500 border border-green-500/20' : 'bg-red-500/10 text-red-500 border border-red-500/20' }}">{{ $order->payment_status }}</span>
                            @if($order->payment_screenshot)
                                <a href="{{ asset('storage/' . $order->payment_screenshot) }}" target="_blank" class="text-[9px] text-blue-600 hover:text-blue-800 font-bold underline flex items-center gap-1 mt-1 transition-colors">
                                    <i class="bi bi-image"></i> View SS
                                </a>
                            @endif
                        </td>
                        <td class="py-5 px-4">
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <select name="status" class="bg-gray-50 border border-gray-200 text-xs font-bold text-gray-800 rounded px-2 py-1 outline-none focus:border-gold cursor-pointer uppercase tracking-wider">
                                    <option value="pending" {{ strtolower($order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ strtolower($order->status) == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ strtolower($order->status) == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ strtolower($order->status) == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ strtolower($order->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <button type="submit" class="bg-[#d32f2f] hover:bg-red-700 text-white transition-colors px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded shadow-sm shadow-red-900/20">Apply</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-500 text-xs font-bold uppercase tracking-widest">No order transmissions logged.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($orders->hasPages())
        <div class="p-6 border-t border-gray-200 bg-gray-100">
            {{ $orders->links('pagination::tailwind') }}
        </div>
    @endif
</div>

@endsection
