@extends('layouts.admin')

@section('title', 'Command Center')

@section('content')

{{-- METRICS ROW --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    
    {{-- Metric 1 --}}
    <div class="glass-panel p-6 rounded relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 text-[#d32f2f]/10 group-hover:text-[#d32f2f]/20 transition-colors">
            <i class="bi bi-currency-dollar" style="font-size: 8rem;"></i>
        </div>
        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1 relative z-10">Total Revenue</p>
        <h3 class="text-3xl font-black text-gray-900 tracking-tighter relative z-10">${{ number_format($metrics['total_revenue'], 2) }}</h3>
    </div>

    {{-- Metric 2 --}}
    <div class="glass-panel p-6 rounded relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 text-[#d32f2f]/10 group-hover:text-[#d32f2f]/20 transition-colors">
            <i class="bi bi-box-seam" style="font-size: 8rem;"></i>
        </div>
        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1 relative z-10">Orders Today</p>
        <h3 class="text-3xl font-black text-gray-900 tracking-tighter relative z-10">{{ $metrics['orders_today'] }}</h3>
    </div>

    {{-- Metric 3 --}}
    <div class="glass-panel p-6 rounded relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 text-[#d32f2f]/10 group-hover:text-[#d32f2f]/20 transition-colors">
            <i class="bi bi-people" style="font-size: 8rem;"></i>
        </div>
        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1 relative z-10">Total Clients</p>
        <h3 class="text-3xl font-black text-gray-900 tracking-tighter relative z-10">{{ $metrics['total_customers'] }}</h3>
    </div>

    {{-- Metric 4 --}}
    <div class="glass-panel p-6 rounded border-l-[4px] border-l-red-600 relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 text-red-500/10 group-hover:text-red-500/20 transition-colors">
            <i class="bi bi-exclamation-triangle" style="font-size: 8rem;"></i>
        </div>
        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1 relative z-10">Low Stock Alerts</p>
        <h3 class="text-3xl font-black text-red-500 tracking-tighter relative z-10">{{ $metrics['low_stock_items'] }}</h3>
    </div>

</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
    
    {{-- RECENT ORDERS --}}
    <div class="xl:col-span-2 glass-panel rounded overflow-hidden flex flex-col">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between bg-gray-100">
            <h2 class="font-syncopate font-bold text-gray-900 text-sm tracking-widest">Recent Transmissions</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-[10px] text-gold font-bold uppercase tracking-widest hover:text-gray-900 transition-colors">View Logs <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="p-6 flex-1 overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold">Order UID</th>
                        <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold">Client</th>
                        <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold">Amount</th>
                        <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-black/5 transition-colors group">
                            <td class="py-4 border-b border-gray-200 font-orbitron text-gray-800 font-bold group-hover:text-gold transition-colors">#{{ $order->order_number }}</td>
                            <td class="py-4 border-b border-gray-200 text-gray-600 font-medium">{{ $order->customer_name ?? $order->user->name ?? 'Guest' }}</td>
                            <td class="py-4 border-b border-gray-200 text-gray-900 font-black">${{ number_format($order->total_amount, 2) }}</td>
                            <td class="py-4 border-b border-gray-200">
                                @php $s = strtolower($order->status); @endphp
                                @if($s == 'completed' || $s == 'delivered')
                                    <span class="bg-green-900/40 text-green-400 border border-green-500/20 text-[10px] uppercase font-black px-2 py-1 rounded-md">{{ $order->status }}</span>
                                @elseif($s == 'processing' || $s == 'shipped')
                                    <span class="bg-blue-900/40 text-blue-400 border border-blue-500/20 text-[10px] uppercase font-black px-2 py-1 rounded-md">{{ $order->status }}</span>
                                @elseif($s == 'cancelled')
                                    <span class="bg-red-900/40 text-red-500 border border-red-500/20 text-[10px] uppercase font-black px-2 py-1 rounded-md">Terminated</span>
                                @else
                                    <span class="bg-red-950/40 text-[#d32f2f] border border-[#d32f2f]/20 text-[10px] uppercase font-black px-2 py-1 rounded-md">Pending</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-gray-500 text-xs font-bold uppercase tracking-widest">No order transmissions logged.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- LOW STOCK RADAR --}}
    <div class="glass-panel border-t-[4px] border-t-red-600 rounded flex flex-col">
        <div class="p-6 border-b border-gray-200 bg-red-900/5 flex items-center gap-3">
            <i class="bi bi-radar text-red-500 animate-pulse"></i>
            <h2 class="font-syncopate font-bold text-red-500 text-sm tracking-widest">Stock Radar</h2>
        </div>
        <div class="p-6 flex-1 flex flex-col gap-4">
            @forelse($lowStockProducts as $prod)
                <div class="flex items-center gap-4 p-3 bg-red-500/5 rounded-xl border border-gray-200 hover:border-red-500/30 transition-colors">
                    <div class="w-12 h-12 bg-gray-50 rounded-lg p-1 border border-gray-200 shrink-0">
                        <img src="{{ Str::startsWith($prod->images->first()->image_path ?? '', 'http') ? $prod->images->first()->image_path : asset('storage/' . ($prod->images->first()->image_path ?? 'products/default.jpg')) }}" class="w-full h-full object-cover rounded shadow-sm mix-blend-multiply">
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <h4 class="text-gray-900 text-xs font-bold truncate">{{ $prod->name }}</h4>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">SKU: {{ $prod->sku }}</p>
                    </div>
                    <div class="flex flex-col items-end shrink-0">
                        <span class="text-xs font-black {{ $prod->stock == 0 ? 'text-red-500' : 'text-[#d32f2f]' }}">{{ $prod->stock }} LEFT</span>
                        <a href="{{ route('admin.products.index', ['low_stock' => true]) }}" class="text-[9px] text-gray-600 hover:text-gray-900 uppercase mt-1 border-b border-gray-300">Restock</a>
                    </div>
                </div>
            @empty
                <div class="h-full flex flex-col items-center justify-center text-center opacity-50 py-8">
                    <i class="bi bi-shield-check text-4xl text-green-500 mb-2"></i>
                    <p class="text-xs font-bold text-gray-600 tracking-widest uppercase">Inventory Optimal</p>
                    <p class="text-[10px] text-gray-600 mt-1">All systems operating within acceptable parameters.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>

@endsection
