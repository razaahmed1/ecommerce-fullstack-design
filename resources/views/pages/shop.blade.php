@extends('layouts.store')
@section('title', 'VIP Catalog - AutoParts Hub')

@section('content')
<div class="bg-gray-50 min-h-screen pt-40 pb-16 relative">
    {{-- Decorative Background --}}
    <div class="absolute top-0 right-0 w-1/3 h-[600px] bg-red-900/10 blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-1/2 h-1/2 bg-stone-800/10 blur-[150px] pointer-events-none"></div>

    <div class="max-w-screen-xl mx-auto px-4 relative z-10">
        
        <div class="text-center mb-12 animate-fade-up">
            <h1 class="text-4xl md:text-5xl font-black text-gray-900 uppercase tracking-tight mb-4 flex justify-center items-center gap-3">The VIP <span class="bg-[#d32f2f] px-4 py-1 rounded shadow-lg text-white">Catalog</span></h1>
            <p class="text-gray-600 text-sm max-w-xl mx-auto">Explore our curated collection of premium automotive parts. Engineered for perfection, designed for true enthusiasts.</p>
        </div>

        {{-- Mobile Filter Toggle --}}
        <div class="lg:hidden mb-6">
            <button onclick="toggleFilterDrawer()" class="w-full bg-white border border-gray-200 text-gray-900 font-black uppercase tracking-widest py-4 rounded-2xl shadow-sm flex items-center justify-center gap-3 active:scale-95 transition-all">
                <i class="bi bi-sliders text-xl text-[#d32f2f]"></i>
                Filter & Search
            </button>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Filter Sidebar (Desktop) --}}
            <aside class="hidden lg:block lg:w-1/4 flex-shrink-0">
                <div class="bg-gray-100 border border-gray-200 p-6 rounded-[30px] shadow-[0_20px_40px_rgba(0,0,0,0.5)] sticky top-24">
                    @include('partials.shop-filters')
                </div>
            </aside>

            {{-- Filter Drawer (Mobile) --}}
            <div id="filter-drawer" class="fixed inset-0 z-[100] transform transition-transform duration-500 translate-x-full lg:hidden">
                <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="toggleFilterDrawer()"></div>
                <div class="absolute inset-y-0 right-0 w-4/5 max-w-sm bg-gray-50 shadow-2xl p-8 overflow-y-auto">
                    <div class="flex items-center justify-between mb-8 border-b border-gray-200 pb-5">
                        <h2 class="text-xl font-black text-gray-900 uppercase tracking-widest">Filters</h2>
                        <button onclick="toggleFilterDrawer()" class="text-gray-400 hover:text-[#d32f2f] transition-colors">
                            <i class="bi bi-x-lg text-2xl"></i>
                        </button>
                    </div>
                    @include('partials.shop-filters')
                </div>
            </div>

            {{-- Product Grid --}}
            <main class="flex-grow">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                        @foreach($products as $p)
                            @php
                                $primaryImg = $p->images->where('is_primary', true)->first() ?? $p->images->first();
                                $imgPath = $primaryImg->image_path ?? 'products/default.jpg';
                                $finalImg = (Str::startsWith($imgPath, 'http')) ? $imgPath : asset('storage/' . $imgPath);

                                $productData = [
                                    'id' => $p->id,
                                    'slug' => $p->slug,
                                    'image' => $finalImg,
                                    'brand' => $p->brand->name ?? 'Unknown',
                                    'title' => $p->name,
                                    'price' => $p->price,
                                    'oldPrice' => $p->old_price,
                                    'rating' => $p->averageRating(),
                                    'reviewCount' => $p->approvedReviews->count(),
                                ];
                                if ($p->old_price) {
                                    $discount = round((($p->old_price - $p->price) / $p->old_price) * 100);
                                    $productData['badgeSale'] = "-{$discount}%";
                                } elseif ($p->is_featured) {
                                    $productData['badgeSale'] = "VIP Exclusive";
                                }
                                if ($p->is_new) {
                                    $productData['badgeNew'] = "New Arrival";
                                }
                            @endphp
                            @include('components.product-card', $productData)
                        @endforeach
                    </div>
                    
                    {{-- Pagination (Wrapped in VIP Styling) --}}
                    @if ($products->hasPages())
                        <div class="px-6 py-4 bg-gray-100 rounded border border-gray-200 shadow-[0_10px_20px_rgba(0,0,0,0.5)]">
                            {{ $products->links() }}
                        </div>
                    @endif
                @else
                    <div class="bg-gray-100 border border-gray-200 rounded-[30px] p-16 text-center shadow-[0_20px_40px_rgba(0,0,0,0.5)]">
                        <div class="w-24 h-24 bg-white border border-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="bi bi-search text-gray-500 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tight mb-2">No Parts Found</h3>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto">We couldn't find any premium parts matching your current filters. Modifying your search may yield better results.</p>
                        <a href="{{ route('shop.index') }}" class="inline-block bg-[#d32f2f] hover:bg-red-700 text-white font-black uppercase tracking-widest py-3.5 px-8 rounded transition-all shadow-lg shadow-red-900/40 active:scale-95">
                            Reset Catalog
                        </a>
                    </div>
                @endif
            </main>
        </div>
    </div>
</div>

<script>
    function toggleFilterDrawer() {
        const drawer = document.getElementById('filter-drawer');
        const body = document.body;
        if (drawer.classList.contains('translate-x-full')) {
            drawer.classList.remove('translate-x-full');
            drawer.classList.add('translate-x-0');
            body.style.overflow = 'hidden';
        } else {
            drawer.classList.remove('translate-x-0');
            drawer.classList.add('translate-x-full');
            body.style.overflow = 'auto';
        }
    }
</script>
@endsection
