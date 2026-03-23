@extends('layouts.admin')

@section('title', 'Add New Part - Inventory Network')

@section('content')

<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="font-syncopate text-2xl font-black text-gray-900 tracking-widest leading-none">
            ADD NEW <span class="text-[#d32f2f]">PART</span>
        </h1>
        <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-2">Ingest new product SKU into the global catalog.</p>
    </div>
    <a href="{{ route('admin.products.index') }}" class="text-[10px] bg-white hover:bg-gray-800 border border-gray-200 text-gray-600 font-black uppercase tracking-widest px-4 py-2 rounded transition-colors flex items-center gap-2">
        <i class="bi bi-arrow-left"></i> Return to Inventory
    </a>
</div>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    @csrf

    {{-- Left Column: Main Details --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="glass-panel border-t-[4px] border-t-[#d32f2f] rounded p-6">
            <h2 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6 border-b border-gray-200 pb-3">Primary Information</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Part Name / Title</label>
                    <input type="text" name="name" required placeholder="e.g. Forged Alloy Rims 22\"" class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded px-4 py-3 outline-none focus:border-[#d32f2f] transition-colors shadow-sm" value="{{ old('name') }}">
                    @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">SKU (Optional)</label>
                    <input type="text" name="sku" placeholder="e.g. WHL-22-BLK" class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded px-4 py-3 outline-none focus:border-[#d32f2f] transition-colors shadow-sm" value="{{ old('sku') }}">
                    @error('sku') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Category</label>
                    <select name="category_id" required class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded px-4 py-3 outline-none focus:border-[#d32f2f] transition-colors shadow-sm">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Brand</label>
                    <select name="brand_id" required class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded px-4 py-3 outline-none focus:border-[#d32f2f] transition-colors shadow-sm">
                        <option value="">-- Select Brand --</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-2">
                <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Detailed Description</label>
                <textarea name="description" required rows="5" class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded px-4 py-3 outline-none focus:border-[#d32f2f] transition-colors shadow-sm" placeholder="Engineered for high performance...">{{ old('description') }}</textarea>
                @error('description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Photos section --}}
        <div class="glass-panel border-t-[4px] border-t-gray-700 rounded p-6">
            <h2 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6 border-b border-gray-200 pb-3">Product Media Gallery</h2>
            
            <div class="w-full relative border-2 border-dashed border-gray-300 hover:border-[#d32f2f] rounded-lg p-10 flex flex-col items-center justify-center transition-colors bg-gray-50 group">
                <input type="file" name="images[]" multiple accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" id="file-upload">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 group-hover:bg-[#d32f2f]/20 transition-colors">
                    <i class="bi bi-images text-2xl text-gray-500 group-hover:text-[#d32f2f] transition-colors"></i>
                </div>
                <p class="text-gray-900 font-black uppercase tracking-widest text-sm mb-1">Drag & Drop or Click</p>
                <p class="text-gray-500 text-xs mb-4">You can select multiple high-quality images simultaneously.</p>
                <div class="text-[10px] bg-black px-3 py-1 rounded text-red-500 font-bold tracking-widest" id="file-count">0 Files Selected</div>
            </div>
            @error('images.*') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Right Column: Pricing & Meta --}}
    <div class="space-y-6">
        <div class="glass-panel border-t-[4px] border-t-gray-700 rounded p-6">
            <h2 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6 border-b border-gray-200 pb-3">Inventory Limits</h2>
            
            <div class="mb-5">
                <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Current Price ($)</label>
                <input type="number" step="0.01" name="price" required class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-xl font-black rounded px-4 py-3 outline-none focus:border-[#d32f2f] transition-colors shadow-sm" value="{{ old('price') }}">
                @error('price') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="mb-5">
                <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Compare at Price ($)</label>
                <input type="number" step="0.01" name="old_price" class="w-full bg-gray-50 border border-gray-200 text-gray-500 text-sm font-black rounded px-4 py-3 outline-none focus:border-[#d32f2f] transition-colors shadow-sm" value="{{ old('old_price') }}">
                <p class="text-[9px] text-gray-600 mt-1 uppercase tracking-widest">To show a discount, enter higher original price.</p>
            </div>

            <div class="mb-2">
                <label class="block text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">Available Stock</label>
                <input type="number" name="stock" required class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-lg font-black rounded px-4 py-3 outline-none focus:border-[#d32f2f] transition-colors shadow-sm" value="{{ old('stock', 10) }}">
                @error('stock') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="glass-panel border-t-[4px] border-t-gray-700 rounded p-6">
            <h2 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6 border-b border-gray-200 pb-3">Visibility Flags</h2>
            
            <label class="flex items-center gap-3 cursor-pointer group mb-4">
                <div class="relative">
                    <input type="checkbox" name="status" class="sr-only" checked>
                    <div class="w-10 h-5 bg-gray-800 border border-gray-300 rounded overflow-hidden flex transition-colors status-bg group-hover:border-gray-500">
                        <div class="w-1/2 h-full bg-[#d32f2f] transition-transform duration-300 translate-x-full toggle-slider"></div>
                    </div>
                </div>
                <span class="text-xs font-bold text-gray-800 uppercase tracking-widest">Active Store Listing</span>
            </label>

            <label class="flex items-center gap-3 cursor-pointer group mb-4">
                <div class="relative">
                    <input type="checkbox" name="is_featured" class="sr-only">
                    <div class="w-10 h-5 bg-gray-800 border border-gray-300 rounded overflow-hidden flex transition-colors status-bg group-hover:border-gray-500">
                        <div class="w-1/2 h-full bg-[#d32f2f] transition-transform duration-300 toggle-slider"></div>
                    </div>
                </div>
                <span class="text-xs font-bold text-gray-800 uppercase tracking-widest">Featured on Homepage</span>
            </label>

            <label class="flex items-center gap-3 cursor-pointer group">
                <div class="relative">
                    <input type="checkbox" name="is_new" class="sr-only">
                    <div class="w-10 h-5 bg-gray-800 border border-gray-300 rounded overflow-hidden flex transition-colors status-bg group-hover:border-gray-500">
                        <div class="w-1/2 h-full bg-[#d32f2f] transition-transform duration-300 toggle-slider"></div>
                    </div>
                </div>
                <span class="text-xs font-bold text-gray-800 uppercase tracking-widest">Mark as New Arrival</span>
            </label>
        </div>

        <button type="submit" class="w-full bg-[#d32f2f] hover:bg-red-700 text-white font-black uppercase tracking-widest px-5 py-5 rounded shadow-xl shadow-red-900/30 transition-all flex items-center justify-center gap-3 active:scale-95 border border-red-500">
            <i class="bi bi-hdd-fill"></i> Save Inventory Item
        </button>
    </div>
</form>

<script>
    // UX File count
    const fileInput = document.getElementById('file-upload');
    const fileCount = document.getElementById('file-count');
    fileInput.addEventListener('change', function() {
        if(this.files.length > 0) {
            fileCount.textContent = this.files.length + ' File(s) Selected';
            fileCount.classList.remove('text-red-500', 'bg-black');
            fileCount.classList.add('text-green-400', 'bg-green-900/30');
        } else {
            fileCount.textContent = '0 Files Selected';
            fileCount.classList.add('text-red-500', 'bg-black');
            fileCount.classList.remove('text-green-400', 'bg-green-900/30');
        }
    });

    // Custom Toggle UX
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        const slider = checkbox.nextElementSibling.querySelector('.toggle-slider');
        
        // Initial state
        if(checkbox.checked) {
            slider.style.transform = 'translateX(100%)';
        } else {
            slider.style.transform = 'translateX(0)';
        }
        
        // Change listener
        checkbox.addEventListener('change', function() {
            if(this.checked) {
                slider.style.transform = 'translateX(100%)';
            } else {
                slider.style.transform = 'translateX(0)';
            }
        });
    });
</script>

@endsection
