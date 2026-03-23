@extends('layouts.store')
@section('title', 'Your VIP Cart - AutoParts Hub')

@section('content')
<div class="bg-gray-50 min-h-screen py-16">
    <div class="max-w-screen-xl mx-auto px-4">
        <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tight mb-8">Your <span class="bg-clip-text text-transparent bg-gradient-to-r from-red-500 to-red-700">Cart</span></h1>

        @if(session('success'))
            <div class="bg-green-900/20 border border-green-500/30 text-green-400 px-6 py-4 rounded mb-8 flex items-center gap-3 shadow-[0_4px_20px_rgba(34,197,94,0.1)]">
                <i class="bi bi-check-circle-fill text-xl"></i>
                <span class="font-bold tracking-wide">{{ session('success') }}</span>
            </div>
        @endif

        @if(count($cart ?? []) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-4">
                @foreach($cart as $id => $details)
                    <div class="bg-white border border-gray-200 rounded-[30px] p-6 flex items-center gap-6 shadow-[0_10px_30px_rgba(0,0,0,0.5)] hover:border-[#d32f2f]/20 transition-all duration-500 group">
                        <div class="w-28 h-28 bg-gray-100 rounded overflow-hidden flex-shrink-0 shadow-sm p-2 border border-gray-200 group-hover:border-[#d32f2f]/30 transition-colors">
                            <img src="{{ (Str::startsWith($details['image'] ?? '', 'http')) ? $details['image'] : asset('storage/' . ($details['image'] ?? 'products/default.jpg')) }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover rounded-xl mix-blend-multiply opacity-90 group-hover:scale-110 group-hover:opacity-100 transition-all duration-700">
                        </div>
                        <div class="flex-grow">
                            <h3 class="text-gray-900 font-black text-lg leading-tight mb-2 tracking-tight">{{ $details['name'] }}</h3>
                            <div class="text-[#d32f2f] font-black text-xl">${{ number_format($details['price'], 2) }}</div>
                        </div>
                        <div class="flex items-center gap-4 border-l border-gray-200 pl-6 ml-2">
                            <div class="flex items-center bg-gray-100 border border-gray-300 rounded-xl overflow-hidden shadow-sm">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="m-0">
                                    @csrf
                                    <input type="hidden" name="action" value="decrement">
                                    <button type="submit" class="w-10 h-12 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-[#d32f2f] transition-colors border-r border-gray-300">
                                        <i class="bi bi-dash-lg"></i>
                                    </button>
                                </form>
                                <div class="px-4 py-3 text-gray-900 font-black text-lg min-w-[3rem] text-center">
                                    {{ $details['quantity'] }}
                                </div>
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="m-0">
                                    @csrf
                                    <input type="hidden" name="action" value="increment">
                                    <button type="submit" class="w-10 h-12 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-green-600 transition-colors border-l border-gray-300">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </form>
                            </div>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-12 h-12 bg-gray-100 text-red-500 border border-red-900/30 hover:bg-red-500/10 hover:border-red-500/50 rounded-xl flex items-center justify-center transition-all duration-300 active:scale-95 shadow-[0_4px_10px_rgba(0,0,0,0.3)]">
                                    <i class="bi bi-trash text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="lg:col-span-1 space-y-6">
                {{-- Coupon Box --}}
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-gray-500 mb-4">VIP Coupon Code</h3>
                    @if(session('coupon'))
                        <div class="flex items-center justify-between bg-green-50 border border-green-200 p-3 rounded-lg">
                            <span class="text-green-700 font-black text-sm uppercase">{{ session('coupon')['code'] }} Applied!</span>
                            <form action="{{ route('cart.coupon.remove') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-black uppercase tracking-widest">Remove</button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('cart.coupon.apply') }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="text" name="code" placeholder="Enter VIP CODE..." class="flex-1 bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-xs font-bold uppercase tracking-widest focus:border-[#d32f2f] outline-none transition-all">
                            <button type="submit" class="bg-gray-900 text-white font-black uppercase tracking-widest text-[10px] px-4 py-2.5 rounded transition-all hover:bg-black active:scale-95">Apply</button>
                        </form>
                        @if(session('error'))
                            <p class="text-red-500 text-[10px] font-black uppercase mt-2 ml-1">{{ session('error') }}</p>
                        @endif
                    @endif
                </div>

                <div class="bg-white border border-[#d32f2f]/20 rounded-lg p-8 shadow-[0_20px_40px_rgba(211,47,47,0.05)] sticky top-24">
                    <h2 class="text-xl font-black text-gray-900 uppercase tracking-widest mb-6 border-b border-gray-200 pb-5">Order Summary</h2>
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-gray-600 font-medium">
                            <span class="tracking-wide">Subtotal</span>
                            <span class="text-gray-900 font-bold">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600 font-medium">
                            <span class="tracking-wide">VIP Shipping</span>
                            <span class="text-[#d32f2f] font-bold uppercase tracking-widest text-xs flex items-center">Free</span>
                        </div>
                        @if($discount > 0)
                        <div class="flex justify-between text-green-600 font-bold border-t border-gray-100 pt-4">
                            <span class="tracking-wide uppercase text-xs">VIP Discount</span>
                            <span class="">-${{ number_format($discount, 2) }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between text-gray-600 font-medium pb-4 border-b border-gray-200">
                            <span class="tracking-wide">Tax (Estimated)</span>
                            <span class="text-gray-900 font-bold">${{ number_format(($total - $discount) * 0.08, 2) }}</span>
                        </div>
                        <div class="pt-2 flex justify-between items-center">
                            <span class="text-gray-900 font-black uppercase tracking-widest text-lg">Total</span>
                            <span class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-red-700">${{ number_format(($total - $discount) + (($total - $discount) * 0.08), 2) }}</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('checkout.index') }}" class="w-full bg-gradient-to-r from-red-700 to-[#d32f2f] hover:from-[#d32f2f] hover:to-red-500 text-black font-black uppercase tracking-widest py-4.5 rounded transition-all shadow-[0_10px_25px_rgba(211,47,47,0.3)] active:scale-95 flex items-center justify-center gap-2">
                        <i class="bi bi-shield-lock-fill text-lg"></i> Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="bg-white border border-gray-200 rounded-lg p-20 text-center shadow-[0_20px_50px_rgba(0,0,0,0.5)] max-w-2xl mx-auto mt-10">
            <div class="w-28 h-28 bg-gray-100 border border-gray-200 rounded-full flex items-center justify-center mx-auto mb-8 shadow-sm">
                <i class="bi bi-cart-x text-5xl text-gray-700"></i>
            </div>
            <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tighter mb-4">Your Cart is Empty</h2>
            <p class="text-gray-600 mb-10 text-lg leading-relaxed px-4">Looks like you haven't added any premium parts to your cart yet. Discover optimal performance components today.</p>
            <a href="/" class="inline-flex bg-gray-100 hover:bg-[#d32f2f] text-gray-300 hover:text-black border border-gray-300 hover:border-[#d32f2f] font-black uppercase tracking-widest px-10 py-5 rounded transition-all duration-300 shadow-[0_10px_20px_rgba(0,0,0,0.3)] hover:shadow-[0_10px_20px_rgba(211,47,47,0.3)] hover:-translate-y-1">
                Continue Shopping
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
