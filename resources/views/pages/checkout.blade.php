@extends('layouts.store')
@section('title', 'Secure Checkout - VIP AutoParts Hub')

@section('content')
<div class="bg-gray-50 min-h-screen py-16 relative overflow-hidden">
    {{-- Decorative Background --}}
    <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-red-950/10 to-transparent blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-1/3 h-1/2 bg-gradient-to-t from-stone-800/10 to-transparent blur-3xl pointer-events-none"></div>

    <div class="max-w-screen-xl mx-auto px-4 relative z-10">
        <div class="flex items-center gap-3 mb-8">
            <a href="{{ route('cart.index') }}" class="w-10 h-10 bg-white border border-gray-200 hover:border-[#d32f2f] text-gray-600 hover:text-[#d32f2f] rounded-full flex items-center justify-center transition-all shadow-lg active:scale-95">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tight">VIP <span class="bg-clip-text text-transparent bg-gradient-to-r from-red-500 to-red-700">Checkout</span></h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            {{-- Form Section --}}
            <div class="lg:col-span-2">
                <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data" class="bg-gray-100 border border-gray-200 rounded-[30px] p-8 lg:p-10 shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
                    @csrf
                    
                    <h2 class="text-2xl font-black text-gray-900 mb-6 tracking-wide border-b border-gray-200 pb-4 flex items-center gap-3">
                        <i class="bi bi-truck text-[#d32f2f]"></i> Shipping Details
                    </h2>

                    @if ($errors->any())
                        <div class="bg-red-900/20 border border-red-500/30 text-red-400 px-6 py-4 rounded mb-8">
                            <ul class="list-disc pl-5 space-y-1 font-bold text-sm tracking-wide">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        {{-- Name --}}
                        <div class="col-span-1 md:col-span-2">
                            <label for="customer_name" class="block text-gray-600 font-bold uppercase tracking-wider text-xs mb-2 ml-1">Full Name</label>
                            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required
                                class="w-full bg-white text-gray-900 border border-gray-300 focus:border-[#d32f2f] focus:ring-1 focus:ring-[#d32f2f] rounded-xl px-4 py-3.5 transition-colors shadow-sm outline-none">
                        </div>
                        
                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-gray-600 font-bold uppercase tracking-wider text-xs mb-2 ml-1">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full bg-white text-gray-900 border border-gray-300 focus:border-[#d32f2f] focus:ring-1 focus:ring-[#d32f2f] rounded-xl px-4 py-3.5 transition-colors shadow-sm outline-none">
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label for="phone" class="block text-gray-600 font-bold uppercase tracking-wider text-xs mb-2 ml-1">Phone Number</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                                class="w-full bg-white text-gray-900 border border-gray-300 focus:border-[#d32f2f] focus:ring-1 focus:ring-[#d32f2f] rounded-xl px-4 py-3.5 transition-colors shadow-sm outline-none">
                        </div>

                        {{-- Address --}}
                        <div class="col-span-1 md:col-span-2">
                            <label for="address" class="block text-gray-600 font-bold uppercase tracking-wider text-xs mb-2 ml-1">Shipping Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}" required
                                class="w-full bg-white text-gray-900 border border-gray-300 focus:border-[#d32f2f] focus:ring-1 focus:ring-[#d32f2f] rounded-xl px-4 py-3.5 transition-colors shadow-sm outline-none" placeholder="123 Performance Blvd">
                        </div>

                        {{-- City --}}
                        <div>
                            <label for="city" class="block text-gray-600 font-bold uppercase tracking-wider text-xs mb-2 ml-1">City</label>
                            <input type="text" name="city" id="city" value="{{ old('city') }}" required
                                class="w-full bg-white text-gray-900 border border-gray-300 focus:border-[#d32f2f] focus:ring-1 focus:ring-[#d32f2f] rounded-xl px-4 py-3.5 transition-colors shadow-sm outline-none">
                        </div>

                        {{-- Zip Code --}}
                        <div>
                            <label for="zip_code" class="block text-gray-600 font-bold uppercase tracking-wider text-xs mb-2 ml-1">Zip Code</label>
                            <input type="text" name="zip_code" id="zip_code" value="{{ old('zip_code') }}" required
                                class="w-full bg-white text-gray-900 border border-gray-300 focus:border-[#d32f2f] focus:ring-1 focus:ring-[#d32f2f] rounded-xl px-4 py-3.5 transition-colors shadow-sm outline-none">
                        </div>
                    </div>

                    <h2 class="text-2xl font-black text-gray-900 mb-6 tracking-wide border-b border-gray-200 pb-4 flex items-center gap-3">
                        <i class="bi bi-credit-card-2-front text-red-600"></i> Select Payment Method
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                        {{-- Cash on Delivery --}}
                        <div class="payment-option-wrapper group/cod relative">
                            <input type="radio" name="payment_method" id="pay_cod" value="cod" class="hidden peer" checked onclick="updatePaymentUI('cod')">
                            <label for="pay_cod" class="block bg-white border border-gray-200 rounded-3xl p-6 cursor-pointer transition-all duration-300 shadow-sm hover:shadow-xl hover:border-[#d32f2f] peer-checked:border-[#d32f2f] peer-checked:ring-4 peer-checked:ring-[#d32f2f]/5 relative overflow-hidden active:scale-[0.98]">
                                {{-- Checkmark Indicator --}}
                                <div class="absolute top-4 right-4 w-6 h-6 rounded-full bg-[#d32f2f] flex items-center justify-center opacity-0 transform scale-50 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-300 z-20">
                                    <i class="bi bi-check-lg text-white text-xs"></i>
                                </div>
                                
                                <div class="flex flex-col items-center text-center gap-4 relative z-10">
                                    <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center group-hover/cod:bg-red-50 transition-colors peer-checked:bg-red-600 peer-checked:text-white group-hover/cod:text-[#d32f2f] text-gray-400">
                                        <i class="bi bi-truck text-3xl"></i>
                                    </div>
                                    <div class="flex-grow">
                                        <span class="text-gray-900 font-black uppercase tracking-tight block text-base mb-1">Cash On Delivery</span>
                                        <span class="text-gray-400 text-[9px] font-bold uppercase tracking-[0.2em]">Pay at your doorstep</span>
                                    </div>
                                </div>

                                {{-- Background Glow --}}
                                <div class="absolute inset-0 bg-gradient-to-br from-red-50 to-transparent opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                            </label>
                        </div>

                        {{-- Online Payment --}}
                        <div class="payment-option-wrapper group/online relative">
                            <input type="radio" name="payment_method" id="pay_online" value="online" class="hidden peer" onclick="updatePaymentUI('online')">
                            <label for="pay_online" class="block bg-white border border-gray-200 rounded-3xl p-6 cursor-pointer transition-all duration-300 shadow-sm hover:shadow-xl hover:border-blue-600 peer-checked:border-blue-600 peer-checked:ring-4 peer-checked:ring-blue-600/5 relative overflow-hidden active:scale-[0.98]">
                                {{-- Checkmark Indicator --}}
                                <div class="absolute top-4 right-4 w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center opacity-0 transform scale-50 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-300 z-20">
                                    <i class="bi bi-check-lg text-white text-xs"></i>
                                </div>

                                <div class="flex flex-col items-center text-center gap-4 relative z-10">
                                    <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center group-hover/online:bg-blue-50 transition-colors peer-checked:bg-blue-600 peer-checked:text-white group-hover/online:text-blue-600 text-gray-400">
                                        <i class="bi bi-credit-card-2-front text-3xl"></i>
                                    </div>
                                    <div class="flex-grow">
                                        <span class="text-gray-900 font-black uppercase tracking-tight block text-base mb-1">Online Payment</span>
                                        <span class="text-gray-400 text-[9px] font-bold uppercase tracking-[0.2em]">Secure Fast Processing</span>
                                    </div>
                                </div>

                                {{-- Background Glow --}}
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-transparent opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                            </label>
                        </div>
                    </div>

                    {{-- Sub-Options (Online Only) --}}
                    <div id="online-sub-options" class="hidden space-y-4 mb-8 border-t border-gray-200 pt-8 animate-fade-in">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="h-px bg-gray-200 flex-grow"></div>
                            <h3 class="text-[10px] uppercase font-black tracking-[0.3em] text-gray-400">Method Select</h3>
                            <div class="h-px bg-gray-200 flex-grow"></div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="block cursor-pointer group/sub">
                                <input type="radio" name="online_payment_method" value="card" class="hidden peer" checked onclick="toggleOnlineMethod('card')">
                                <div class="bg-white border border-gray-300 rounded-2xl p-4 text-center peer-checked:border-[#d32f2f] peer-checked:bg-red-50/50 peer-checked:ring-2 peer-checked:ring-[#d32f2f]/10 shadow-sm transition-all select-none group-hover/sub:border-[#d32f2f] active:scale-95">
                                    <i class="bi bi-credit-card text-2xl text-gray-400 peer-checked:text-[#d32f2f] transition-colors block mb-1"></i>
                                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-600 peer-checked:text-[#d32f2f]">Debit/Credit</span>
                                </div>
                            </label>
                            <label class="block cursor-pointer group/sub">
                                <input type="radio" name="online_payment_method" value="easypaisa" class="hidden peer" onclick="toggleOnlineMethod('easypaisa')">
                                <div class="bg-white border border-gray-300 rounded-2xl p-4 text-center peer-checked:border-green-600 peer-checked:bg-green-50/50 peer-checked:ring-2 peer-checked:ring-green-600/10 shadow-sm transition-all select-none group-hover/sub:border-green-600 active:scale-95">
                                    <i class="bi bi-wallet2 text-2xl text-gray-400 peer-checked:text-green-600 transition-colors block mb-1"></i>
                                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-600 peer-checked:text-green-600">EasyPaisa</span>
                                </div>
                            </label>
                            <label class="block cursor-pointer group/sub">
                                <input type="radio" name="online_payment_method" value="jazzcash" class="hidden peer" onclick="toggleOnlineMethod('jazzcash')">
                                <div class="bg-white border border-gray-300 rounded-2xl p-4 text-center peer-checked:border-orange-600 peer-checked:bg-orange-50/50 peer-checked:ring-2 peer-checked:ring-orange-600/10 shadow-sm transition-all select-none group-hover/sub:border-orange-600 active:scale-95">
                                    <i class="bi bi-phone text-2xl text-gray-400 peer-checked:text-orange-600 transition-colors block mb-1"></i>
                                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-600 peer-checked:text-orange-600">JazzCash</span>
                                </div>
                            </label>
                        </div>
                    </div>


                    {{-- Card Details Flow --}}
                    <div id="card-details-fields" class="hidden space-y-6 pt-6 border-t border-gray-200 mt-6 animate-fade-in">
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                            <div class="mb-6">
                                <label class="block text-gray-500 font-black uppercase tracking-[0.2em] text-[9px] mb-3 ml-1">Cardholder Name</label>
                                <div class="relative group/input">
                                    <i class="bi bi-person absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within/input:text-[#d32f2f] transition-colors"></i>
                                    <input type="text" placeholder="Full Name as on Card"
                                        class="w-full bg-white text-gray-900 border border-gray-200 focus:border-[#d32f2f] focus:ring-4 focus:ring-[#d32f2f]/5 rounded-xl pl-12 pr-4 py-4 transition-all outline-none font-bold placeholder:text-gray-300">
                                </div>
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-500 font-black uppercase tracking-[0.2em] text-[9px] mb-3 ml-1">Card Number</label>
                                <div class="relative group/input">
                                    <i class="bi bi-credit-card absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within/input:text-[#d32f2f] transition-colors"></i>
                                    <input type="text" placeholder="0000 0000 0000 0000"
                                        class="w-full bg-white text-gray-900 border border-gray-200 focus:border-[#d32f2f] focus:ring-4 focus:ring-[#d32f2f]/5 rounded-xl pl-12 pr-4 py-4 transition-all outline-none font-bold placeholder:text-gray-300 tracking-[0.2em]">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-500 font-black uppercase tracking-[0.2em] text-[9px] mb-3 ml-1">MM / YY</label>
                                    <input type="text" placeholder="12 / 28"
                                        class="w-full bg-white text-gray-900 border border-gray-200 focus:border-[#d32f2f] focus:ring-4 focus:ring-[#d32f2f]/5 rounded-xl px-4 py-4 transition-all outline-none font-bold placeholder:text-gray-300 text-center">
                                </div>
                                <div>
                                    <label class="block text-gray-500 font-black uppercase tracking-[0.2em] text-[9px] mb-3 ml-1">CVC / CVV</label>
                                    <input type="text" placeholder="123"
                                        class="w-full bg-white text-gray-900 border border-gray-200 focus:border-[#d32f2f] focus:ring-4 focus:ring-[#d32f2f]/5 rounded-xl px-4 py-4 transition-all outline-none font-bold placeholder:text-gray-300 text-center text-security-disc">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Mobile Wallet Flow (EasyPaisa/JazzCash) --}}
                    <div id="wallet-details-fields" class="hidden pt-6 border-t border-gray-200 mt-6 animate-fade-in">
                        <div class="bg-white rounded-3xl p-8 border border-gray-200 shadow-inner relative overflow-hidden group/wallet">
                            {{-- Decorative corner --}}
                            <div class="absolute top-0 right-0 w-24 h-24 bg-red-50 -mr-12 -mt-12 rounded-full blur-2xl group-hover/wallet:bg-red-100 transition-colors"></div>
                            
                            <div class="flex flex-col md:flex-row gap-8 items-center relative z-10">
                                {{-- QR Code Section --}}
                                <div class="flex-shrink-0">
                                    <div class="w-40 h-40 bg-white rounded-2xl p-3 border-2 border-gray-100 shadow-xl flex flex-col items-center justify-center text-center relative group/qr overflow-hidden hover:border-[#d32f2f] transition-all">
                                        <div class="absolute inset-0 bg-red-500/5 opacity-0 group-hover/qr:opacity-100 transition-opacity"></div>
                                        <i class="bi bi-qr-code text-7xl text-gray-800 mb-2"></i>
                                        <div class="text-[8px] font-black uppercase text-[#d32f2f] tracking-widest bg-red-50 px-2 py-0.5 rounded-full">Secure Scan</div>
                                    </div>
                                </div>

                                <div class="flex-grow space-y-4">
                                    <div class="flex items-center gap-3">
                                        <div id="wallet-icon-box" class="w-10 h-10 rounded-xl bg-red-600 flex items-center justify-center shadow-lg shadow-red-500/20">
                                            <i class="bi bi-wallet2 text-white text-lg"></i>
                                        </div>
                                        <div>
                                            <h4 id="wallet-name" class="text-xl font-black text-gray-900 uppercase tracking-tight leading-none mb-1">EasyPaisa Transaction</h4>
                                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Verified Merchant Account</span>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 hover:border-gray-300 transition-colors">
                                            <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest block mb-1">Account Title</span>
                                            <span class="text-sm font-black text-gray-900 tracking-tight">AHMED MAZARI</span>
                                        </div>
                                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 hover:border-gray-300 transition-colors">
                                            <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest block mb-1">Account Number</span>
                                            <span class="text-sm font-black text-gray-900 tracking-tight">0303 4012525</span>
                                        </div>
                                    </div>

                                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 flex items-start gap-3">
                                        <div class="w-6 h-6 rounded-full bg-amber-500 flex flex-shrink-0 items-center justify-center text-white shadow-sm">
                                            <i class="bi bi-info-lg"></i>
                                        </div>
                                        <p class="text-[10px] text-amber-900 leading-normal font-bold">
                                            Please transfer the exact amount. Once successful, capture a screenshot of the receipt and upload it below for priority processing.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-8 pt-8 border-t border-gray-100 relative z-10">
                                <label class="block text-gray-400 font-black uppercase tracking-[0.2em] text-[9px] mb-3 ml-1">Payment Verification (SS)</label>
                                <div class="relative group/upload">
                                    <input type="file" name="payment_screenshot" id="payment_screenshot" class="hidden" onchange="updateFileName(this)">
                                    <label for="payment_screenshot" class="w-full bg-gray-50 border-2 border-dashed border-gray-200 group-hover/upload:border-[#d32f2f] group-hover/upload:bg-white rounded-2xl px-6 py-6 flex items-center justify-between cursor-pointer transition-all">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm border border-gray-100 group-hover/upload:bg-red-50 group-hover/upload:border-red-100">
                                                <i class="bi bi-cloud-arrow-up text-2xl text-gray-400 group-hover/upload:text-[#d32f2f] transition-colors"></i>
                                            </div>
                                            <div class="flex flex-col">
                                                <span id="file-label" class="text-sm font-black text-gray-900 truncate max-w-[200px]">Drop receipt here</span>
                                                <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">JPG, PNG up to 2MB</span>
                                            </div>
                                        </div>
                                        <span class="bg-gray-900 text-white px-5 py-2.5 rounded-lg text-[10px] font-black uppercase tracking-widest group-hover/upload:bg-[#d32f2f] transition-all shadow-lg active:scale-95">Browse Files</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Summary Sidebar --}}
            <div class="lg:col-span-1">
                <div class="bg-white border border-[#d32f2f]/20 rounded-lg p-8 shadow-[0_20px_40px_rgba(211,47,47,0.05)] sticky top-24">
                    <h2 class="text-xl font-black text-gray-900 uppercase tracking-widest mb-6 border-b border-gray-200 pb-5">Review Order</h2>
                    
                    {{-- Mini Cart Items --}}
                    <div class="space-y-4 mb-6 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($cart as $details)
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 flex-shrink-0">
                                    <img src="{{ (Str::startsWith($details['image'] ?? '', 'http')) ? $details['image'] : asset('storage/' . ($details['image'] ?? 'products/default.jpg')) }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-grow">
                                    <h4 class="text-gray-900 text-xs font-bold truncate w-40">{{ $details['name'] }}</h4>
                                    <div class="text-gray-600 text-[10px]">Qty: {{ $details['quantity'] }}</div>
                                </div>
                                <span class="text-[#d32f2f] font-black text-sm">${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-4 mb-8 bg-gray-100 rounded p-5 border border-gray-200 shadow-sm">
                        <div class="flex justify-between text-gray-600 font-medium">
                            <span class="tracking-wide">Subtotal</span>
                            <span class="text-gray-900 font-bold">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600 font-medium">
                            <span class="tracking-wide">VIP Shipping</span>
                            <span class="text-[#d32f2f] font-bold uppercase tracking-widest text-xs flex items-center">Free</span>
                        </div>
                        @if(session('coupon'))
                            @php
                                $coupon = session('coupon');
                                $discount = $coupon['type'] == 'fixed' ? $coupon['value'] : ($total * ($coupon['value'] / 100));
                            @endphp
                            <div class="flex justify-between text-green-600 font-bold border-t border-gray-100 pt-4">
                                <span class="tracking-wide uppercase text-[10px]">VIP Discount ({{ $coupon['code'] }})</span>
                                <span>-${{ number_format($discount, 2) }}</span>
                            </div>
                        @else
                            @php $discount = 0; @endphp
                        @endif
                        <div class="flex justify-between text-gray-600 font-medium pb-4 border-b border-gray-200">
                            <span class="tracking-wide">Tax (Estimated)</span>
                            <span class="text-gray-900 font-bold">${{ number_format(($total - $discount) * 0.08, 2) }}</span>
                        </div>
                        <div class="pt-2 flex justify-between items-center">
                            <span class="text-gray-900 font-black uppercase tracking-widest text-lg">Total</span>
                            <span class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-red-700">${{ number_format(($total - $discount) + (($total - $discount) * 0.08), 2) }}</span>
                        </div>
                    </div>
                    
                    <button type="submit" form="checkout-form" onclick="this.innerHTML='<i class=\'bi bi-arrow-repeat animate-spin mr-2\'></i> Processing...'; this.classList.add('opacity-80', 'pointer-events-none')" class="w-full bg-gradient-to-r from-gray-900 to-gray-800 hover:from-[#d32f2f] hover:to-red-500 text-white font-black uppercase tracking-[0.3em] py-5 rounded-2xl transition-all duration-500 shadow-xl hover:shadow-[#d32f2f]/20 active:scale-95 flex items-center justify-center gap-2 group/btn">
                        <i class="bi bi-shield-lock-fill text-xl group-hover/btn:rotate-12 transition-transform"></i> <span>Place COD Order</span>
                    </button>
                    
                    <div class="mt-4 flex flex-col items-center justify-center text-center gap-1 opacity-60">
                        <i class="bi bi-shield-check text-green-500 text-2xl"></i>
                        <span class="text-xs text-gray-600 font-medium">256-bit AES Encryption</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Update Payment UI Flow
    function updatePaymentUI(method) {
        const subOptions = document.getElementById('online-sub-options');
        const cardFields = document.getElementById('card-details-fields');
        const walletFields = document.getElementById('wallet-details-fields');
        const submitBtnText = document.querySelector('button[form="checkout-form"] span');
        const btnIcon = document.querySelector('button[form="checkout-form"] i');

        if (method === 'cod') {
            subOptions.classList.add('hidden');
            cardFields.classList.add('hidden');
            walletFields.classList.add('hidden');
            if (submitBtnText) submitBtnText.textContent = 'Confirm COD Order';
            if (btnIcon) btnIcon.className = 'bi bi-shield-lock-fill text-lg';
        } else {
            subOptions.classList.remove('hidden');
            // Check which online method is selected
            const checkedOnline = document.querySelector('input[name="online_payment_method"]:checked');
            if (checkedOnline) {
                toggleOnlineMethod(checkedOnline.value);
            }
        }
    }

    // Toggle specific online method details
    function toggleOnlineMethod(method) {
        const cardFields = document.getElementById('card-details-fields');
        const walletFields = document.getElementById('wallet-details-fields');
        const walletName = document.getElementById('wallet-name');
        const walletIconBox = document.getElementById('wallet-icon-box');
        const submitBtnText = document.querySelector('button[form="checkout-form"] span');
        const btnIcon = document.querySelector('button[form="checkout-form"] i');

        if (method === 'card') {
            cardFields.classList.remove('hidden');
            walletFields.classList.add('hidden');
            if (submitBtnText) submitBtnText.textContent = 'Authorize & Pay';
            if (btnIcon) btnIcon.className = 'bi bi-lightning-fill text-lg transition-all animate-pulse';
        } else {
            cardFields.classList.add('hidden');
            walletFields.classList.remove('hidden');
            walletName.textContent = method === 'easypaisa' ? 'EasyPaisa Transaction' : 'JazzCash Transaction';
            
            // UI adjustment for specific wallet
            if (method === 'easypaisa') {
                walletIconBox.className = "w-10 h-10 rounded-xl bg-green-600 flex items-center justify-center shadow-lg shadow-green-500/20 transition-all";
                walletIconBox.querySelector('i').className = "bi bi-wallet2 text-white text-lg";
            } else {
                walletIconBox.className = "w-10 h-10 rounded-xl bg-orange-600 flex items-center justify-center shadow-lg shadow-orange-500/20 transition-all";
                walletIconBox.querySelector('i').className = "bi bi-phone text-white text-lg";
            }

            if (submitBtnText) submitBtnText.textContent = 'Submit Payment SS';
            if (btnIcon) btnIcon.className = 'bi bi-cloud-arrow-up text-lg transition-all';
        }
    }

    // File name display
    function updateFileName(input) {
        const label = document.getElementById('file-label');
        if (input.files && input.files[0]) {
            label.textContent = input.files[0].name;
            label.className = 'text-sm font-black text-[#d32f2f] truncate max-w-[200px]';
        }
    }

    // Initial check and error handling
    window.addEventListener('load', () => {
        const checkedMethod = document.querySelector('input[name="payment_method"]:checked');
        if (checkedMethod) {
            updatePaymentUI(checkedMethod.value);
        }

        // Handle errors and ensure UI matches state
        @if($errors->any())
            const errorMethod = document.querySelector('input[name="payment_method"]:checked');
            if (errorMethod) {
                updatePaymentUI(errorMethod.value);
            }
        @endif
    });
</script>

<style>
/* Custom Scrollbar for mini cart */
.custom-scrollbar::-webkit-scrollbar {
    width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: #111;
    border-radius: 4px;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #333;
    border-radius: 4px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #d4af37;
}

/* Animations */
.animate-fade-in {
    animation: fadeIn 0.4s ease-out forwards;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Security disk for CVC */
.text-security-disc {
    -webkit-text-security: disc;
}
</style>
@endsection
