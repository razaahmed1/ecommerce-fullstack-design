@extends('layouts.app')
@section('title', 'Products')
@section('content')
    <div class="container py-5">
        <div class="row">
            {{-- Sidebar Filters --}}
            <aside class="col-md-3 mb-4 mb-md-0">
                <div class="bg-white rounded shadow-sm p-3 mb-4">
                    <h5 class="mb-3">Category</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none">Engine Parts</a></li>
                        <li><a href="#" class="text-decoration-none">Brakes</a></li>
                        <li><a href="#" class="text-decoration-none">Suspension</a></li>
                        <li><a href="#" class="text-decoration-none">Lighting</a></li>
                    </ul>
                </div>
                <div class="bg-white rounded shadow-sm p-3">
                    <h5 class="mb-3">Price</h5>
                    <input type="range" class="form-range" min="0" max="500" step="10">
                    <div class="d-flex justify-content-between">
                        <span>$0</span>
                        <span>$500</span>
                    </div>
                </div>
            </aside>
            {{-- Products Grid --}}
            <div class="col-md-9">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
                    @foreach ([
                        ['title' => 'Brake Pads', 'price' => '49.99', 'image' => 'https://via.placeholder.com/300x200?text=Brake+Pads'],
                        ['title' => 'LED Headlights', 'price' => '89.99', 'image' => 'https://via.placeholder.com/300x200?text=LED+Headlights'],
                        ['title' => 'Air Filter', 'price' => '19.99', 'image' => 'https://via.placeholder.com/300x200?text=Air+Filter'],
                        ['title' => 'Steering Wheel Cover', 'price' => '29.99', 'image' => 'https://via.placeholder.com/300x200?text=Steering+Wheel+Cover'],
                    ] as $product)
                        @include('components.product-card', $product)
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
