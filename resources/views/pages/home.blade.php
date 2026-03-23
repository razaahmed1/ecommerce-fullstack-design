@extends('layouts.store')
@section('title', 'AutoParts Hub - Premium Car & Auto Parts')

@section('content')

{{-- HERO + SIDEBAR + PROMO --}}
<div class="bg-gray-50 border-b border-gray-200">
    @include('components.hero')
</div>

{{-- TRUST BADGES STRIP --}}
<div class="bg-white border-b border-gray-200">
    <div class="max-w-screen-xl mx-auto px-4 py-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
            $badges = [
            ['icon' => 'truck', 'color' => 'text-[#d32f2f]', 'title' => 'Free VIP Shipping', 'sub' => 'Orders over $200'],
            ['icon' => 'shield-fill-check', 'color' => 'text-[#d32f2f]', 'title' => 'Platinum Certified', 'sub' => '100% Authentic'],
            ['icon' => 'arrow-counterclockwise','color' => 'text-stone-400','title' => 'White Glove Returns', 'sub' => '30-day policy'],
            ['icon' => 'headset', 'color' => 'text-stone-400','title' => 'Concierge Support', 'sub' => 'Always here for you'],
            ];
            @endphp
            @foreach($badges as $badge)
            <div class="flex items-center gap-3 p-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="w-10 h-10 bg-white rounded flex items-center justify-center flex-shrink-0 shadow-[0_0_10px_rgba(211,47,47,0.1)]">
                    <i class="bi bi-{{ $badge['icon'] }} {{ $badge['color'] }} text-xl"></i>
                </div>
                <div>
                    <div class="font-bold text-gray-900 text-sm">{{ $badge['title'] }}</div>
                    <div class="text-gray-600 text-xs">{{ $badge['sub'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- POPULAR CATEGORIES --}}
<section class="py-14 bg-gray-100">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="flex items-center justify-between mb-8" data-aos="fade-up">
            <div>
                <p class="text-[#d32f2f] text-xs font-black uppercase tracking-widest mb-1">Browse by Type</p>
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Popular Categories</h2>
            </div>
            <a href="{{ route('shop.index') }}"
                class="text-sm font-black text-[#d32f2f] hover:text-red-700 flex items-center gap-1 transition-colors group uppercase tracking-widest">
                View All <i class="bi bi-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            @php
            $home_cats = [
                ['name' => 'Engine Parts', 'slug' => 'car-parts', 'icon' => 'gear-fill', 'icolor' => 'text-[#d32f2f]'],
                ['name' => 'Car Accessories', 'slug' => 'car-accessories', 'icon' => 'tools', 'icolor' => 'text-[#d32f2f]'],
                ['name' => 'Oil & Fluids', 'slug' => 'oil-additives', 'icon' => 'droplet-fill', 'icolor' => 'text-[#d32f2f]'],
                ['name' => 'Car Electronics', 'slug' => 'car-electronics', 'icon' => 'cpu-fill', 'icolor'=> 'text-[#d32f2f]'],
                ['name' => 'Car Care', 'slug' => 'car-care', 'icon' => 'stars', 'icolor' => 'text-[#d32f2f]'],
            ];
            @endphp
            @foreach($home_cats as $cat)
            @php
                $count = \App\Models\Product::whereHas('category', function($q) use ($cat) {
                    $q->where('slug', $cat['slug']);
                })->count();
            @endphp
            <a href="{{ route('shop.index', ['category' => $cat['slug']]) }}"
                class="group flex flex-col items-center gap-3 p-6 bg-white rounded hover:shadow-2xl hover:shadow-[#d32f2f]/20 hover:-translate-y-2 transition-all duration-500 border border-gray-100 hover:border-[#d32f2f]/50 text-center relative overflow-hidden"
                data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="absolute inset-0 bg-gradient-to-br from-red-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div
                    class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center shadow-inner group-hover:bg-[#d32f2f] transition-all duration-500 relative z-10">
                    <i class="bi bi-{{ $cat['icon'] }} {{ $cat['icolor'] }} text-3xl group-hover:text-white transition-colors duration-500 text-shadow"></i>
                </div>
                <div class="relative z-10">
                    <div
                        class="font-black text-gray-900 text-sm group-hover:text-[#d32f2f] transition-colors uppercase tracking-tight">
                        {{ $cat['name'] }}</div>
                    <div class="text-gray-400 text-[10px] font-black uppercase mt-1 tracking-[0.2em]">{{ $count }} Items
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- WHY CHOOSE US SECTION --}}
<section class="py-20 bg-gray-50 overflow-hidden">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <p class="text-[#d32f2f] text-xs font-black uppercase tracking-widest mb-2">The Platinum Advantage</p>
            <h2 class="text-4xl font-black text-gray-900 uppercase tracking-tight">Why Choose <span
                    class="text-[#d32f2f]">AutoParts Hub?</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white border border-gray-200 p-10 rounded hover:border-[#d32f2f]/30 hover:shadow-xl hover:shadow-[#d32f2f]/10 transition-all duration-500 text-center group"
                data-aos="fade-up" data-aos-delay="0">
                <div
                    class="w-20 h-20 bg-[#d32f2f]/10 rounded flex items-center justify-center text-[#d32f2f] text-4xl mb-6 mx-auto group-hover:bg-[#d32f2f] group-hover:text-white transition-all duration-500">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 mb-4 uppercase tracking-tight">Certified Quality</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Every part in our inventory undergoes rigorous quality testing to ensure it meets or exceeds OEM
                    standards.
                </p>
            </div>
            <div class="bg-white border border-gray-200 p-10 rounded hover:border-gray-500/30 hover:shadow-xl hover:shadow-gray-500/10 transition-all duration-500 text-center group"
                data-aos="fade-up" data-aos-delay="100">
                <div
                    class="w-20 h-20 bg-gray-600/10 rounded flex items-center justify-center text-gray-500 text-4xl mb-6 mx-auto group-hover:bg-gray-600 group-hover:text-white transition-all duration-500">
                    <i class="bi bi-lightning-charge"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 mb-4 uppercase tracking-tight">Express Delivery</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    We understand your urgency. Our VIP logistics network ensures parts reach your doorstep
                    within 24-48 hours.
                </p>
            </div>
            <div class="bg-white border border-gray-200 p-10 rounded hover:border-[#d32f2f]/30 hover:shadow-xl hover:shadow-[#d32f2f]/10 transition-all duration-500 text-center group"
                data-aos="fade-up" data-aos-delay="200">
                <div
                    class="w-20 h-20 bg-[#d32f2f]/10 rounded flex items-center justify-center text-[#d32f2f] text-4xl mb-6 mx-auto group-hover:bg-[#d32f2f] group-hover:text-white transition-all duration-500">
                    <i class="bi bi-headset"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 mb-4 uppercase tracking-tight">Concierge Support</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Our certified mechanics are available 24/7 to help you identify the exact part you need for your
                    vehicle.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- FEATURED PRODUCTS --}}
<section class="py-14 bg-gray-100 border-t border-gray-200">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="flex items-center justify-between mb-8" data-aos="fade-up">
            <div>
                <p class="text-[#d32f2f] text-xs font-black uppercase tracking-widest mb-1">Platinum Selection</p>
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Featured Products</h2>
            </div>
            <div class="hidden sm:flex gap-2">
                <button
                    class="px-5 py-2.5 bg-white text-[#d32f2f] border border-[#d32f2f]/30 text-[10px] font-black uppercase tracking-widest rounded hover:bg-[#d32f2f] hover:text-white transition-all shadow-lg active:scale-95">New
                    Arrivals</button>
                <button
                    class="px-5 py-2.5 bg-transparent border border-gray-300 text-gray-600 text-[10px] font-black uppercase tracking-widest rounded hover:border-[#d32f2f] hover:text-[#d32f2f] transition-all active:scale-95">Best
                    Sellers</button>
            </div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featured_products as $p)
                @php
                    $primaryImg = $p->images->where('is_primary', true)->first() ?? $p->images->first();
                    $imgPath = $primaryImg->image_path ?? 'https://via.placeholder.com/400';
                    $finalImg = (Str::startsWith($imgPath, 'http')) ? $imgPath : asset('storage/' . $imgPath);

                    $productData = [
                        'id' => $p->id,
                        'slug' => $p->slug,
                        'image' => $finalImg,
                        'brand' => $p->brand->name ?? 'Unknown',
                        'title' => $p->name,
                        'price' => $p->price,
                        'rating' => $p->averageRating(),
                        'reviewCount' => $p->approvedReviews->count(),
                    ];
                    if ($p->old_price) {
                        $productData['oldPrice'] = $p->old_price;
                        $discount = round((($p->old_price - $p->price) / $p->old_price) * 100);
                        $productData['badgeSale'] = "-{$discount}%";
                    }
                    if ($p->is_new) {
                        $productData['badgeNew'] = 'New';
                    }
                @endphp
                @include('components.product-card', $productData)
            @endforeach
        </div>
    </div>
</section>

{{-- PROMO BANNERS --}}
<section class="py-14 bg-gray-50">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Banner 1 --}}
            <div class="relative rounded overflow-hidden p-10 flex items-center justify-between group cursor-pointer border border-[#d32f2f]/30 hover:shadow-xl hover:shadow-[#d32f2f]/20 transition-all duration-500 bg-white"
                data-aos="fade-right">
                <div class="absolute inset-0 bg-gradient-to-r from-red-900/40 to-black opacity-80 z-0"></div>
                <div class="absolute right-0 top-0 bottom-0 w-48 opacity-10 group-hover:scale-110 group-hover:opacity-20 transition-all duration-700 z-0">
                    <i class="bi bi-lightning-fill text-[#d32f2f]" style="font-size: 16rem; line-height: 1;"></i>
                </div>
                <div class="relative z-10">
                        <p class="text-xs uppercase tracking-[0.2em] mb-4 text-gray-800">Limited Time Offer</p>
                        <h2 class="text-3xl font-black uppercase tracking-tight mb-2 text-gray-900">Winter Premium Collection</h2>
                        <p class="text-gray-600 text-sm mb-6 max-w-sm">Equip your vehicle with top-tier winter tires and freezing-point resilience fluids.</p>
                        <a href="{{ route('shop.index', ['category' => 'oil-additives']) }}" class="inline-flex items-center gap-2 bg-[#d32f2f] hover:bg-red-700 text-white font-black uppercase tracking-widest text-xs px-6 py-3 rounded transition-all shadow-lg active:scale-95">
                            Shop Winter Sale <i class="bi bi-arrow-right"></i>
                        </a>
                </div>
            </div>
            {{-- Banner 2 --}}
            <div class="relative rounded overflow-hidden p-10 flex items-center justify-between group cursor-pointer border border-stone-500/20 hover:shadow-xl hover:shadow-stone-500/10 transition-all duration-500 bg-white"
                 data-aos="fade-left">
                <div class="absolute inset-0 bg-gradient-to-r from-stone-800/40 to-black opacity-80 z-0"></div>
                <div class="absolute right-0 top-0 bottom-0 w-48 opacity-5 group-hover:scale-110 group-hover:opacity-10 transition-all duration-700 z-0">
                    <i class="bi bi-gear-fill text-stone-300" style="font-size: 16rem; line-height: 1;"></i>
                </div>
                <div class="relative z-10">
                    <p class="text-stone-400 text-[10px] font-black uppercase tracking-[0.3em] mb-3">Platinum Stock</p>
                    <h3 class="text-gray-900 font-black text-3xl uppercase leading-tight tracking-tighter">Engine Parts<br><span class="text-stone-400">Starting $149</span></h3>
                    <a href="{{ route('shop.index', ['category' => 'car-parts']) }}" class="inline-flex items-center gap-1.5 mt-6 bg-stone-300 hover:bg-white text-black text-xs font-black uppercase tracking-widest px-6 py-3.5 rounded transition-all active:scale-95 shadow-lg">
                        Shop Now <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- BRAND GRID --}}
<div data-aos="fade-up">
    @include('components.brand-grid')
</div>

{{-- NEWSLETTER --}}
<section class="py-0 bg-white">
    <div class="max-w-screen-xl mx-auto px-4 pb-8">
        <div class="rounded overflow-hidden shadow-2xl border border-red-900/40" style="background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%)" data-aos="zoom-in">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8 px-12 py-16">
                {{-- Left side text --}}
                <div class="lg:basis-3/5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-[#d32f2f] rounded flex items-center justify-center flex-shrink-0 shadow-lg shadow-red-900/50">
                            <i class="bi bi-envelope-heart-fill text-gray-900 text-xl"></i>
                        </div>
                        <span class="text-[#d32f2f] text-xs font-black uppercase tracking-[0.3em]">VIP Access</span>
                    </div>
                    <h2 class="text-gray-900 font-black text-4xl uppercase tracking-tighter leading-none mb-4">
                        Unlock <span class="text-[#d32f2f]">Exclusive Perks</span>
                    </h2>
                    <p class="text-gray-600 text-base leading-relaxed max-w-md font-medium">
                        Join our Platinum members and get first access to rare parts and premium discounts.
                    </p>
                </div>
                {{-- Right side form --}}
                <div class="w-full lg:basis-2/5">
                    <form class="flex flex-col sm:flex-row gap-4">
                        <input type="email" placeholder="Enter your email address..." class="flex-1 px-6 py-4.5 bg-white border border-gray-300 text-gray-900 placeholder-gray-500 rounded text-sm focus:outline-none focus:border-[#d32f2f] focus:ring-1 focus:ring-[#d32f2f] transition-all font-medium">
                        <button class="bg-[#d32f2f] hover:bg-red-700 text-white font-black uppercase tracking-widest px-8 py-4.5 rounded text-xs transition-all active:scale-95 flex items-center justify-center gap-2 flex-shrink-0 shadow-lg border-b-2 border-red-900">
                            Subscribe <i class="bi bi-send-fill text-lg"></i>
                        </button>
                    </form>
                    <p class="text-gray-500 text-[10px] font-bold uppercase tracking-widest mt-4 ml-1 flex items-center gap-2">
                        <i class="bi bi-shield-check text-[#d32f2f] text-sm"></i> Secure and encrypted. No spam ever.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- BACK TO TOP --}}
<button id="back-to-top" class="fixed bottom-8 right-8 w-14 h-14 bg-[#d32f2f] text-white rounded shadow-xl flex items-center justify-center opacity-0 invisible translate-y-10 transition-all duration-500 z-[99] hover:bg-red-700 hover:-translate-y-2 active:scale-95 group border border-red-800">
    <i class="bi bi-arrow-up text-2xl group-hover:animate-bounce"></i>
</button>

@endsection