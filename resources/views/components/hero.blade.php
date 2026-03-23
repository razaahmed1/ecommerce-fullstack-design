{{-- ============================================================
AUTOMIZE HERO SECTION - Carousel Slider with Promo Card
============================================================ --}}

<div class="relative overflow-hidden">

    {{-- HERO CONTAINER: Sidebar + Slides + Promo Card --}}
    <div class="max-w-screen-xl mx-auto px-4 py-6">
        <div class="flex gap-5">

            {{-- LEFT: Category Sidebar --}}
            @include('components.category-sidebar')

            {{-- CENTER: Hero Slider --}}
            <div class="flex-1 relative rounded overflow-hidden min-h-[440px]">

                {{-- SLIDE 1: Car Wheels --}}
                <div class="hero-slide active absolute inset-0 flex flex-col justify-center transition-opacity duration-1000 opacity-100 z-10"
                    style="background: linear-gradient(135deg, #f9fafb 0%, #ffffff 50%, #f9fafb 100%);">
                    {{-- BG decoration --}}
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute -top-20 -right-20 w-96 h-96 bg-red-800 opacity-5 rounded-full blur-3xl">
                        </div>
                        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-[#d32f2f] opacity-5 rounded-full blur-3xl">
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="relative z-10 flex items-center justify-between w-full px-10 py-8">
                        <div class="max-w-sm animate-fade-up">
                            <span
                                class="inline-flex items-center gap-1.5 bg-[#d32f2f] text-white text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded mb-4 shadow-lg shadow-red-900/50">
                                <i class="bi bi-stars"></i> New Arrivals
                            </span>
                            <h1 class="text-4xl xl:text-5xl font-black text-gray-900 leading-tight mb-3 uppercase">
                                Car Wheels<br>
                                <span class="bg-[#d32f2f] px-2 py-0.5 text-white">Premium Edition</span>
                            </h1>
                            <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                                Premium alloy wheels engineered for performance and style. Perfect for every terrain.
                            </p>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('shop.index') }}"
                                    class="inline-flex items-center gap-2 bg-[#d32f2f] hover:bg-red-700 text-white font-black text-sm px-6 py-3 rounded shadow-lg shadow-red-900/40 hover:-translate-y-1 transition-all duration-500">
                                    SHOP NOW <i class="bi bi-arrow-right"></i>
                                </a>
                                <a href="{{ route('shop.index', ['category' => 'tires-wheels']) }}"
                                    class="inline-flex items-center gap-2 border border-gray-400 text-gray-800 hover:border-[#d32f2f] hover:text-[#d32f2f] font-bold text-sm px-6 py-3 rounded transition-all">
                                    Explore
                                </a>
                            </div>
                            <div class="flex items-center gap-6 mt-6 text-gray-600 text-xs font-medium">
                                <div class="flex items-center gap-1.5"><i
                                        class="bi bi-check-circle-fill text-[#d32f2f]"></i> Free Shipping</div>
                                <div class="flex items-center gap-1.5"><i
                                        class="bi bi-check-circle-fill text-[#d32f2f]"></i> Genuine Parts</div>
                                <div class="flex items-center gap-1.5"><i
                                        class="bi bi-check-circle-fill text-[#d32f2f]"></i> Lifetime Warranty</div>
                            </div>
                        </div>

                        {{-- Product image area --}}
                        <div class="relative hidden xl:flex items-center justify-center w-72 h-72">
                            <div
                                class="absolute inset-0 bg-[#d32f2f] opacity-10 rounded-full blur-2xl animate-pulse-glow">
                            </div>
                            <div
                                class="w-64 h-64 rounded-full border border-red-900/30 flex items-center justify-center backdrop-blur-sm bg-white/50">
                                <i class="bi bi-vinyl-fill text-gray-900 text-9xl opacity-90"
                                    style="text-shadow: 0 0 30px rgba(211,47,47,0.4)"></i>
                            </div>
                            {{-- Floating badge --}}
                            <div
                                class="absolute -top-4 -right-4 bg-[#d32f2f] text-white text-xs font-black px-3 py-1.5 rounded shadow-lg shadow-red-900/50 rotate-6">
                                -25% OFF
                            </div>
                        </div>
                    </div>

                    {{-- Price strip --}}
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gray-50 border-t border-red-900/30 px-10 py-3 flex items-center justify-between">
                        <span class="text-gray-600 text-xs font-semibold uppercase tracking-widest">Starting from</span>
                        <span class="text-[#d32f2f] font-black text-xl">$299.00</span>
                        <span class="text-gray-600 text-xs line-through">$399.00</span>
                    </div>
                </div>

                {{-- SLIDE 2: Engine Parts --}}
                <div class="hero-slide absolute inset-0 flex flex-col justify-center transition-opacity duration-1000 opacity-0 z-0 pointer-events-none"
                    style="background: linear-gradient(135deg, #f3f4f6 0%, #ffffff 60%, #f3f4f6 100%);">
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute -top-20 right-10 w-96 h-96 bg-gray-600 opacity-10 rounded-full blur-3xl">
                        </div>
                    </div>
                    <div class="relative z-10 flex items-center justify-between w-full px-10 py-8">
                        <div class="max-w-sm animate-fade-up">
                            <span
                                class="inline-flex items-center gap-1.5 bg-[#d32f2f] text-white text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded mb-4">
                                <i class="bi bi-fire"></i> Best Sellers
                            </span>
                            <h1 class="text-4xl xl:text-5xl font-black text-gray-900 leading-tight mb-3 uppercase">
                                Engine<br>
                                <span class="text-gray-600">Platinum Kit</span>
                            </h1>
                            <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                                Maximize your engine's potential with our certified high-performance platinum series.
                            </p>
                            <a href="{{ route('shop.index', ['category' => 'engine-parts']) }}"
                                class="inline-flex items-center gap-2 bg-[#d32f2f] hover:bg-red-700 text-white font-black text-sm px-6 py-3 rounded shadow-lg transition-all">
                                SHOP NOW <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        <div class="relative hidden xl:flex items-center justify-center w-72 h-72">
                            <i class="bi bi-gear-fill text-gray-600 text-9xl opacity-70"
                                style="text-shadow: 0 0 40px rgba(156,163,175,0.3)"></i>
                        </div>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gray-50 border-t border-gray-200 px-10 py-3 flex items-center justify-between">
                        <span class="text-gray-600 text-xs font-semibold uppercase tracking-widest">Starting from</span>
                        <span class="text-gray-900 font-black text-xl">$349.00</span>
                        <span class="text-gray-600 text-xs line-through">$420.00</span>
                    </div>
                </div>

                {{-- SLIDE 3: Headlights --}}
                <div class="hero-slide absolute inset-0 flex flex-col justify-center transition-opacity duration-1000 opacity-0 z-0 pointer-events-none"
                    style="background: linear-gradient(135deg, #111 0%, #000 60%, #111 100%);">
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute top-10 right-20 w-80 h-80 bg-[#d32f2f] opacity-5 rounded-full blur-3xl">
                        </div>
                    </div>
                    <div class="relative z-10 flex items-center justify-between w-full px-10 py-8">
                        <div class="max-w-sm animate-fade-up">
                            <span
                                class="inline-flex items-center gap-1.5 bg-[#d32f2f] text-white text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded mb-4">
                                <i class="bi bi-lightning-fill"></i> VIP Exclusive
                            </span>
                            <h1 class="text-4xl xl:text-5xl font-black text-gray-900 leading-tight mb-3 uppercase">
                                LED Headlights<br>
                                <span class="text-[#d32f2f]">Diamond Clear</span>
                            </h1>
                            <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                                Next-gen LED technology for superior visibility and stunning aesthetics.
                            </p>

                            {{-- COUNTDOWN TIMER --}}
                            <div class="flex items-center gap-3 mb-8">
                                <div class="flex flex-col items-center">
                                    <div class="w-12 h-12 bg-black/5 backdrop-blur-md border border-black/10 rounded flex items-center justify-center text-gray-900 font-black text-xl tracking-tighter"
                                        id="days">00</div>
                                    <span class="text-[8px] text-gray-500 font-bold uppercase mt-1">Days</span>
                                </div>
                                <div class="text-[#d32f2f] font-black text-xl mb-4">:</div>
                                <div class="flex flex-col items-center">
                                    <div class="w-12 h-12 bg-black/5 backdrop-blur-md border border-black/10 rounded flex items-center justify-center text-gray-900 font-black text-xl tracking-tighter"
                                        id="hours">00</div>
                                    <span class="text-[8px] text-gray-500 font-bold uppercase mt-1">Hours</span>
                                </div>
                                <div class="text-[#d32f2f] font-black text-xl mb-4">:</div>
                                <div class="flex flex-col items-center">
                                    <div class="w-12 h-12 bg-black/5 backdrop-blur-md border border-black/10 rounded flex items-center justify-center text-gray-900 font-black text-xl tracking-tighter"
                                        id="mins">00</div>
                                    <span class="text-[8px] text-gray-500 font-bold uppercase mt-1">Mins</span>
                                </div>
                                <div class="text-[#d32f2f] font-black text-xl mb-4">:</div>
                                <div class="flex flex-col items-center">
                                    <div class="w-12 h-12 bg-black/5 backdrop-blur-md border border-black/10 rounded flex items-center justify-center text-gray-900 font-black text-xl tracking-tighter animate-pulse"
                                        id="secs">00</div>
                                    <span class="text-[8px] text-gray-500 font-bold uppercase mt-1">Secs</span>
                                </div>
                            </div>

                            <a href="{{ route('shop.index') }}"
                                class="inline-flex items-center gap-2 bg-gradient-to-r from-gray-300 to-gray-400 hover:from-gray-400 hover:to-gray-500 text-black font-black text-sm px-6 py-3 rounded shadow-lg transition-all">
                                SHOP NOW <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        <div class="relative hidden xl:flex items-center justify-center w-72 h-72">
                            <i class="bi bi-lightbulb-fill text-gray-800 text-9xl opacity-80"
                                style="text-shadow: 0 0 50px rgba(156,163,175,0.5)"></i>
                        </div>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gray-50 border-t border-gray-200 px-10 py-3 flex items-center justify-between">
                        <span class="text-gray-600 text-xs font-semibold uppercase tracking-widest">Starting from</span>
                        <span class="text-gray-800 font-black text-xl">$189.00</span>
                        <span class="text-gray-600 text-xs line-through">$249.00</span>
                    </div>
                </div>

                {{-- Carousel dots --}}
                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center gap-2 z-20">
                    <button class="hero-dot w-6 h-2 bg-[#d32f2f] rounded-full transition-all duration-300"></button>
                    <button class="hero-dot w-2 h-2 bg-gray-500 rounded-full transition-all duration-300"></button>
                    <button class="hero-dot w-2 h-2 bg-gray-500 rounded-full transition-all duration-300"></button>
                </div>
            </div>

            {{-- RIGHT: Promo Cards --}}
            <div class="flex-shrink-0 flex flex-col gap-4 w-52 hidden xl:flex">
                {{-- Promo Card 1 --}}
                <div
                    class="group bg-white border border-gray-200 rounded p-5 flex flex-col items-center text-center gap-3 cursor-pointer hover:border-[#d32f2f]/50 hover:shadow-xl hover:shadow-[#d32f2f]/20 hover:-translate-y-2 transition-all duration-500 flex-1 overflow-hidden relative">
                    <div class="absolute inset-0 bg-[#d32f2f] opacity-0 group-hover:opacity-5 transition-opacity duration-500"></div>
                    <div class="bg-[#d32f2f] w-16 h-16 rounded flex items-center justify-center shadow-lg shadow-red-900/50">
                        <i class="bi bi-vinyl-fill text-gray-900 text-3xl"></i>
                    </div>
                    <div>
                        <p class="text-[#d32f2f] text-[9px] font-black uppercase tracking-[0.2em] mb-1">Platinum Tier
                        </p>
                        <h3 class="text-gray-900 font-black text-sm leading-tight uppercase tracking-tight">VIP Alloy Rims</h3>
                        <p class="text-gray-600 text-[10px] mt-1.5 leading-snug">Forged luxury editions. 20" to 24".</p>
                    </div>
                    <span class="text-gray-900 font-black text-lg">$899<span
                            class="text-gray-500 text-xs font-normal">.00</span></span>
                    <a href="{{ route('shop.index', ['category' => 'tires-wheels']) }}"
                        class="w-full text-center bg-white border border-[#d32f2f]/50 group-hover:bg-[#d32f2f] group-hover:text-white text-[#d32f2f] text-[10px] font-black py-2.5 rounded transition-colors uppercase tracking-widest">
                        Reserve Now
                    </a>
                </div>

                {{-- Promo Card 2 --}}
                <div
                    class="group bg-white border border-gray-200 rounded p-5 flex flex-col items-center text-center gap-3 cursor-pointer hover:border-gray-500/50 hover:shadow-xl hover:shadow-gray-500/10 hover:-translate-y-1 transition-all duration-300 flex-1 overflow-hidden relative">
                    <div class="absolute inset-0 bg-gray-400 opacity-0 group-hover:opacity-5 transition-opacity"></div>
                    <div class="bg-gray-400 w-16 h-16 rounded flex items-center justify-center shadow-lg">
                        <i class="bi bi-shield-fill-check text-[#050505] text-3xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-[9px] font-black uppercase tracking-[0.2em] mb-1">Executive</p>
                        <h3 class="text-gray-900 font-black text-sm leading-tight uppercase tracking-tight">Security System</h3>
                        <p class="text-gray-600 text-[10px] mt-1.5 leading-snug">360° Cameras & GPS Tracking.</p>
                    </div>
                    <span class="text-gray-800 font-black text-lg">$499<span
                            class="text-gray-500 text-xs font-normal">.00</span></span>
                    <a href="{{ route('shop.index') }}"
                        class="w-full text-center bg-white border border-gray-400/20 group-hover:bg-gray-300 group-hover:text-[#050505] text-gray-800 text-[10px] font-black py-2.5 rounded transition-colors uppercase tracking-widest">
                        Upgrade
                    </a>
                </div>
            </div>

        </div>{{-- /flex --}}
    </div>{{-- /container --}}
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');
    let current = 0;
    
    function showSlide(index) {
        slides.forEach((slide, i) => {
            if (i === index) {
                slide.classList.remove('opacity-0', 'z-0', 'pointer-events-none');
                slide.classList.add('opacity-100', 'z-10');
                if(dots[i]) {
                    dots[i].classList.add('w-6', 'bg-[#d32f2f]');
                    dots[i].classList.remove('w-2', 'bg-gray-500');
                }
            } else {
                slide.classList.add('opacity-0', 'z-0', 'pointer-events-none');
                slide.classList.remove('opacity-100', 'z-10');
                if(dots[i]) {
                    dots[i].classList.remove('w-6', 'bg-[#d32f2f]');
                    dots[i].classList.add('w-2', 'bg-gray-500');
                }
            }
        });
    }
    
    setInterval(() => {
        current = (current + 1) % slides.length;
        showSlide(current);
    }, 4500);
});
</script>