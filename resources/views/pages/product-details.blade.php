@extends('layouts.app')
@section('title', 'Product Details')
@section('content')
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-6">
                <img src="https://via.placeholder.com/400x300?text=Product+Image" class="img-fluid rounded shadow-sm mb-3" alt="Product">
                <div class="d-flex gap-2">
                    <img src="https://via.placeholder.com/80x60?text=Thumb1" class="img-thumbnail" alt="Thumb1">
                    <img src="https://via.placeholder.com/80x60?text=Thumb2" class="img-thumbnail" alt="Thumb2">
                    <img src="https://via.placeholder.com/80x60?text=Thumb3" class="img-thumbnail" alt="Thumb3">
                </div>
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <h2 class="fw-bold mb-3">Brake Pads</h2>
                <p class="fw-bold text-primary fs-4 mb-2">$49.99</p>
                <p class="mb-2">Stock: <span class="text-success">In Stock</span></p>
                <p class="mb-2">Category: <span class="text-secondary">Brakes</span></p>
                <button class="btn btn-primary btn-lg w-50 mb-3">Add to Cart</button>
                <ul class="nav nav-tabs" id="descTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button" role="tab">Description</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab">Specs</button>
                    </li>
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="desc" role="tabpanel">High-quality brake pads for all car models. Durable and reliable.</div>
                    <div class="tab-pane fade" id="specs" role="tabpanel">Material: Ceramic<br>Warranty: 2 Years</div>
                </div>
            </div>
        </div>
    </div>
@endsection
