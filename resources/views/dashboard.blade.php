@extends('layouts.store')

@section('title', 'Client VIP Console - AutoParts Hub')

@section('content')

{{-- BREADCRUMB --}}
<div class="bg-gray-50 border-b border-gray-200 py-4">
    <div class="max-w-screen-xl mx-auto px-4 flex items-center justify-between">
        <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-gray-500">
            <a href="/" class="hover:text-[#d32f2f] transition-colors">Home</a>
            <i class="bi bi-chevron-right text-[8px]"></i>
            <span class="text-[#d32f2f]">VIP Control Panel</span>
        </div>
        
        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button class="text-[10px] text-gray-600 font-bold uppercase tracking-widest hover:text-red-500 transition-colors flex items-center gap-2">
                <i class="bi bi-power"></i> Secure Logout
            </button>
        </form>
    </div>
</div>

<section class="py-12 lg:py-20 bg-gray-100 min-h-[70vh]">
    <div class="max-w-screen-xl mx-auto px-4">
        
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            {{-- PROFILE SIDEBAR --}}
            <div class="lg:col-span-1">
                <div class="bg-white border border-gray-200 rounded-lg p-6 text-center shadow-2xl relative overflow-hidden" data-aos="fade-right">
                    <div class="absolute inset-0 bg-gradient-to-b from-[#d32f2f]/5 to-transparent pointer-events-none"></div>
                    
                    <div class="relative z-10">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-br from-red-700 to-red-500 rounded-full p-[2px] mb-4 shadow-[0_0_20px_rgba(211,47,47,0.3)]">
                            <div class="w-full h-full bg-gray-50 rounded-full flex flex-col items-center justify-center">
                                <span class="text-2xl font-black text-gray-900 italic">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                        </div>
                        
                        <h2 class="text-xl font-black text-gray-900 uppercase tracking-tight mb-1">{{ Auth::user()->name }}</h2>
                        <p class="text-xs text-gray-500 font-bold tracking-widest mb-6">{{ Auth::user()->email }}</p>
                        
                        <div class="flex flex-col gap-3">
                            <a href="{{ route('profile.edit') }}" class="w-full py-4 bg-gray-50 border border-gray-200 hover:border-[#d32f2f] text-gray-800 hover:text-[#d32f2f] text-xs font-black uppercase tracking-widest rounded-xl transition-colors shadow-sm flex items-center justify-center gap-2">
                                <i class="bi bi-gear-fill"></i> Account Settings
                            </a>
                            <a href="{{ route('wishlist.index') }}" class="w-full py-4 bg-gray-50 border border-gray-200 hover:border-[#d32f2f] text-gray-800 hover:text-[#d32f2f] text-xs font-black uppercase tracking-widest rounded-xl transition-colors shadow-sm flex items-center justify-center gap-2">
                                <i class="bi bi-heart-fill"></i> VIP Wishlist
                            </a>
                            @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="w-full py-4 bg-gradient-to-r from-red-700 to-[#d32f2f] hover:from-[#d32f2f] hover:to-red-500 text-black text-xs font-black uppercase tracking-widest rounded-xl transition-transform active:scale-95 shadow-xl flex items-center justify-center gap-2 mt-4">
                                <i class="bi bi-shield-lock-fill"></i> Enter Admin Core
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- ORDER HISTORY --}}
            <div class="lg:col-span-3">
                <div class="flex items-center gap-3 mb-8" data-aos="fade-left">
                    <i class="bi bi-box-seam-fill text-[#d32f2f] text-2xl drop-shadow-[0_0_8px_rgba(211,47,47,0.8)]"></i>
                    <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Transmission <span class="text-gray-500 text-[10px] tracking-[0.3em] font-bold ml-2">ORDER LOGS</span></h2>
                </div>

                @if($orders->count() > 0)
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-2xl" data-aos="fade-up">
                        <div class="overflow-x-auto p-4 sm:p-6">
                            <table class="w-full text-left border-collapse min-w-[600px]">
                                <thead>
                                    <tr>
                                        <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold px-2">Order UID</th>
                                        <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold px-2">Date Transmitted</th>
                                        <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold px-2">Total Value</th>
                                        <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold px-2">Payment</th>
                                        <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold px-2">Current Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    @foreach($orders as $order)
                                        <tr class="hover:bg-black/5 transition-colors group">
                                            <td class="py-5 px-2 font-orbitron text-gray-800 font-bold group-hover:text-[#d32f2f] transition-colors border-b border-gray-200">#{{ $order->order_number }}</td>
                                            <td class="py-5 px-2 text-gray-600 font-medium border-b border-gray-200">{{ $order->created_at->format('M jS, Y') }}</td>
                                            <td class="py-5 px-2 text-gray-900 font-black border-b border-gray-200">${{ number_format($order->total_amount, 2) }}</td>
                                            <td class="py-5 px-2 border-b border-gray-200">
                                                <div class="flex flex-col">
                                                    <span class="text-[10px] font-black uppercase tracking-tight text-gray-800">{{ $order->payment_method == 'cod' ? 'COD' : ($order->online_payment_method ? ucwords($order->online_payment_method) : 'Online') }}</span>
                                                    <span class="text-[9px] font-bold uppercase tracking-widest {{ $order->payment_status == 'paid' ? 'text-green-500' : 'text-orange-500' }}">{{ $order->payment_status }}</span>
                                                </div>
                                            </td>
                                            <td class="py-5 px-2 border-b border-gray-200">
                                                @if($order->status == 'Completed' || $order->status == 'Delivered')
                                                    <span class="bg-green-900/30 text-green-500 border border-green-500/20 text-[10px] uppercase tracking-widest font-black px-3 py-1.5 rounded-lg shadow-sm"><i class="bi bi-check-circle-fill mr-1"></i> {{ $order->status }}</span>
                                                @elseif($order->status == 'Processing' || $order->status == 'Shipped')
                                                    <span class="bg-blue-900/30 text-blue-500 border border-blue-500/20 text-[10px] uppercase tracking-widest font-black px-3 py-1.5 rounded-lg shadow-sm"><i class="bi bi-arrow-repeat mr-1"></i> {{ $order->status }}</span>
                                                @elseif($order->status == 'Cancelled')
                                                    <span class="bg-red-900/30 text-red-500 border border-red-500/20 text-[10px] uppercase tracking-widest font-black px-3 py-1.5 rounded-lg shadow-inner"><i class="bi bi-x-circle-fill mr-1"></i> Terminated</span>
                                                @else
                                                    <span class="bg-red-950/30 text-[#d32f2f] border border-[#d32f2f]/20 text-[10px] uppercase tracking-widest font-black px-3 py-1.5 rounded-lg shadow-inner"><i class="bi bi-hourglass-split mr-1"></i> Pending Review</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="bg-white border border-gray-200 rounded-lg p-12 text-center shadow-2xl relative overflow-hidden" data-aos="fade-up">
                        <div class="w-24 h-24 mx-auto bg-gray-900 rounded-full flex items-center justify-center mb-6 shadow-inner border border-gray-200">
                            <i class="bi bi-receipt-cutoff text-4xl text-gray-600"></i>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tight mb-2">No Active Logs</h3>
                        <p class="text-gray-500 text-sm max-w-sm mx-auto mb-8 font-medium">You have not transmitted any orders yet. Visit the catalog to begin building your vehicle layout.</p>
                        <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-red-700 to-[#d32f2f] hover:from-red-500 text-black font-black uppercase tracking-widest text-xs px-8 py-4 rounded-xl transition-transform active:scale-95 shadow-[0_10px_25px_rgba(211,47,47,0.3)]">
                            Begin Search <i class="bi bi-search"></i>
                        </a>
                    </div>
                @endif
                
            </div>
        </div>

    </div>
</section>

@endsection
