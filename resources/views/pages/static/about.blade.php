@extends('layouts.store')
@section('title', 'About Us - VIP AutoParts Hub')

@section('content')
<div class="bg-white min-h-screen py-20 relative overflow-hidden">
    {{-- Background Accents --}}
    <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-red-50 to-transparent blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-1/4 h-1/2 bg-gradient-to-t from-gray-100 to-transparent blur-3xl pointer-events-none"></div>

    <div class="max-w-screen-xl mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            {{-- Text Content --}}
            <div data-aos="fade-right">
                <span class="text-[#d32f2f] text-xs font-black uppercase tracking-[0.3em] mb-4 block">Our Story</span>
                <h1 class="text-5xl lg:text-7xl font-black text-gray-900 uppercase tracking-tighter leading-none mb-8">
                    Elevating the <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-800">Driving</span> experience
                </h1>
                <div class="space-y-6 text-gray-600 text-lg leading-relaxed">
                    <p>
                        Founded in 2010, <span class="font-bold text-gray-900">AutoParts Hub</span> began with a simple mission: to provide car enthusiasts and professionals with the highest quality automotive components available on the market.
                    </p>
                    <p>
                        Our journey started in a small workshop near Lahore, fueled by a passion for performance and an uncompromising commitment to quality. Today, we stand as a premier destination for genuine parts and high-performance upgrades.
                    </p>
                    <div class="grid grid-cols-2 gap-8 pt-6">
                        <div>
                            <h3 class="text-4xl font-black text-gray-900 mb-1">15k+</h3>
                            <p class="text-xs font-bold uppercase tracking-widest text-[#d32f2f]">Clients Served</p>
                        </div>
                        <div>
                            <h3 class="text-4xl font-black text-gray-900 mb-1">5k+</h3>
                            <p class="text-xs font-bold uppercase tracking-widest text-[#d32f2f]">Premium Parts</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Image Side --}}
            <div class="relative" data-aos="fade-left">
                <div class="aspect-square bg-gray-100 rounded-[40px] overflow-hidden shadow-[0_30px_60px_rgba(0,0,0,0.1)] border border-gray-200 group">
                    <img src="https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?auto=format&fit=crop&w=800&q=80" alt="Auto Workshop" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-600/20 to-transparent"></div>
                </div>
                {{-- Floating Badge --}}
                <div class="absolute -bottom-8 -left-8 bg-white p-8 rounded-3xl shadow-2xl border border-gray-100 flex items-center gap-4 animate-bounce">
                    <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center text-white text-2xl">
                        <i class="bi bi-patch-check-fill"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-500">Certified Quality</p>
                        <p class="text-sm font-black text-gray-900 italic">Trusted by Professionals</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
