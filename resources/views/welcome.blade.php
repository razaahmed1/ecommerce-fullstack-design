@extends('layouts.store')
@section('title', 'Automize - Car & Auto Parts')

@section('content')
    {{-- Hero Section --}}
    <section class="hero-section" style="background-color: var(--color-bg-section); padding: var(--spacing-2xl) 0;">
        <div class="container d-flex align-center flex-wrap gap-xl justify-between">
            <div class="hero-content" style="flex: 1; min-width: 300px;">
                <span class="badge badge-sale mb-md"><i class="bi bi-fire"></i> Best Offers of the Year</span>
                <h1 style="font-size: 3.5rem; color: var(--color-secondary); line-height: 1.1; margin-bottom: var(--spacing-lg);">
                    Premium Parts For <br><span class="text-primary">Your Vehicle</span>
                </h1>
                <p class="text-muted" style="font-size: 1.125rem; margin-bottom: var(--spacing-xl); max-width: 500px;">
                    Discover thousands of high-quality auto parts and accessories from top brands. Enhance your driving experience today.
                </p>
                <div class="d-flex gap-md">
                    <a href="/shop" class="btn btn-primary btn-lg px-5">SHOP NOW</a>
                    <a href="/categories" class="btn btn-outline btn-lg px-5">BROWSE</a>
                </div>
            </div>
            <div class="hero-image" style="flex: 1; min-width: 300px; text-align: center;">
                {{-- Placeholder for Hero Image (Using a stylish automotive-color block or icon if no image exists) --}}
                <div style="background: linear-gradient(135deg, var(--color-secondary) 0%, #1e293b 100%); width: 100%; max-width: 500px; aspect-ratio: 4/3; border-radius: var(--border-radius-lg); margin: 0 auto; display: flex; align-items: center; justify-content: center; position: relative;">
                    <i class="bi bi-car-front-fill" style="font-size: 6rem; color: rgba(255,255,255,0.1);"></i>
                    <div style="position: absolute; bottom: 20px; right: -20px; background: white; padding: 15px; border-radius: 12px; box-shadow: var(--shadow-lg);">
                        <div class="fw-bold" style="font-size: 1.25rem;">Quality Assured</div>
                        <div class="text-muted small">100% Genuine Parts</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Popular Categories --}}
    <section class="py-section bg-white">
        <div class="container">
            <div class="d-flex justify-between align-center mb-lg">
                <h2 class="m-0 text-uppercase" style="font-size: 1.5rem; border-left: 4px solid var(--color-primary); padding-left: 10px;">Popular Categories</h2>
                <a href="/categories" class="text-primary fw-semibold">View All <i class="bi bi-arrow-right"></i></a>
            </div>
            
            <div class="grid grid-cols-5 gap-md">
                @foreach(['Engine Parts', 'Tires & Wheels', 'Oil & Fluids', 'Brakes', 'Interior Accessories'] as $category)
                <a href="#" class="category-card" style="display: flex; flex-direction: column; align-items: center; gap: 10px; padding: 20px; border: 1px solid var(--color-border); border-radius: var(--border-radius-md); transition: all 0.3s; background: var(--color-bg-card);">
                    <div style="width: 80px; height: 80px; background: var(--color-bg-section); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-tools text-secondary fs-2"></i>
                    </div>
                    <span class="fw-semibold text-secondary">{{ $category }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Featured Products Grid --}}
    <section class="py-section" style="background-color: var(--color-bg-section);">
        <div class="container">
            <div class="d-flex justify-between align-center mb-lg">
                <h2 class="m-0 text-uppercase" style="font-size: 1.5rem; border-left: 4px solid var(--color-primary); padding-left: 10px;">Featured Products</h2>
                <div class="d-flex gap-sm">
                    <button class="btn btn-secondary" style="padding: 5px 15px; border-radius: 20px; font-size: 0.85rem;">New Arrivals</button>
                    <button class="btn btn-outline" style="padding: 5px 15px; border-radius: 20px; font-size: 0.85rem;">Best Sellers</button>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-md">
                {{-- Mocking 4 Products using the component --}}
                @for ($i = 1; $i <= 4; $i++)
                    @include('components.product-card', [
                        'image' => "https://via.placeholder.com/300?text=Product+$i",
                        'title' => "Premium Automotive Part $i - High Performance",
                        'brand' => 'BOSCH',
                        'price' => 120.00 + ($i * 15),
                        'oldPrice' => 150.00 + ($i * 15),
                        'badgeSale' => '-20%'
                    ])
                @endfor
            </div>
        </div>
    </section>
@endsection
