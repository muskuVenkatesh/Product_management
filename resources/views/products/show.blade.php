@extends('layouts.app')

@section('title', $product->name . ' - Product Details')
@section('page-header', 'Product Details')

@section('content')
<div class="container-fluid p-0">

    <!-- Breadcrumb Nav -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none text-muted">Dashboard</a></li>
            <li class="breadcrumb-item active fw-semibold" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <!-- Main Detail Card -->
    <div class="card-custom overflow-hidden mb-4">
        <div class="row g-0">
            <!-- Left Side: Large Product Image Showcase -->
            <div class="col-12 col-lg-5 bg-light d-flex align-items-center justify-content-center p-4 border-end position-relative" style="min-height: 380px;">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded-4 shadow-sm" style="max-height: 380px; object-fit: contain;">
                
                <div class="position-absolute top-0 start-0 m-3">
                    <span class="badge bg-dark-subtle text-dark border px-3 py-2 rounded-pill shadow-sm">
                        <i class="fa-solid fa-tag me-1"></i> {{ $product->category }}
                    </span>
                </div>
            </div>

            <!-- Right Side: Product Metadata & Actions -->
            <div class="col-12 col-lg-7 p-4 p-md-5 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge {{ $product->stock_badge_class }} px-3 py-2 rounded-pill fs-7 fw-semibold">
                            <i class="fa-solid fa-circle me-1" style="font-size: 0.5rem;"></i> {{ $product->stock_status_text }}
                        </span>
                        <small class="text-muted">Product ID: #{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</small>
                    </div>

                    <h2 class="fw-extrabold text-dark mb-3">{{ $product->name }}</h2>

                    <div class="d-flex align-items-baseline gap-3 mb-4">
                        <span class="fs-1 fw-bold text-primary">${{ number_format($product->price, 2) }}</span>
                        <span class="text-muted fs-7">/ unit</span>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold text-dark text-uppercase tracking-wider fs-7 mb-2">Description</h6>
                        <p class="text-secondary leading-relaxed m-0" style="line-height: 1.7; font-size: 0.95rem;">
                            {{ $product->description ?? 'No description has been provided for this product.' }}
                        </p>
                    </div>

                    <!-- Key Stats Grid -->
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-sm-4">
                            <div class="p-3 bg-light rounded-3 border">
                                <small class="text-muted d-block mb-1">Available Quantity</small>
                                <span class="fw-bold fs-5 text-dark">{{ number_format($product->quantity) }} units</span>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="p-3 bg-light rounded-3 border">
                                <small class="text-muted d-block mb-1">Total Valuation</small>
                                <span class="fw-bold fs-5 text-success">${{ number_format($product->price * $product->quantity, 2) }}</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="p-3 bg-light rounded-3 border">
                                <small class="text-muted d-block mb-1">Date Added</small>
                                <span class="fw-semibold text-dark" style="font-size: 0.9rem;">{{ $product->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Controls -->
                <div class="pt-4 border-top d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <a href="{{ route('products.index') }}" class="btn btn-light border px-4 py-2 rounded-3 text-secondary">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Products
                    </a>

                    <div class="d-flex gap-2">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-primary px-4 py-2 rounded-3 fw-semibold">
                            <i class="fa-solid fa-pen-to-square me-1"></i> Edit Product
                        </a>
                        <button type="button" class="btn btn-outline-danger px-4 py-2 rounded-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fa-solid fa-trash-can me-1"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-danger d-flex align-items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        Confirm Product Deletion
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-3">
                    Are you sure you want to delete <strong>"{{ $product->name }}"</strong>? This item will be permanently removed from the product catalog.
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-3 fw-semibold">Delete Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
