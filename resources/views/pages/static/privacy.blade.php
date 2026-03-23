@extends('layouts.store')
@section('title', 'Privacy Policy - VIP AutoParts Hub')

@section('content')
<div class="bg-white min-h-screen py-20">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="text-[#d32f2f] text-xs font-black uppercase tracking-[0.3em] mb-4 block">Data Security</span>
            <h1 class="text-5xl font-black text-gray-900 uppercase tracking-tighter leading-none mb-6">
                Privacy <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-800">Protocol</span>
            </h1>
            <p class="text-gray-500 font-bold uppercase tracking-widest text-xs">Last Updated: March 2026</p>
        </div>

        <div class="space-y-12 text-gray-600 leading-relaxed" data-aos="fade-up">
            <section>
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 bg-gray-100 border border-gray-200 rounded flex items-center justify-center text-[#d32f2f] text-sm">01</span>
                    Information We Collect
                </h2>
                <p class="mb-4">
                    At VIP AutoParts Hub, your privacy is our top priority. We collect only the information necessary to provide you with a premium shopping experience, including:
                </p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Personal identification (Name, email address, phone number)</li>
                    <li>Shipping and billing addresses</li>
                    <li>Payment information (Processed securely through encrypted gateways)</li>
                    <li>Vehicle information for part compatibility</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 bg-gray-100 border border-gray-200 rounded flex items-center justify-center text-[#d32f2f] text-sm">02</span>
                    How We Use Your Data
                </h2>
                <p>
                    Your data is strictly used for order processing, account management, and providing personalized product recommendations. We never sell or share your personal information with third-party advertisers.
                </p>
            </section>

            <section>
                <div class="bg-gray-100 border-l-4 border-[#d32f2f] p-8 rounded-r-3xl">
                    <h3 class="text-lg font-black text-gray-900 uppercase mb-2">Military-Grade Encryption</h3>
                    <p class="text-sm">We use 256-bit AES encryption and secure socket layer (SSL) technology to protect your data during every stage of your transaction.</p>
                </div>
            </section>

            <section>
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 bg-gray-100 border border-gray-200 rounded flex items-center justify-center text-[#d32f2f] text-sm">03</span>
                    Cookies & Analytics
                </h2>
                <p>
                    We use cookies to enhance your browsing experience, remember your preferences, and analyze site performance. You can manage your cookie settings through your browser at any time.
                </p>
            </section>
        </div>
    </div>
</div>
@endsection
