{{-- ============================================================
     AUTOMIZE BRAND GRID - Car Manufacturers Logos
     ============================================================ --}}

<section class="py-14 bg-gray-50 border-t border-gray-200">
    <div class="max-w-screen-xl mx-auto px-4">
        {{-- Section Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <p class="text-[#d32f2f] text-xs font-bold uppercase tracking-widest mb-1">Trusted Brands</p>
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Shop by Brand</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="text-sm font-semibold text-[#d32f2f] hover:text-red-500 flex items-center gap-1 transition-colors">
                All Brands <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        {{-- Brand Grid --}}
        @php
        $brands = \App\Models\Brand::where('status', 1)->get();
        @endphp

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @foreach($brands as $brand)
            <a href="{{ route('shop.index', ['brand' => $brand->slug]) }}"
               class="group flex flex-col items-center justify-center gap-2 p-5 bg-white rounded border border-gray-200 hover:border-[#d32f2f]/30 hover:shadow-[0_0_20px_rgba(211,47,47,0.15)] hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                {{-- Brand Initials as Logo --}}
                <div class="w-12 h-12 rounded-xl bg-gray-100 shadow-[inset_0_2px_10px_rgba(0,0,0,0.5)] border border-gray-200 flex items-center justify-center group-hover:border-[#d32f2f]/50 transition-colors">
                    <span class="text-lg font-black text-gray-800 group-hover:text-[#d32f2f]">{{ strtoupper(substr($brand->name, 0, 2)) }}</span>
                </div>
                <span class="text-xs font-bold text-gray-600 group-hover:text-[#d32f2f] transition-colors text-center tracking-wide">{{ $brand->name }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>
