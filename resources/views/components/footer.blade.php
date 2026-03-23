<footer class="bg-gray-100 text-gray-600 py-16">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            {{-- Column 1: Brand --}}
            <div class="flex flex-col gap-6">
                {{-- Logo --}}
                <a href="/" class="flex items-center gap-2 w-fit">
                    <div class="w-9 h-9 bg-gradient-to-br from-red-500 to-red-700 rounded-lg flex items-center justify-center shadow-[0_0_15px_rgba(211,47,47,0.3)]">
                        <i class="bi bi-tools text-[#050505] text-lg"></i>
                    </div>
                    <span class="text-gray-900 font-black text-xl tracking-tight">
                        AutoParts<span class="text-[#d32f2f]">Hub</span>
                    </span>
                </a>

                <p class="text-sm leading-relaxed">
                    Your VIP destination for premium automotive parts and professional accessories. Serving Lahore's
                    car enthusiasts with high-performance components since 2010.
                </p>

                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-[#d32f2f]">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <span class="text-sm">Near University of Lahore</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-[#d32f2f]">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <a href="tel:03034012525"
                            class="hover:text-[#d32f2f] transition-colors font-semibold text-gray-900">03034012525</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-[#d32f2f]">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <a href="mailto:ahmedmazari111@gmail.com"
                            class="hover:text-[#d32f2f] transition-colors font-semibold text-gray-900">ahmedmazari111@gmail.com</a>
                    </div>
                </div>
            </div>

            {{-- Column 2: Quick Links --}}
            <div class="flex flex-col gap-3">
                <h4 class="text-gray-900 font-bold text-sm uppercase tracking-widest mb-1">Quick Links</h4>
                @php
                $quick_links = [
                    'About Us' => route('pages.about'),
                    'Delivery Information' => route('pages.delivery'),
                    'Privacy Policy' => route('pages.privacy'),
                    'Terms & Conditions' => route('pages.terms'),
                    'Contact Us' => route('pages.contact')
                ];
                @endphp
                @foreach($quick_links as $label => $href)
                <a href="{{ $href }}"
                    class="text-gray-600 hover:text-[#d32f2f] transition-colors text-sm flex items-center gap-1.5">
                    <i class="bi bi-chevron-right text-xs text-red-800"></i> {{ $label }}
                </a>
                @endforeach
            </div>

            {{-- Column 3: My Account (Admin Only) --}}
            @if(auth()->check() && auth()->user()->role == 'admin')
            <div class="flex flex-col gap-3">
                <h4 class="text-gray-900 font-bold text-sm uppercase tracking-widest mb-1">My Account</h4>
                @php
                $acc_links = ['Account Dashboard' => '/dashboard', 'Order History' => '#', 'Wish List' =>
                '#', 'Newsletter' => '#', 'Returns' => '#'];
                @endphp
                @foreach($acc_links as $label => $href)
                <a href="{{ $href }}"
                    class="text-gray-600 hover:text-[#d32f2f] transition-colors text-sm flex items-center gap-1.5">
                    <i class="bi bi-chevron-right text-xs text-red-800"></i> {{ $label }}
                </a>
                @endforeach
            </div>
            @endif

            {{-- Column 4: Newsletter --}}
            <div class="flex flex-col gap-3">
                <h4 class="text-gray-900 font-bold text-sm uppercase tracking-widest mb-1">Newsletter</h4>
                <p class="text-sm leading-relaxed">
                    Subscribe to get updates on latest releases and exclusive offers.
                </p>
                <form class="flex mt-1">
                    <input type="email" placeholder="Your email address"
                        class="flex-1 px-4 py-2.5 bg-white border border-gray-200 text-gray-900 placeholder-gray-500 text-sm rounded-l-xl focus:outline-none focus:border-red-700 transition-colors">
                    <button type="submit"
                        class="bg-gradient-to-r from-red-700 to-[#d32f2f] hover:from-[#d32f2f] hover:to-red-500 text-black px-4 py-2.5 rounded-r-xl text-sm font-bold transition-colors flex-shrink-0">
                        Join
                    </button>
                </form>
                <div class="flex items-center gap-4 mt-4">
                    @php
                    $personal_socials = [
                        ['icon' => 'facebook', 'url' => 'https://web.facebook.com/ahmed.raza.727771', 'label' => 'Facebook'],
                        ['icon' => 'linkedin', 'url' => 'https://www.linkedin.com/in/ahmed-raza-020b3b2b0', 'label' => 'LinkedIn'],
                        ['icon' => 'github', 'url' => 'https://github.com/razaahmed1', 'label' => 'GitHub'],
                        ['icon' => 'globe', 'url' => 'https://razaahmed1.github.io', 'label' => 'Portfolio'],
                    ];
                    @endphp
                    @foreach($personal_socials as $social)
                    <a href="{{ $social['url'] }}" target="_blank" title="{{ $social['label'] }}"
                        class="w-10 h-10 bg-white border border-gray-200 rounded-xl flex items-center justify-center hover:border-[#d32f2f] hover:text-[#d32f2f] hover:shadow-lg hover:-translate-y-1 transition-all text-gray-600">
                        <i class="bi bi-{{ $social['icon'] }} text-lg"></i>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-gray-100 mt-16 pt-8 flex flex-col md:flex-row items-center justify-between gap-6">
            {{-- Copyright --}}
            <p class="text-gray-500 text-xs">
                &copy; {{ date('Y') }} <span class="text-gray-900 font-bold">AutoParts Hub</span>. All Rights Reserved.
            </p>

            {{-- Payment Icons --}}
            <div class="flex items-center gap-3 opacity-50 grayscale hover:grayscale-0 transition-all">
                <i class="bi bi-credit-card-2-back text-2xl"></i>
                <i class="bi bi-paypal text-2xl"></i>
                <i class="bi bi-wallet2 text-2xl"></i>
            </div>
        </div>
    </div>
</footer>