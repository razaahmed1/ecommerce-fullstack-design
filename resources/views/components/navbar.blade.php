{{-- ANNOUNCEMENT BAR --}}
<div class="bg-gradient-to-r from-red-800 via-[#d32f2f] to-red-700 text-[#050505] text-[10px] font-black uppercase tracking-[0.2em] py-2">
    <div class="max-w-screen-xl mx-auto px-4 flex items-center justify-center gap-6 overflow-hidden">
        <div class="flex items-center gap-2 animate-pulse">
            <i class="bi bi-megaphone-fill"></i>
            <span>Flash Sale: 20% Off on All Engine Parts! Use Code: DRIVE20</span>
        </div>
        <span class="hidden md:inline opacity-30">|</span>
        <div class="hidden md:flex items-center gap-2">
            <i class="bi bi-truck"></i>
            <span>Free Standard Shipping on Orders Over $99</span>
        </div>
    </div>
</div>

<header id="main-navbar" class="sticky top-0 z-50 transition-shadow duration-300">

    {{-- TOP UTILITY BAR --}}
    <div class="bg-gray-100 text-gray-600 text-xs">
        <div class="max-w-screen-xl mx-auto px-4 flex items-center justify-between h-9">
            <div class="flex items-center gap-6">
                <a href="#" class="flex items-center gap-1.5 hover:text-[#d32f2f] transition-colors">
                    <i class="bi bi-truck text-[#d32f2f]"></i>
                    <span>Track Order</span>
                </a>
                <a href="#" class="flex items-center gap-1.5 hover:text-[#d32f2f] transition-colors">
                    <i class="bi bi-geo-alt-fill text-[#d32f2f]"></i>
                    <span>UOL Branch, Lahore</span>
                </a>
            </div>
            <div class="flex items-center gap-6">
                <a href="mailto:ahmedmazari111@gmail.com" class="flex items-center gap-1.5 hover:text-[#d32f2f] transition-colors">
                    <i class="bi bi-envelope-fill text-[#d32f2f]"></i>
                    <span>ahmedmazari111@gmail.com</span>
                </a>
                <a href="tel:03034012525" class="flex items-center gap-1.5 hover:text-gray-900 transition-colors">
                    <i class="bi bi-telephone-fill text-[#d32f2f]"></i>
                    <span class="font-semibold text-gray-900">03034012525</span>
                </a>
                @auth
                    @if(auth()->user()->role == 'admin')
                        <a href="{{ url('/dashboard') }}" class="hover:text-gray-900 transition-colors font-bold uppercase tracking-widest text-[10px]">Admin Access</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    {{-- MAIN NAVBAR --}}
    <div class="bg-gray-50 border-b border-gray-200 backdrop-blur-md bg-opacity-95 relative z-40">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">

                {{-- LOGO --}}
                <a href="/" class="flex items-center gap-2 flex-shrink-0">
                    <div class="w-9 h-9 bg-gradient-to-br from-red-500 to-red-700 rounded-lg flex items-center justify-center shadow-[0_0_15px_rgba(211,47,47,0.3)]">
                        <i class="bi bi-tools text-[#050505] text-lg"></i>
                    </div>
                    <span class="text-gray-900 font-black text-xl tracking-tight">
                        AutoParts<span class="text-[#d32f2f]">Hub</span>
                    </span>
                </a>

                {{-- REMOVED DESKTOP NAV FOR NEW CATEGORY STRIP DOWN BELOW --}}
                <div class="hidden lg:block w-32"></div>

                {{-- RIGHT ICONS --}}
                <div class="flex items-center gap-3">
                    {{-- Search icon (mobile) --}}
                    <button class="lg:hidden text-gray-800 hover:text-gray-900 p-2">
                        <i class="bi bi-search text-lg"></i>
                    </button>

                    {{-- Account Dropdown Toggle (Admin Only) --}}
                    @if(auth()->check() && auth()->user()->role == 'admin')
                    <div class="relative group hidden lg:block">
                        <a href="{{ route('dashboard') }}" class="flex flex-col items-center gap-0.5 text-gray-800 hover:text-gray-900 transition-colors p-2 relative z-50">
                            <i class="bi bi-person-circle text-xl"></i>
                            <span class="text-[10px] font-medium">Admin</span>
                        </a>
                        {{-- Dropdown Container with Padding Bridge --}}
                        <div class="absolute top-full right-0 pt-2 w-52 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[999]">
                            <div class="bg-white border border-gray-200 rounded shadow-[0_20px_50px_rgba(0,0,0,0.5)] p-2 relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-br from-red-700/5 to-transparent pointer-events-none"></div>
                                <div class="relative z-10 flex flex-col gap-1">
                                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-600 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-[#d32f2f] hover:text-white transition-colors">
                                        <i class="bi bi-person-badge text-sm"></i> Dashboard
                                    </a>
                                    <hr class="border-gray-200 my-1">
                                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-gray-600 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-red-900/40 hover:text-red-500 hover:border hover:border-red-500/30 transition-all text-left border border-transparent">
                                            <i class="bi bi-power text-sm"></i> Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Wishlist --}}
                    <a href="{{ route('wishlist.index') }}"
                        class="relative flex flex-col items-center gap-0.5 text-gray-800 hover:text-gray-900 transition-colors p-2 hidden lg:flex">
                        <i class="bi bi-heart text-xl"></i>
                        <span class="text-[10px] font-medium">Wishlist</span>
                        <span
                            class="absolute top-1 right-1 w-4 h-4 bg-[#d32f2f] text-[#050505] text-[9px] font-bold rounded-full flex items-center justify-center">{{ count((array) session('wishlist')) }}</span>
                    </a>

                    {{-- Cart --}}
                    <a href="/cart"
                        class="relative flex flex-col items-center gap-0.5 text-gray-800 hover:text-gray-900 transition-colors p-2">
                        <i class="bi bi-cart3 text-xl"></i>
                        <span class="text-[10px] font-medium hidden lg:block">Cart</span>
                        <span
                            class="absolute top-1 right-1 w-4 h-4 bg-[#d32f2f] text-[#050505] text-[9px] font-bold rounded-full flex items-center justify-center">{{ count((array) session('cart')) }}</span>
                    </a>

                    {{-- Hamburger --}}
                    <button id="mobile-menu-btn" class="lg:hidden text-gray-800 hover:text-gray-900 p-2">
                        <i class="bi bi-list text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- MOBILE MENU --}}
        <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200 px-4 py-6 shadow-sm">
            <nav class="flex flex-col gap-2 mb-6">
                <a href="/" class="px-4 py-3 text-gray-800 hover:text-[#d32f2f] hover:bg-gray-100 rounded-xl text-sm font-black uppercase tracking-widest transition-colors flex items-center justify-between">
                    Home <i class="bi bi-chevron-right text-[10px]"></i>
                </a>
                <a href="{{ route('shop.index') }}" class="px-4 py-3 text-gray-800 hover:text-[#d32f2f] hover:bg-gray-100 rounded-xl text-sm font-black uppercase tracking-widest transition-colors flex items-center justify-between">
                    Shop Catalog <i class="bi bi-chevron-right text-[10px]"></i>
                </a>
                <a href="{{ route('shop.index', ['brand' => 'brembo']) }}" class="px-4 py-3 text-gray-800 hover:text-[#d32f2f] hover:bg-gray-100 rounded-xl text-sm font-black uppercase tracking-widest transition-colors flex items-center justify-between">
                    VIP Brands <i class="bi bi-chevron-right text-[10px]"></i>
                </a>
            </nav>
            
            @auth
                @if(auth()->user()->role == 'admin')
                <div class="border-t border-gray-200 pt-6 flex flex-col gap-3">
                    <a href="{{ route('dashboard') }}" class="px-4 py-3 bg-white border border-gray-200 text-[#d32f2f] hover:bg-[#d32f2f] hover:text-[#050505] transition-colors rounded-xl text-xs font-black uppercase tracking-widest text-center shadow-md">
                        <i class="bi bi-shield-lock-fill"></i> Access Portal
                    </a>
                </div>
                @endif
            @endauth
        </div>
    </div>

    {{-- SEARCH BAR SECTION AND NEW RED CATEGORY STRIP --}}
    <div class="bg-white border-b border-gray-200 shadow-sm py-3 hidden lg:block relative z-30">
        <div class="max-w-screen-xl mx-auto px-4">
            <form action="{{ route('shop.index') }}" method="GET" class="flex items-center gap-4 w-full max-w-3xl mx-auto">
                {{-- Category Dropdown --}}
                <div class="flex-shrink-0">
                    <select name="category"
                        class="h-12 px-5 bg-gray-50 border border-gray-200 rounded-xl text-[10px] text-gray-800 font-black uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-[#d32f2f] focus:border-[#d32f2f] cursor-pointer shadow-sm">
                        <option value="">ALL CATEGORIES</option>
                        @foreach(\App\Models\Category::where('status', 1)->get() as $navCat)
                            <option value="{{ $navCat->slug }}" {{ request('category') == $navCat->slug ? 'selected' : '' }}>{{ strtoupper($navCat->name) }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Search Input --}}
                <div class="flex-1 relative">
                    <div class="relative flex items-center">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for parts, brands, or model numbers..."
                            class="w-full h-12 pl-5 pr-14 bg-white border border-gray-300 rounded-xl text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#d32f2f] focus:border-[#d32f2f] transition-all">
                        <button type="submit"
                            class="absolute right-2 w-9 h-9 bg-gradient-to-br from-[#d32f2f] to-red-700 hover:from-red-500 hover:to-[#d32f2f] text-[#050505] rounded-lg flex items-center justify-center transition-all shadow-[0_0_10px_rgba(211,47,47,0.3)]">
                            <i class="bi bi-search font-bold"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- VIP DARK MEGA CATEGORY STRIP (Dual-Line, PackWheels Style) --}}
    <div class="bg-gray-50 border-y border-gray-200 hidden lg:block shadow-md relative z-20">
        <div class="max-w-screen-xl mx-auto px-4 flex">
            <nav class="flex items-stretch text-[11px] font-bold tracking-wider w-full h-16">
                {{-- Static Home Block --}}
                <a href="/" class="flex items-center px-6 border-r border-gray-200 {{ request()->is('/') ? 'text-[#d32f2f] bg-white font-black shadow-inner' : 'text-gray-500 hover:text-gray-900 hover:bg-white transition-all' }}">
                    HOME
                </a>
                
                {{-- Direct Links --}}
                <a href="{{ route('shop.index') }}" class="flex items-center px-4 border-r border-gray-200 text-gray-600 hover:text-[#d32f2f] hover:bg-white transition-all leading-tight">
                    JAZZ X<br>AUTOSTORE
                </a>
                <a href="{{ route('shop.index', ['brand' => 'generic']) }}" class="flex items-center px-4 border-r border-gray-200 text-gray-600 hover:text-[#d32f2f] hover:bg-white transition-all leading-tight">
                    BRANDS
                </a>

                {{-- MEGA DROPDOWN --}}
                <div class="relative group flex border-r border-gray-200">
                    <a href="{{ route('shop.index', ['category' => 'car-accessories']) }}" class="flex items-center px-4 text-gray-900 hover:text-[#d32f2f] bg-white transition-all cursor-pointer leading-tight uppercase">
                        CAR<br>ACCESSORIES <i class="bi bi-chevron-down text-[8px] ml-1 mt-0.5 text-gray-400"></i>
                    </a>
                    <div class="absolute top-full left-0 w-[500px] bg-gray-100 shadow-[0_30px_60px_rgba(0,0,0,0.9)] invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300 z-[450] rounded-b-xl border border-gray-200 flex overflow-hidden">
                        {{-- Links Column --}}
                        <div class="flex flex-col w-1/2">
                            <a href="{{ route('shop.index', ['search' => 'Mats']) }}" class="px-5 py-4 text-gray-800 text-sm hover:text-gray-900 hover:bg-gray-100 border-b border-gray-200 flex items-center justify-between transition-colors">
                                Mats <i class="bi bi-chevron-right text-[10px] opacity-40"></i>
                            </a>
                            <a href="{{ route('shop.index', ['search' => 'Covers']) }}" class="px-5 py-4 text-gray-800 text-sm hover:text-gray-900 hover:bg-gray-100 border-b border-gray-200 flex items-center justify-between transition-colors">
                                Car Covers <i class="bi bi-chevron-right text-[10px] opacity-40"></i>
                            </a>
                            <a href="{{ route('shop.index', ['search' => 'Interior']) }}" class="px-5 py-4 text-gray-800 text-sm hover:text-gray-900 hover:bg-gray-100 border-b border-gray-200 flex items-center justify-between transition-colors">
                                Interior Accessories <i class="bi bi-chevron-right text-[10px] opacity-40"></i>
                            </a>
                            <a href="{{ route('shop.index', ['search' => 'Exterior']) }}" class="px-5 py-4 text-gray-800 text-sm hover:text-gray-900 hover:bg-gray-100 flex items-center justify-between transition-colors">
                                Exterior Accessories <i class="bi bi-chevron-right text-[10px] opacity-40"></i>
                            </a>
                        </div>
                        {{-- Promo Image Column --}}
                        <div class="w-1/2 bg-white relative p-5 flex flex-col justify-end overflow-hidden group/promo">
                            <img src="https://images.unsplash.com/photo-1542282088-72c9c27ed0cd?auto=format&fit=crop&w=400&q=80" alt="Premium Mats Promo" class="absolute inset-0 w-full h-full object-cover opacity-40 group-hover/promo:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
                            <div class="relative z-10 bottom-0">
                                <span class="bg-[#d32f2f] text-white text-[9px] font-black uppercase px-2 py-1 rounded">Featured Gear</span>
                                <h4 class="text-gray-900 font-bold text-base mt-2 leading-tight">Premium 7D Custom Fit Mats</h4>
                                <a href="{{ route('shop.index', ['search' => 'Mats']) }}" class="text-[#d32f2f] hover:text-gray-900 text-[10px] font-black uppercase mt-3 inline-block transition-colors tracking-widest">Shop Now <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('shop.index', ['category' => 'car-care']) }}" class="flex items-center px-4 border-r border-gray-200 text-gray-600 hover:text-[#d32f2f] hover:bg-white transition-all leading-tight">
                    CAR<br>CARE
                </a>
                <a href="{{ route('shop.index', ['category' => 'oil-additives']) }}" class="flex items-center px-4 border-r border-gray-200 text-gray-600 hover:text-[#d32f2f] hover:bg-white transition-all leading-tight">
                    OIL &<br>ADDITIVES
                </a>
                <a href="{{ route('shop.index', ['category' => 'car-filter']) }}" class="flex items-center px-4 border-r border-gray-200 text-gray-600 hover:text-[#d32f2f] hover:bg-white transition-all leading-tight">
                    CAR<br>FILTER
                </a>
                <a href="{{ route('shop.index', ['category' => 'car-electronics']) }}" class="flex items-center px-4 border-r border-gray-200 text-gray-600 hover:text-[#d32f2f] hover:bg-white transition-all leading-tight">
                    CAR<br>ELECTRONICS
                </a>
                <a href="{{ route('shop.index', ['category' => 'led-lights']) }}" class="flex items-center px-4 border-r border-gray-200 text-gray-600 hover:text-[#d32f2f] hover:bg-white transition-all leading-tight">
                    LED<br>LIGHTS
                </a>
                <a href="{{ route('shop.index', ['category' => 'car-parts']) }}" class="flex items-center px-4 border-r border-gray-200 text-gray-600 hover:text-[#d32f2f] hover:bg-white transition-all leading-tight flex-1">
                    CAR<br>PARTS
                </a>
            </nav>
        </div>
    </div>

</header>