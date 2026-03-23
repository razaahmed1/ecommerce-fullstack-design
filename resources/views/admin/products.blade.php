@extends('layouts.admin')

@section('title', 'Inventory Network')

@section('content')

<div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="font-syncopate text-2xl font-black text-gray-900 tracking-widest leading-none">
            INVENTORY <span class="text-[#d32f2f]">NETWORK</span>
        </h1>
        <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-2">Manage overarching product catalog schemas and restock limits.</p>
    </div>
    <div class="flex items-center gap-3">
        @if(request()->has('low_stock'))
            <a href="{{ route('admin.products.index') }}" class="text-[10px] bg-white hover:bg-[#d32f2f] hover:text-white border border-gray-200 text-gray-600 font-black uppercase tracking-widest px-4 py-2 rounded transition-colors flex items-center gap-2">
                <i class="bi bi-x-circle"></i> Clear Low Stock Filter
            </a>
        @endif
        <a href="{{ route('admin.products.create') }}" class="text-xs bg-[#d32f2f] hover:bg-red-700 text-white font-black uppercase tracking-widest px-5 py-2.5 rounded shadow-lg shadow-red-900/40 transition-all flex items-center gap-2">
            <i class="bi bi-plus-lg"></i> Add New Part
        </a>
    </div>
</div>

<div class="glass-panel border-t-[4px] border-t-[#d32f2f] rounded flex flex-col overflow-hidden">
    <div class="p-6 overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold px-4">Part View</th>
                    <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold px-4">SKU & Label</th>
                    <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold px-4">Category / Brand</th>
                    <th class="border-b border-gray-200 pb-3 text-[10px] uppercase tracking-widest text-gray-500 font-bold px-4">Stock Level Control</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($products as $prod)
                    <tr class="hover:bg-black/5 transition-colors group border-b border-gray-200">
                        <td class="py-4 px-4 w-20">
                            <div class="w-12 h-12 bg-gray-50 rounded-lg p-1 border border-gray-200 overflow-hidden mix-blend-multiply shrink-0">
                                <img src="{{ Str::startsWith($prod->images->first()->image_path ?? '', 'http') ? $prod->images->first()->image_path : asset('storage/' . ($prod->images->first()->image_path ?? 'products/default.jpg')) }}" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="text-gray-800 font-bold truncate max-w-[200px]">{{ $prod->name }}</div>
                            <div class="text-[10px] text-[#d32f2f] mt-1 tracking-widest">SKU: {{ $prod->sku }}</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex flex-col gap-1">
                                <span class="bg-red-50 text-[#d32f2f] border border-red-100 text-[9px] uppercase font-black px-2 py-0.5 rounded w-max">{{ $prod->category->name ?? 'None' }}</span>
                                <span class="bg-gray-50 text-gray-600 border border-gray-200 text-[9px] uppercase font-black px-2 py-0.5 rounded w-max">{{ $prod->brand->name ?? 'None' }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <form action="{{ route('admin.products.updateStock', $prod->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <div class="relative flex items-center">
                                    <input type="number" name="stock" value="{{ $prod->stock }}" min="0" class="w-20 bg-gray-50 border {{ $prod->stock <= 5 ? 'border-red-500 text-red-500' : 'border-gray-800 text-gray-300' }} text-sm font-black rounded px-3 py-1 outline-none focus:border-[#d32f2f] text-center">
                                    @if($prod->stock <= 5)
                                        <i class="bi bi-exclamation-triangle-fill text-red-500 absolute -right-6 text-xs animate-pulse"></i>
                                    @endif
                                </div>
                                <button type="submit" class="bg-gray-800 hover:bg-[#d32f2f] text-gray-300 hover:text-white transition-colors px-3 py-1 ml-4 text-[10px] font-black uppercase tracking-widest rounded w-max">OVERRIDE</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center text-gray-500 text-xs font-bold uppercase tracking-widest">No inventory items matched protocol.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($products->hasPages())
        <div class="p-6 border-t border-gray-200 bg-gray-100">
            {{ $products->links('pagination::tailwind') }}
        </div>
    @endif
</div>

@endsection
