@extends('layouts.store')
@section('title', 'Delivery Information - VIP AutoParts Hub')

@section('content')
<div class="bg-gray-50 min-h-screen py-20">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="text-[#d32f2f] text-xs font-black uppercase tracking-[0.3em] mb-4 block">Fulfillment</span>
            <h1 class="text-5xl lg:text-7xl font-black text-gray-900 uppercase tracking-tighter leading-none">
                VIP <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-800">Shipping</span> Logistics
            </h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Card 1 --}}
            <div class="bg-white p-10 rounded-[40px] shadow-sm border border-gray-200 hover:shadow-xl hover:border-[#d32f2f]/20 transition-all group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center text-3xl text-[#d32f2f] mb-8 group-hover:scale-110 transition-transform">
                    <i class="bi bi-truck"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 uppercase mb-4 tracking-tight">Express Delivery</h3>
                <p class="text-gray-600 leading-relaxed text-sm">
                    Our express service ensures your parts arrive within 24-48 hours. Perfect for urgent repairs and time-sensitive upgrades.
                </p>
            </div>

            {{-- Card 2 --}}
            <div class="bg-white p-10 rounded-[40px] shadow-sm border border-gray-200 hover:shadow-xl hover:border-[#d32f2f]/20 transition-all group" data-aos="fade-up" data-aos-delay="200">
                <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center text-3xl text-[#d32f2f] mb-8 group-hover:scale-110 transition-transform">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 uppercase mb-4 tracking-tight">Insured Shipping</h3>
                <p class="text-gray-600 leading-relaxed text-sm">
                    Every order is fully insured against damage or loss. Sleep easy knowing your investment is protected from our door to yours.
                </p>
            </div>

            {{-- Card 3 --}}
            <div class="bg-white p-10 rounded-[40px] shadow-sm border border-gray-200 hover:shadow-xl hover:border-[#d32f2f]/20 transition-all group" data-aos="fade-up" data-aos-delay="300">
                <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center text-3xl text-[#d32f2f] mb-8 group-hover:scale-110 transition-transform">
                    <i class="bi bi-geo-alt"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 uppercase mb-4 tracking-tight">Real-time Tracking</h3>
                <p class="text-gray-600 leading-relaxed text-sm">
                    Stay informed with our advanced GPS tracking system. Monitor your order's journey in real-time until it reaches your doorstep.
                </p>
            </div>
        </div>

        <div class="mt-20 bg-gray-900 rounded-[50px] p-12 lg:p-20 relative overflow-hidden" data-aos="zoom-in">
            <div class="absolute inset-0 opacity-20">
                <img src="https://images.unsplash.com/photo-1519003722824-194d4455a60c?auto=format&fit=crop&w=1200" alt="Truck" class="w-full h-full object-cover">
            </div>
            <div class="relative z-10 max-w-2xl">
                <h2 class="text-3xl lg:text-5xl font-black text-white uppercase tracking-tighter mb-6">Free Shipping on Orders over $99</h2>
                <p class="text-gray-400 text-lg mb-8">We offer free standard shipping to all major regions in Pakistan for orders meeting our minimum requirement.</p>
                <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-3 bg-[#d32f2f] text-black font-black uppercase tracking-widest px-8 py-4 rounded-full hover:bg-white transition-all">
                    Shop Now <i class="bi bi-arrow-right text-lg"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@section('content')
