<div class="group bg-gray-100 rounded border border-gray-200 overflow-hidden hover:shadow-xl hover:shadow-red-900/10 hover:border-[#d32f2f]/50 transition-all duration-500 flex flex-col h-full"
    data-aos="fade-up">
    {{-- Product Image & Overlay --}}
    <div class="relative w-full h-64 sm:h-72 overflow-hidden bg-white">
        <img src="{{ $image }}" alt="{{ $title }}" loading="lazy"
            class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-90 group-hover:opacity-100 mix-blend-multiply">

        {{-- Badges --}}
        <div class="absolute top-4 left-4 flex flex-col gap-2 z-10">
            @if(isset($badgeSale))
            <span
                class="bg-[#d32f2f] text-white text-[10px] font-black uppercase px-2.5 py-1 rounded shadow-lg shadow-red-900/50">{{
                $badgeSale }}</span>
            @endif
            @if(isset($badgeNew))
            <span
                class="bg-stone-300 text-black text-[10px] font-black uppercase px-2.5 py-1 rounded shadow-lg shadow-black/50">{{
                $badgeNew }}</span>
            @endif
        </div>

        {{-- Hover Actions --}}
        <div
            class="absolute inset-0 bg-white/90 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-2.5 z-20 backdrop-blur-[2px]">
            <form action="{{ route('wishlist.add', $id ?? 0) }}" method="POST">
                @csrf
                <button
                    class="w-11 h-11 bg-white hover:bg-[#d32f2f] hover:text-white text-gray-300 border border-gray-300 hover:border-[#d32f2f] rounded flex items-center justify-center transition-all duration-300 shadow-xl hover:-translate-y-1 active:scale-95"
                    title="Add to Wishlist">
                    <i class="bi bi-heart text-lg"></i>
                </button>
            </form>
            <a href="{{ route('product.show', $slug ?? $id ?? 0) }}"
                class="w-11 h-11 bg-white hover:bg-[#d32f2f] hover:text-white text-gray-300 border border-gray-300 hover:border-[#d32f2f] rounded flex items-center justify-center transition-all duration-300 shadow-xl hover:-translate-y-1 active:scale-95"
                title="Quick View">
                <i class="bi bi-eye text-lg"></i>
            </a>
            <a href="{{ route('product.show', $slug ?? $id ?? 0) }}"
                class="w-11 h-11 bg-white hover:bg-[#d32f2f] hover:text-white text-gray-300 border border-gray-300 hover:border-[#d32f2f] rounded flex items-center justify-center transition-all duration-300 shadow-xl hover:-translate-y-1 active:scale-95"
                title="Compare VIP Specs">
                <i class="bi bi-arrow-left-right text-lg"></i>
            </a>
        </div>
    </div>

    {{-- Content --}}
    <div class="p-6 flex flex-col flex-1 bg-gray-100">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[10px] font-black text-gray-600 border border-gray-200 px-2 py-0.5 rounded uppercase tracking-widest">{{ $brand ?? 'Platinum'
                }}</span>
            <div class="flex items-center gap-0.5" title="Rating: {{ $rating ?? 0 }}/5">
                @php $fullStars = floor($rating ?? 0); @endphp
                @for($i=1; $i<=5; $i++)
                    <i class="bi bi-star{{ $i <= $fullStars ? '-fill' : '' }} text-[10px] {{ $i <= $fullStars ? 'text-[#d32f2f]' : 'text-gray-400' }}"></i>
                @endfor
                <span class="text-[9px] text-gray-500 font-bold ml-1">({{ $reviewCount ?? 0 }})</span>
            </div>
        </div>

        <a href="{{ route('product.show', $slug ?? $id ?? 0) }}"
            class="font-bold text-gray-900 text-base mb-4 group-hover:text-[#d32f2f] transition-colors line-clamp-2 leading-tight flex-1">
            {{ $title }}
        </a>

        <div class="mt-auto pt-5 border-t border-gray-200 flex items-center justify-between">
            <div class="flex flex-col">
                @if(isset($oldPrice))
                <span class="text-gray-500 text-xs line-through font-medium">${{ number_format($oldPrice, 2) }}</span>
                @endif
                <span class="text-lg md:text-xl font-black text-gray-900 tracking-tight">${{ number_format($price, 2) }}</span>
            </div>

            <form action="{{ route('cart.add', $id ?? 0) }}" method="POST">
                @csrf
                <button
                    class="bg-white hover:bg-[#d32f2f] hover:text-white border border-gray-300 hover:border-[#d32f2f] px-3 md:px-4 py-2 md:py-2.5 rounded text-xs font-bold transition-all active:scale-95 shadow-lg flex flex-row items-center gap-2 group/btn whitespace-nowrap flex-shrink-0">
                    <i class="bi bi-cart-plus text-base group-hover/btn:scale-110 transition-transform"></i>
                    <span class="hidden sm:inline">Add to Cart</span>
                </button>
            </form>
        </div>
    </div>
</div>