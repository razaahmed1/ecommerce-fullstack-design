<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'VIP Terminal') - Admin Console</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@400;700&family=Orbitron:wght@400;500;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        /* Professional Toast Notifications */
        #toast-container { position: fixed; bottom: 2rem; right: 2rem; z-index: 9999; display: flex; flex-direction: column; gap: 1rem; pointer-events: none; }
        .toast-item { pointer-events: auto; width: 350px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(15px); border-radius: 20px; padding: 1.25rem; display: flex; align-items: center; gap: 1rem; box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15); border: 1px solid rgba(0,0,0,0.05); position: relative; overflow: hidden; animation: toast-slide-in 0.6s cubic-bezier(0.68, -0.6, 0.32, 1.6) forwards; }
        .toast-item.hiding { animation: toast-slide-out 0.5s ease-in forwards; }
        .toast-item::before { content: ''; position: absolute; bottom: 0; left: 0; height: 4px; width: 100%; animation: toast-progress 4s linear forwards; }
        .toast-success { border-left: 6px solid #10B981; }
        .toast-success i { color: #10B981; }
        .toast-success::before { background: #10B981; }
        .toast-error { border-left: 6px solid #EF4444; }
        .toast-error i { color: #EF4444; }
        .toast-error::before { background: #EF4444; }
        .toast-content { flex-grow: 1; }
        .toast-title { display: block; font-size: 0.9rem; font-weight: 900; color: #1a1a1a; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 2px; }
        .toast-message { display: block; font-size: 0.8rem; color: #4a4a4a; font-weight: 600; }
        .toast-close { cursor: pointer; color: #ccc; transition: all 0.3s; font-size: 1.2rem; }
        .toast-close:hover { color: #000; transform: rotate(90deg); }
        @keyframes toast-slide-in { from { opacity: 0; transform: translateX(40px) scale(0.95); } to { opacity: 1; transform: translateX(0) scale(1); } }
        @keyframes toast-slide-out { from { opacity: 1; transform: translateX(0); } to { opacity: 0; transform: translateX(100%); } }
        @keyframes toast-progress { from { width: 100%; } to { width: 0%; } }
    </style>
</head>
<body class="antialiased selection:bg-[#d32f2f] selection:text-black min-h-screen flex overflow-hidden">

    {{-- SIDEBAR --}}
    <aside class="w-72 glass-panel shadow-[5px_0_25px_rgba(0,0,0,0.5)] border-r border-gray-200 flex flex-col z-50 transition-all duration-300 relative">
        <div class="absolute inset-0 bg-gradient-to-b from-red-700/5 to-transparent pointer-events-none"></div>
        
        <div class="p-8 border-b border-gray-200 relative z-10">
            <h1 class="font-syncopate text-2xl font-black text-gray-900 tracking-widest leading-none">
                VIP <span class="text-gold block text-sm tracking-[0.3em] font-bold mt-1">TERMINAL</span>
            </h1>
        </div>
        
        <nav class="flex-1 px-4 py-8 space-y-2 relative z-10 overflow-y-auto">
            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest px-4 mb-4">Command Center</p>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-red-700/20 to-transparent text-gold border-l-2 border-gold font-bold' : 'text-gray-400 hover:text-gray-900 hover:bg-black/5 transition-all' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
            
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl {{ request()->routeIs('admin.orders.*') ? 'bg-gradient-to-r from-red-700/20 to-transparent text-gold border-l-2 border-gold font-bold' : 'text-gray-400 hover:text-gray-900 hover:bg-black/5 transition-all' }}">
                <i class="bi bi-box-seam-fill"></i> Orders
                @php
                    $pendingCount = \App\Models\Order::whereIn('status', ['pending', 'Pending'])->count();
                @endphp
                @if($pendingCount > 0)
                    <span class="ml-auto bg-red-600 text-white text-[9px] font-black px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                @endif
            </a>
            
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl {{ request()->routeIs('admin.products.*') ? 'bg-gradient-to-r from-red-700/20 to-transparent text-gold border-l-2 border-gold font-bold' : 'text-gray-400 hover:text-gray-900 hover:bg-black/5 transition-all' }}">
                <i class="bi bi-tags-fill"></i> Inventory
                @php
                    $lowStockCount = \App\Models\Product::where('stock', '<=', 5)->count();
                @endphp
                @if($lowStockCount > 0)
                    <span class="ml-auto bg-[#d32f2f] text-black text-[9px] font-black px-2 py-0.5 rounded-full">{{ $lowStockCount }}</span>
                @endif
            </a>
        </nav>
        
        <div class="p-6 border-t border-gray-200 relative z-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-500 to-red-700 p-[2px]">
                    <div class="w-full h-full bg-white rounded-full flex items-center justify-center text-gold font-bold text-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
                <div class="flex flex-col">
                    <span class="text-xs font-bold text-gray-900">{{ Auth::user()->name }}</span>
                    <span class="text-[9px] text-gray-500 font-bold uppercase tracking-widest text-gold text-shadow">SYSADMIN</span>
                </div>
            </div>
            
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button class="w-full py-2 bg-white border border-gray-300 hover:border-red-500/50 hover:bg-red-900/10 text-gray-600 hover:text-red-500 rounded-lg text-xs font-bold uppercase tracking-widest transition-all flex items-center justify-center gap-2 shadow-inner">
                    <i class="bi bi-power"></i> Secure Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 h-screen overflow-y-auto relative bg-gray-100">
        {{-- Ambient VIP Glow --}}
        <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-red-700/5 rounded-full blur-[120px] pointer-events-none -translate-y-1/2 translate-x-1/2"></div>
        
        {{-- Navbar Header --}}
        <header class="h-20 glass-panel border-b border-gray-200 flex items-center justify-between px-8 sticky top-0 z-40">
            <div class="flex items-center gap-3 text-gray-600">
                <i class="bi bi-clock-history"></i>
                <span class="text-xs font-bold tracking-widest">{{ now()->format('l, M jS, h:i A') }}</span>
            </div>
            
            <div class="flex items-center gap-6">
                <a href="/" target="_blank" class="text-gray-600 hover:text-gold text-xs font-bold uppercase tracking-widest transition-colors flex items-center gap-2">
                    View Live Store <i class="bi bi-box-arrow-up-right"></i>
                </a>
            </div>
        </header>

        {{-- Dynamic Content Injection --}}
        <div class="p-8 pb-24 relative z-10 w-full max-w-7xl mx-auto">
            <!-- Toast Container -->
            <div id="toast-container">
                @if(session('success'))
                    <div class="toast-item toast-success" id="success-toast">
                        <i class="bi bi-check-circle-fill text-xl"></i>
                        <div class="toast-content">
                            <span class="toast-title">Success</span>
                            <span class="toast-message">{{ session('success') }}</span>
                        </div>
                        <i class="bi bi-x toast-close" onclick="closeToast('success-toast')"></i>
                    </div>
                @endif

                @if(session('error'))
                    <div class="toast-item toast-error" id="error-toast">
                        <i class="bi bi-exclamation-triangle-fill text-xl"></i>
                        <div class="toast-content">
                            <span class="toast-title">Error</span>
                            <span class="toast-message">{{ session('error') }}</span>
                        </div>
                        <i class="bi bi-x toast-close" onclick="closeToast('error-toast')"></i>
                    </div>
                @endif
            </div>

            @yield('content')
        </div>
    </main>
    
    
    <script>
        // Toast logic
        function closeToast(id) {
            const toast = document.getElementById(id);
            if (toast) {
                toast.classList.add('hiding');
                setTimeout(() => toast.remove(), 500);
            }
        }

        // Auto-close toasts
        window.addEventListener('load', () => {
            const successToast = document.getElementById('success-toast');
            const errorToast = document.getElementById('error-toast');
            if (successToast) setTimeout(() => closeToast('success-toast'), 4000);
            if (errorToast) setTimeout(() => closeToast('error-toast'), 4000);
        });
    </script>
</body>
</html>
