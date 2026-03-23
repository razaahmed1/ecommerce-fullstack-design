<form action="{{ route('shop.index') }}" method="GET">
    {{-- Search --}}
    <div class="mb-8">
        <label class="block text-gray-600 font-bold uppercase tracking-widest text-[10px] mb-3 ml-1">Search Catalog</label>
        <div class="relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Part name, SKU..."
                class="w-full bg-white text-gray-900 placeholder-gray-400 border border-gray-200 focus:border-[#d32f2f] rounded-2xl pl-10 pr-4 py-4 outline-none transition-all shadow-sm text-xs font-bold">
            <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
        </div>
    </div>

    {{-- Categories --}}
    <div class="mb-8">
        <label class="block text-gray-600 font-bold uppercase tracking-widest text-[10px] mb-4 ml-1">Categories</label>
        <ul class="space-y-4">
            <li>
                <a href="{{ route('shop.index', array_merge(request()->query(), ['category' => ''])) }}" 
                   class="flex items-center gap-3 group {{ !request('category') ? 'text-[#d32f2f] font-black' : 'text-gray-500 hover:text-gray-900' }} transition-colors text-xs uppercase tracking-wider">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center border {{ !request('category') ? 'bg-red-50 border-red-200' : 'bg-white border-gray-100 group-hover:border-red-100' }}">
                        <i class="bi bi-grid-fill"></i>
                    </div>
                    All Parts
                </a>
            </li>
            @foreach($categories as $cat)
                <li>
                    <a href="{{ route('shop.index', array_merge(request()->query(), ['category' => $cat->slug])) }}" 
                       class="flex items-center gap-3 group {{ request('category') == $cat->slug ? 'text-[#d32f2f] font-black' : 'text-gray-500 hover:text-gray-900' }} transition-colors text-xs uppercase tracking-wider">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center border {{ request('category') == $cat->slug ? 'bg-red-50 border-red-200' : 'bg-white border-gray-100 group-hover:border-red-100' }}">
                            <i class="bi bi-{{ $cat->icon }}"></i>
                        </div>
                        {{ $cat->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Brands --}}
    <div class="mb-8">
        <label class="block text-gray-600 font-bold uppercase tracking-widest text-[10px] mb-4 ml-1">Performance Brands</label>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('shop.index', array_merge(request()->query(), ['brand' => ''])) }}" 
               class="px-4 py-2.5 text-[9px] font-black uppercase tracking-widest rounded-xl border {{ !request('brand') ? 'bg-gray-900 border-gray-900 text-white shadow-xl shadow-gray-900/20' : 'bg-white border-gray-100 text-gray-600 hover:border-red-200 hover:text-[#d32f2f]' }} transition-all">
                All Brands
            </a>
            @foreach($brands as $brand)
                <a href="{{ route('shop.index', array_merge(request()->query(), ['brand' => $brand->slug])) }}" 
                   class="px-4 py-2.5 text-[9px] font-black uppercase tracking-widest rounded-xl border {{ request('brand') == $brand->slug ? 'bg-[#d32f2f] border-[#d32f2f] text-white shadow-xl shadow-red-500/20' : 'bg-white border-gray-100 text-gray-600 hover:border-red-200 hover:text-[#d32f2f]' }} transition-all">
                    {{ $brand->name }}
                </a>
            @endforeach
        </div>
    </div>

    <button type="submit" class="w-full bg-gray-900 hover:bg-[#d32f2f] text-white font-black uppercase tracking-widest py-4.5 rounded-2xl transition-all shadow-xl hover:shadow-red-500/20 active:scale-95 text-[10px]">
        Apply VIP Filters
    </button>
    
    @if(request()->hasAny(['search', 'category', 'brand']))
        <a href="{{ route('shop.index') }}" class="block text-center mt-5 text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-[#d32f2f] transition-colors">
            Clear My Filters
        </a>
    @endif
</form>
