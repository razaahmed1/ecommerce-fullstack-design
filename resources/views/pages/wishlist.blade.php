@extends('layouts.store')
@section('title', 'VIP Wishlist - AutoParts Hub')

@section('content')

{{-- BREADCRUMB --}}
<div class="bg-gray-50 border-b border-gray-200 py-4">
    <div class="max-w-screen-xl mx-auto px-4 flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-gray-500">
        <a href="/" class="hover:text-[#d32f2f] transition-colors">Home</a>
        <i class="bi bi-chevron-right text-[8px]"></i>
        <span class="text-[#d32f2f]">VIP Wishlist</span>
    </div>
</div>

{{-- WISHLIST AREA --}}
<section class="py-12 lg:py-20 bg-gray-100 min-h-[60vh]">
    <div class="max-w-screen-xl mx-auto px-4">
        
        <div class="flex flex-col md:flex-row items-end justify-between mb-10 gap-4" data-aos="fade-up">
            <div>
                <p class="text-[#d32f2f] text-xs font-black uppercase tracking-[0.3em] mb-2">Saved Collection</p>
                <h1 class="text-4xl lg:text-5xl font-black text-gray-900 uppercase tracking-tight">Your <span class="bg-clip-text text-transparent bg-gradient-to-r from-red-500 to-red-700">Wishlist</span></h1>
            </div>
            <span class="text-gray-600 font-bold bg-white px-4 py-2 border border-gray-200 rounded-xl shadow-sm">{{ count($wishlist) }} Saved Items</span>
        </div>

        @if(session('success'))
            <div class="bg-gradient-to-r from-green-900/30 to-green-800/10 border border-green-500/30 text-green-400 p-4 rounded mb-8 font-bold flex items-center gap-3">
                <i class="bi bi-check-circle-fill text-xl"></i> {{ session('success') }}
            </div>
        @endif

        @if(count($wishlist) > 0)
            <div class="grid grid-cols-1 gap-4" data-aos="fade-up" data-aos-delay="100">
                @foreach($wishlist as $id => $item)
                    <div class="bg-white border border-gray-200 hover:border-[#d32f2f]/30 rounded-lg p-4 sm:p-6 flex flex-col sm:flex-row items-center gap-6 transition-all duration-300 shadow-xl group relative overflow-hidden">
                        {{-- Image --}}
                        <div class="w-32 h-32 bg-gray-50 rounded p-2 shrink-0 border border-gray-200 shadow-sm group-hover:scale-105 transition-transform">
                            <img src="{{ $item['image'] }}" class="w-full h-full object-cover mix-blend-multiply rounded-xl" alt="{{ $item['name'] }}">
                        </div>
                        
                        {{-- Info --}}
                        <div class="flex-1 text-center sm:text-left">
                            <h3 class="text-xl font-black text-gray-900 hover:text-[#d32f2f] transition-colors uppercase leading-tight mb-2">
                                <a href="{{ route('product.show', $id) }}">{{ $item['name'] }}</a>
                            </h3>
                            <div class="text-2xl font-black text-[#d32f2f] tracking-tighter mb-4">${{ number_format($item['price'], 2) }}</div>
                            <div class="flex flex-col sm:flex-row items-center gap-3">
                                <form action="{{ route('cart.add', $id) }}" method="POST">
                                    @csrf
                                    <button class="bg-gradient-to-r from-red-700 to-[#d32f2f] hover:from-[#d32f2f] hover:to-red-500 text-black font-black uppercase tracking-widest text-[10px] px-6 py-3 rounded-xl transition-all shadow-[0_4px_15px_rgba(211,47,47,0.3)] active:scale-95 flex items-center justify-center gap-2">
                                        <i class="bi bi-cart-plus-fill text-sm"></i> Move to Cart
                                    </button>
                                </form>
                                <a href="{{ route('product.show', $id) }}" class="text-gray-600 hover:text-gray-900 font-bold text-xs uppercase tracking-widest border border-gray-300 bg-gray-50 px-6 py-3 rounded-xl transition-all shadow-sm hover:bg-gray-800 active:scale-95">Inspect Specs</a>
                            </div>
                        </div>

                        {{-- Remove --}}
                        <div class="absolute top-4 right-4 sm:relative sm:top-0 sm:right-0">
                            <form action="{{ route('wishlist.remove', $id) }}" method="POST">
                                @csrf
                                <button class="w-10 h-10 bg-red-900/20 text-red-500 hover:bg-red-500 hover:text-white rounded-xl flex items-center justify-center transition-all border border-red-500/20 hover:shadow-[0_0_15px_rgba(239,68,68,0.4)]" title="Remove">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-12 flex justify-center text-center">
                 <a href="{{ route('shop.index') }}" class="text-gray-600 hover:text-[#d32f2f] font-bold uppercase tracking-widest text-sm flex items-center gap-2 transition-colors">
                     <i class="bi bi-arrow-left"></i> Continue Shopping
                 </a>
            </div>

        @else
            <div class="bg-white border border-gray-200 rounded-lg p-12 lg:p-24 text-center shadow-2xl relative overflow-hidden" data-aos="zoom-in">
                <div class="absolute inset-0 bg-gradient-to-b from-[#d32f2f]/5 to-transparent pointer-events-none"></div>
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-32 h-32 bg-gray-900 rounded-full flex items-center justify-center mb-8 border border-gray-200 shadow-[0_0_50px_rgba(0,0,0,0.5)]">
                        <i class="bi bi-heart text-gray-700 hover:text-[#d32f2f] transition-colors duration-1000" style="font-size: 4rem;"></i>
                    </div>
                    <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tight mb-4">Your Wishlist is Empty</h2>
                    <p class="text-gray-600 max-w-md mx-auto mb-10 font-medium leading-relaxed">You haven't added any premium parts to your VIP collection yet. Start browsing to forge your dream build.</p>
                    <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-red-700 to-[#d32f2f] hover:from-[#d32f2f] hover:to-red-500 text-black font-black uppercase tracking-widest px-8 py-5 rounded transition-all shadow-[0_10px_25px_rgba(211,47,47,0.3)] active:scale-95">
                        Explore Catalog <i class="bi bi-arrow-right text-xl"></i>
                    </a>
                </div>
            </div>
        @endif
        
    </div>
</section>

@endsection
