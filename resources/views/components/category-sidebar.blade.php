{{-- ============================================================
     AUTOMIZE CATEGORY SIDEBAR - Left Browse Menu
     ============================================================ --}}

<aside class="w-64 flex-shrink-0 hidden lg:block">
    {{-- Header --}}
    <div class="bg-[#d32f2f] text-white px-5 py-3.5 rounded-t flex items-center gap-2 shadow-lg shadow-red-900/50">
        <i class="bi bi-grid-3x3-gap-fill text-lg"></i>
        <span class="font-bold text-sm tracking-widest uppercase">Browse All Collection</span>
    </div>

    {{-- Category List --}}
    <div class="bg-gray-50 border border-gray-200 rounded-b shadow-lg overflow-hidden">
        @php
        $categories = \App\Models\Category::withCount('products')->where('status', 1)->get();
        @endphp

        @foreach($categories as $i => $cat)
        <div class="cat-item group relative border-b border-gray-200 last:border-0">
            <a href="{{ route('shop.index', ['category' => $cat->slug]) }}"
               class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 hover:text-[#d32f2f] transition-colors duration-200 {{ $i === 0 ? 'bg-white text-[#d32f2f]' : '' }}">
                {{-- Icon --}}
                <div class="w-8 h-8 rounded shrink-0 flex items-center justify-center {{ $i === 0 ? 'bg-[#d32f2f]/10' : 'bg-gray-900 group-hover:bg-[#d32f2f]/10' }} transition-colors">
                    <i class="bi bi-{{ $cat->icon }} text-sm {{ $i === 0 ? 'text-[#d32f2f]' : 'text-gray-500 group-hover:text-[#d32f2f]' }} transition-colors"></i>
                </div>
                {{-- Label --}}
                <span class="flex-1 text-sm font-medium">{{ $cat->name }}</span>
                {{-- Count + Arrow --}}
                <div class="flex items-center gap-2">
                    <span class="text-[10px] text-gray-500 font-medium">{{ $cat->products_count }}</span>
                    <i class="bi bi-chevron-right text-xs text-gray-600 group-hover:text-[#d32f2f] transition-colors"></i>
                </div>
            </a>
        </div>
        @endforeach

        {{-- View All --}}
        <div class="px-4 py-3 bg-white">
            <a href="{{ route('shop.index') }}" class="flex items-center justify-center gap-2 text-sm font-semibold text-[#d32f2f] hover:text-red-700 transition-colors">
                View All Categories <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</aside>
