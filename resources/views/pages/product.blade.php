@extends('layouts.store')
@section('title', $product->name . ' - AutoParts Hub')

@section('content')

{{-- BREADCRUMB --}}
<div class="bg-gray-50 border-b border-gray-200 py-4">
    <div class="max-w-screen-xl mx-auto px-4 flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-gray-500">
        <a href="/" class="hover:text-[#d32f2f] transition-colors">Home</a>
        <i class="bi bi-chevron-right text-[8px]"></i>
        <a href="{{ route('shop.index') }}" class="hover:text-[#d32f2f] transition-colors">Shop</a>
        <i class="bi bi-chevron-right text-[8px]"></i>
        <span class="text-[#d32f2f]">{{ $product->category->name ?? 'Parts' }}</span>
    </div>
</div>

{{-- PRODUCT SHOWCASE --}}
<section class="py-12 lg:py-20 bg-gray-100">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">
            
            {{-- Product Image Gallery --}}
            <div data-aos="fade-right" class="flex flex-col gap-4">
                {{-- Main Viewport --}}
                <div class="relative w-full aspect-square rounded-lg overflow-hidden bg-white border border-gray-200 hover:border-[#d32f2f]/30 transition-all shadow-2xl flex items-center justify-center p-8 group">
                    @php
                        $primaryImg = $product->images->where('is_primary', true)->first() ?? $product->images->first();
                        $imgPath = $primaryImg->image_path ?? 'products/default.jpg';
                        $finalImg = (Str::startsWith($imgPath, 'http')) ? $imgPath : asset('storage/' . $imgPath);
                    @endphp
                    <img id="main-product-image" 
                         src="{{ $finalImg }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-contain mix-blend-multiply scale-100 group-hover:scale-110 transition-transform duration-700">
                         
                    @if($product->is_new)
                        <div class="absolute top-6 left-6 bg-[#d32f2f] text-white text-xs font-black uppercase px-4 py-2 rounded shadow-lg shadow-red-900/50">
                            Brand New
                        </div>
                    @endif
                </div>

                {{-- Thumbnails --}}
                @if($product->images && $product->images->count() > 1)
                <div class="grid grid-cols-4 sm:grid-cols-5 gap-3">
                    @foreach($product->images as $img)
                        @php $imgSrc = (Str::startsWith($img->image_path, 'http') ? $img->image_path : asset('storage/' . $img->image_path)); @endphp
                        <div onclick="changeMainImage('{{ $imgSrc }}', this)" 
                             class="thumbnail-item relative aspect-square rounded bg-white border {{ $loop->first ? 'border-[#d32f2f]' : 'border-gray-800' }} hover:border-[#d32f2f] cursor-pointer flex items-center justify-center p-2 overflow-hidden transition-all shadow-sm group">
                            <img src="{{ $imgSrc }}" class="w-full h-full object-cover mix-blend-multiply opacity-70 group-hover:opacity-100 {{ $loop->first ? 'opacity-100' : '' }} transition-opacity">
                            <div class="absolute inset-0 bg-[#d32f2f]/10 opacity-0 group-hover:opacity-100 {{ $loop->first ? 'opacity-100' : '' }} transition-opacity"></div>
                        </div>
                    @endforeach
                </div>
                <script>
                    function changeMainImage(src, element) {
                        document.getElementById('main-product-image').src = src;
                        
                        document.querySelectorAll('.thumbnail-item').forEach(el => {
                            el.classList.remove('border-[#d32f2f]');
                            el.classList.add('border-gray-800');
                            el.querySelector('img').classList.remove('opacity-100');
                            el.querySelector('img').classList.add('opacity-70');
                            el.querySelector('div').classList.remove('opacity-100');
                        });
                        
                        element.classList.remove('border-gray-800');
                        element.classList.add('border-[#d32f2f]');
                        element.querySelector('img').classList.remove('opacity-70');
                        element.querySelector('img').classList.add('opacity-100');
                        element.querySelector('div').classList.add('opacity-100');
                    }
                </script>
                @endif
            </div>

            {{-- Product Info --}}
            <div class="flex flex-col justify-center" data-aos="fade-left">
                <div class="mb-4">
                    <span class="text-[#d32f2f] text-[10px] font-black uppercase tracking-[0.3em] bg-[#d32f2f]/10 px-3 py-1.5 rounded-lg border border-[#d32f2f]/20">
                        {{ $product->brand->name ?? 'Platinum Series' }}
                    </span>
                </div>
                
                <h1 class="text-4xl lg:text-5xl font-black text-gray-900 leading-tight uppercase tracking-tight mb-4">
                    {{ $product->name }}
                </h1>
                
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex items-center gap-1">
                        @for($i=0; $i<5; $i++)
                            <i class="bi bi-star-fill text-[#d32f2f] text-sm drop-shadow-[0_0_5px_rgba(211,47,47,0.5)]"></i>
                        @endfor
                    </div>
                    <a href="#" class="text-gray-600 text-sm font-semibold hover:text-gray-900 transition-colors">48 Reviews</a>
                    <span class="w-1 h-1 bg-gray-700 rounded-full"></span>
                    <span class="text-green-500 text-sm font-bold flex items-center gap-1 shadow-green-500/20">
                        <i class="bi bi-check-circle-fill"></i> In Stock (SKU: {{ $product->sku }})
                    </span>
                </div>
                
                <div class="flex items-end gap-3 mb-8">
                    <span class="text-4xl lg:text-5xl font-black text-gray-900 tracking-tighter">${{ number_format($product->price, 2) }}</span>
                    @if($product->old_price)
                        <span class="text-xl text-gray-500 line-through font-bold mb-1">${{ number_format($product->old_price, 2) }}</span>
                        <span class="text-sm font-black bg-red-600/20 text-red-500 border border-red-600/30 px-2 py-1 rounded-lg mb-2 ml-2">SAVE {{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}%</span>
                    @endif
                </div>
                
                <div class="prose prose-p:text-gray-600 prose-p:leading-relaxed mb-10">
                    <p>{{ $product->description ?? 'Premium automotive component forged from high-density materials ensuring unparalleled performance and striking aesthetic precision.' }}</p>
                </div>
                
                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 mb-10">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button class="w-full bg-gradient-to-r from-red-700 to-[#d32f2f] hover:from-[#d32f2f] hover:to-red-500 text-black font-black uppercase tracking-widest text-sm py-4.5 rounded transition-all shadow-[0_10px_25px_rgba(211,47,47,0.3)] active:scale-95 flex items-center justify-center gap-3">
                            <i class="bi bi-bag-plus-fill text-lg"></i> Add to Cart
                        </button>
                    </form>
                    
                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                        @csrf
                        <button class="h-full px-6 bg-white border border-gray-300 text-[#d32f2f] hover:bg-[#d32f2f] hover:text-black rounded transition-all shadow-xl active:scale-95 flex items-center justify-center" title="Save to VIP Wishlist">
                            <i class="bi bi-heart-fill text-xl"></i>
                        </button>
                    </form>
                </div>
                
                {{-- Trust Badges --}}
                <div class="grid grid-cols-2 gap-4 border-t border-gray-200 pt-8 mt-auto">
                    <div class="flex items-center gap-3">
                        <i class="bi bi-shield-check text-[#d32f2f] text-2xl"></i>
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-gray-900 uppercase tracking-wider">Lifetime Warranty</span>
                            <span class="text-[10px] text-gray-500 font-medium">100% Guaranteed</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="bi bi-truck text-[#d32f2f] text-2xl"></i>
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-gray-900 uppercase tracking-wider">Free Expedited</span>
                            <span class="text-[10px] text-gray-500 font-medium">Delivery in 48hrs</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- PRODUCT REVIEWS SECTION --}}
<section class="py-20 bg-white border-t border-gray-200">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-16">
            {{-- Review List --}}
            <div class="lg:w-2/3">
                <div class="flex items-center justify-between mb-12">
                    <div>
                        <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tight mb-2">Customer <span class="bg-[#d32f2f] text-white px-3 py-1 rounded shadow-lg">Reviews</span></h2>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-1">
                                @php $avg = $product->averageRating(); @endphp
                                @for($i=1; $i<=5; $i++)
                                    <i class="bi bi-star{{ $i <= floor($avg) ? '-fill' : '' }} text-lg {{ $i <= floor($avg) ? 'text-[#d32f2f]' : 'text-gray-300' }}"></i>
                                @endfor
                            </div>
                            <span class="text-gray-900 font-bold text-lg">{{ $avg }} / 5.0</span>
                            <span class="text-gray-400 font-medium">|</span>
                            <span class="text-gray-500 font-medium">{{ $product->approvedReviews->count() }} Verified VIP Reviews</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    @forelse($product->approvedReviews as $review)
                        <div class="bg-gray-50 border border-gray-200 p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between mb-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white border border-gray-200 rounded-full flex items-center justify-center text-[#d32f2f] font-black text-xl shadow-inner">
                                        {{ substr($review->customer_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-black text-gray-900 uppercase tracking-tight text-sm">{{ $review->customer_name }}</h4>
                                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest mt-1">{{ $review->created_at->format('M d, Y') }} • Verified Owner</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-0.5">
                                    @for($i=1; $i<=5; $i++)
                                        <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }} text-xs {{ $i <= $review->rating ? 'text-[#d32f2f]' : 'text-gray-300' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-gray-700 leading-relaxed text-sm font-medium italic">"{{ $review->comment }}"</p>
                        </div>
                    @empty
                        <div class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-[30px] p-12 text-center">
                            <i class="bi bi-chat-left-dots text-gray-300 text-5xl mb-6 block"></i>
                            <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight mb-2">No Reviews Yet</h3>
                            <p class="text-gray-500 text-sm max-w-sm mx-auto">Be the first to share your experience with this premium component.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Review Form --}}
            <div class="lg:w-1/3">
                <div class="bg-gray-100 border border-gray-200 p-10 rounded-[30px] shadow-2xl shadow-black/5 sticky top-24">
                    <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tight mb-8">Write a <span class="text-[#d32f2f]">Review</span></h3>
                    
                    <form action="{{ route('product.review.store', $product->slug) }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-600 mb-2.5">Your Name</label>
                                <input type="text" name="customer_name" required placeholder="Enter full name..." 
                                       class="w-full bg-white text-gray-900 border border-gray-300 focus:border-[#d32f2f] rounded-xl px-5 py-3.5 outline-none transition-all shadow-sm text-sm font-medium">
                            </div>

                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-600 mb-2.5">Rating</label>
                                <select name="rating" required class="w-full bg-white text-gray-900 border border-gray-300 focus:border-[#d32f2f] rounded-xl px-5 py-3.5 outline-none transition-all shadow-sm text-sm font-black appearance-none">
                                    <option value="5">★★★★★ Exceptional (5/5)</option>
                                    <option value="4">★★★★☆ Great (4/5)</option>
                                    <option value="3">★★★☆☆ Average (3/5)</option>
                                    <option value="2">★★☆☆☆ Below Par (2/5)</option>
                                    <option value="1">★☆☆☆☆ Poor (1/5)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-600 mb-2.5">Review Details</label>
                                <textarea name="comment" required rows="4" placeholder="Tell us about your experience..." 
                                          class="w-full bg-white text-gray-900 border border-gray-300 focus:border-[#d32f2f] rounded-xl px-5 py-3.5 outline-none transition-all shadow-sm text-sm font-medium resize-none"></textarea>
                            </div>

                            <button type="submit" class="w-full bg-[#d32f2f] hover:bg-red-700 text-white font-black uppercase tracking-widest py-4.5 rounded transition-all shadow-lg shadow-red-900/40 active:scale-95 text-xs">
                                Submit VIP Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- RELATED PRODUCTS --}}
@if(count($relatedProducts) > 0)
<section class="py-20 bg-gray-50 border-t border-gray-200">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Complete <span class="bg-clip-text text-transparent bg-gradient-to-r from-red-500 to-red-700">The Build</span></h2>
        </div>
        
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $rel)
                @php
                    $primaryImg = $rel->images->where('is_primary', true)->first() ?? $rel->images->first();
                    $imgPath = $primaryImg->image_path ?? 'products/default.jpg';
                    $finalImg = (Str::startsWith($imgPath, 'http')) ? $imgPath : asset('storage/' . $imgPath);

                    $productData = [
                        'id' => $rel->id,
                        'slug' => $rel->slug,
                        'image' => $finalImg,
                        'brand' => $rel->brand->name ?? 'Unknown',
                        'title' => $rel->name,
                        'price' => $rel->price,
                        'rating' => $rel->averageRating(),
                        'reviewCount' => $rel->approvedReviews->count(),
                    ];
                    if ($rel->old_price) {
                        $productData['oldPrice'] = $rel->old_price;
                        $discount = round((($rel->old_price - $rel->price) / $rel->old_price) * 100);
                        $productData['badgeSale'] = "-{$discount}%";
                    }
                    if ($rel->is_new) $productData['badgeNew'] = 'New';
                @endphp
                @include('components.product-card', $productData)
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
