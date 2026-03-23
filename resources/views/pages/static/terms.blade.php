@extends('layouts.store')
@section('title', 'Terms & Conditions - VIP AutoParts Hub')

@section('content')
<div class="bg-gray-50 min-h-screen py-20">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="text-[#d32f2f] text-xs font-black uppercase tracking-[0.3em] mb-4 block">Legal</span>
            <h1 class="text-5xl font-black text-gray-900 uppercase tracking-tighter leading-none mb-6">
                Terms of <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-800">Engagement</span>
            </h1>
        </div>

        <div class="bg-white p-12 rounded-[50px] shadow-sm border border-gray-200 space-y-10 text-gray-600" data-aos="fade-up">
            <section>
                <h2 class="text-xl font-black text-gray-900 uppercase tracking-tight mb-4 underline decoration-[#d32f2f] decoration-2">1. Acceptance of Terms</h2>
                <p>By accessing and using this website, you agree to be bound by these Terms and Conditions and all applicable laws and regulations. If you do not agree with any of these terms, you are prohibited from using or accessing this site.</p>
            </section>

            <section>
                <h2 class="text-xl font-black text-gray-900 uppercase tracking-tight mb-4 underline decoration-[#d32f2f] decoration-2">2. Warranty Disclaimer</h2>
                <p>Parts are provided "as is". While we guarantee genuine items from our partners, the manufacturer's warranty is the primary protection for components. Incorrect installation by non-certified professionals voids any store-specific return policies.</p>
            </section>

            <section>
                <h2 class="text-xl font-black text-gray-900 uppercase tracking-tight mb-4 underline decoration-[#d32f2f] decoration-2">3. Limitation of Liability</h2>
                <p>VIP AutoParts Hub shall not be liable for any damages arising out of the use or inability to use the materials on our website, even if we have been notified orally or in writing of the possibility of such damage.</p>
            </section>

            <section>
                <div class="bg-[#d32f2f]/5 p-6 rounded-2xl border border-[#d32f2f]/10 text-sm italic">
                    Note: These terms are subject to change without prior notice. Continued use of the platform after changes implies acceptance of the new terms.
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
