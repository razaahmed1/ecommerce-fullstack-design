@extends('layouts.store')
@section('title', 'Contact Us - VIP AutoParts Hub')

@section('content')
<div class="bg-white min-h-screen py-20">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="text-[#d32f2f] text-xs font-black uppercase tracking-[0.3em] mb-4 block">Get in Touch</span>
            <h1 class="text-5xl lg:text-7xl font-black text-gray-900 uppercase tracking-tighter leading-none mb-6">
                Direct <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-800">Support</span> Line
            </h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            {{-- Contact Info Cards --}}
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-gray-100 p-8 rounded-[40px] border border-gray-200" data-aos="fade-right" data-aos-delay="100">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-[#d32f2f] text-2xl mb-6 shadow-sm">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 uppercase mb-2">Headquarters</h3>
                    <p class="text-gray-600 text-sm">Near University of Lahore,<br>Lahore, Pakistan</p>
                </div>

                <div class="bg-gray-100 p-8 rounded-[40px] border border-gray-200" data-aos="fade-right" data-aos-delay="200">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-[#d32f2f] text-2xl mb-6 shadow-sm">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 uppercase mb-2">Direct Line</h3>
                    <p class="text-gray-600 text-sm font-bold">03034012525</p>
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest mt-1">Mon - Sat, 9am - 9pm</p>
                </div>

                <div class="bg-gray-100 p-8 rounded-[40px] border border-gray-200" data-aos="fade-right" data-aos-delay="300">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-[#d32f2f] text-2xl mb-6 shadow-sm">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 uppercase mb-2">Email Support</h3>
                    <p class="text-gray-600 text-sm">ahmedmazari111@gmail.com</p>
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest mt-1">Avg response: 1 hour</p>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="lg:col-span-2 bg-white border border-gray-200 shadow-[0_30px_60px_rgba(0,0,0,0.05)] rounded-[50px] p-10 lg:p-16" data-aos="fade-left">
                <form action="#" class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-gray-500 font-bold uppercase tracking-widest text-[10px] mb-2 ml-1">Full Name</label>
                            <input type="text" placeholder="John Doe" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:border-[#d32f2f] focus:ring-1 focus:ring-[#d32f2f] transition-all">
                        </div>
                        <div>
                            <label class="block text-gray-500 font-bold uppercase tracking-widest text-[10px] mb-2 ml-1">Email Address</label>
                            <input type="email" placeholder="john@example.com" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:border-[#d32f2f] focus:ring-1 focus:ring-[#d32f2f] transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-500 font-bold uppercase tracking-widest text-[10px] mb-2 ml-1">Vehicle Details (Optional)</label>
                        <input type="text" placeholder="e.g. 2022 Honda Civic" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:border-[#d32f2f] focus:ring-1 focus:ring-[#d32f2f] transition-all">
                    </div>
                    <div>
                        <label class="block text-gray-500 font-bold uppercase tracking-widest text-[10px] mb-2 ml-1">Message</label>
                        <textarea rows="5" placeholder="How can our technical team assist you?" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:border-[#d32f2f] focus:ring-1 focus:ring-[#d32f2f] transition-all resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-gradient-to-r from-red-700 to-[#d32f2f] hover:from-[#d32f2f] hover:to-red-500 text-black font-black uppercase tracking-widest py-5 rounded-2xl transition-all shadow-xl hover:shadow-[#d32f2f]/30 active:scale-95 flex items-center justify-center gap-3">
                        <i class="bi bi-send-fill"></i> Transmit Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
