@extends('layouts.app')

@section('title', 'Product Dashboard & Catalog')
@section('page-header', 'Product Dashboard')

@section('content')
<div class="container-fluid p-0">

    <!-- KPI Summary Metrics Grid -->
    <div class="row g-4 mb-4">
        <!-- Total Products Card -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted fw-medium fs-7 uppercase tracking-wider mb-1">Total Products</div>
                        <div class="fs-2 fw-bold text-dark">{{ number_format($totalProducts) }}</div>
                    </div>
                    <div class="stat-icon bg-indigo-light">
                        <i class="fa-solid fa-box-archive"></i>
                    </div>
                </div>
                <div class="mt-3 pt-2 border-top d-flex align-items-center justify-content-between" style="font-size: 0.775rem;">
                    <span class="text-muted">Active items in catalog</span>
                    <span class="badge bg-indigo-light">Live</span>
                </div>
            </div>
        </div>

        <!-- Total Inventory Quantity Card -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted fw-medium fs-7 uppercase tracking-wider mb-1">Total Quantity</div>
                        <div class="fs-2 fw-bold text-dark">{{ number_format($totalQuantity) }}</div>
                    </div>
                    <div class="stat-icon bg-emerald-light">
                        <i class="fa-solid fa-cubes"></i>
                    </div>
                </div>
                <div class="mt-3 pt-2 border-top d-flex align-items-center justify-content-between" style="font-size: 0.775rem;">
                    <span class="text-muted">Total units in stock</span>
                    <span class="badge bg-emerald-light">In Warehouse</span>
                </div>
            </div>
        </div>

        <!-- Total Inventory Value Card -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted fw-medium fs-7 uppercase tracking-wider mb-1">Total Value</div>
                        <div class="fs-2 fw-bold text-dark">${{ number_format($totalValue, 2) }}</div>
                    </div>
                    <div class="stat-icon bg-amber-light">
                        <i class="fa-solid fa-dollar-sign"></i>
                    </div>
                </div>
                <div class="mt-3 pt-2 border-top d-flex align-items-center justify-content-between" style="font-size: 0.775rem;">
                    <span class="text-muted">Asset valuation</span>
                    <span class="badge bg-amber-light">USD</span>
                </div>
            </div>
        </div>

        <!-- Number of Categories Card -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted fw-medium fs-7 uppercase tracking-wider mb-1">Categories</div>
                        <div class="fs-2 fw-bold text-dark">{{ number_format($totalCategories) }}</div>
                    </div>
                    <div class="stat-icon bg-sky-light">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                </div>
                <div class="mt-3 pt-2 border-top d-flex align-items-center justify-content-between" style="font-size: 0.775rem;">
                    <span class="text-muted">Product classifications</span>
                    <span class="badge bg-sky-light">Active</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Catalog Controls Bar -->
    <div class="card-custom mb-4 p-4">
        <form action="{{ route('products.index') }}" method="GET" class="row g-3 align-items-center">
            <!-- Search Field -->
            <div class="col-12 col-md-5 col-lg-6">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted" id="search-addon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search by name, description, category..." value="{{ request('search') }}" aria-label="Search products">
                </div>
            </div>

            <!-- Category Filter Dropdown -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="">All Categories ({{ $totalCategories }})</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="col-12 col-sm-6 col-md-3 col-lg-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100 fw-semibold rounded-3">
                    Filter
                </button>
                @if(request()->has('search') || request()->has('category'))
                    <a href="{{ route('products.index') }}" class="btn btn-light border text-secondary rounded-3 px-3" title="Reset Filters">
                        <i class="fa-solid fa-rotate-right"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Product Catalog List Card -->
    <div class="card-custom overflow-hidden">
        <div class="card-header bg-white py-3 px-4 d-flex align-items-center justify-content-between border-bottom">
            <div class="d-flex align-items-center gap-2">
                <h6 class="fw-bold m-0 text-dark">Product Catalog</h6>
                <span class="badge bg-secondary-subtle text-secondary rounded-pill px-2.5">{{ $products->total() }} Products</span>
            </div>
            <a href="{{ route('products.create') }}" class="btn btn-gradient-primary btn-sm d-flex align-items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                <span>Add Product</span>
            </a>
        </div>

        @if($products->isEmpty())
            <!-- Empty State Display -->
            <div class="py-5 text-center px-4">
                <div class="mb-3 text-muted">
                    <i class="fa-solid fa-box-open fa-4x opacity-50"></i>
                </div>
                <h5 class="fw-bold text-dark mb-1">No products found</h5>
                <p class="text-muted mx-auto mb-4" style="max-width: 420px;">
                    @if(request('search') || request('category'))
                        We couldn't find any products matching your search criteria. Try clearing your filters or search terms.
                    @else
                        Your product inventory is empty. Start by adding your first product to the catalog.
                    @endif
                </p>
                @if(request('search') || request('category'))
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4 me-2">Clear Filters</a>
                @endif
                <a href="{{ route('products.create') }}" class="btn btn-gradient-primary px-4">Add Product Now</a>
            </div>
        @else
            <!-- Responsive Products Table -->
            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle m-0">
                    <thead>
                        <tr>
                            <th style="width: 70px;">Image</th>
                            <th>Product Info</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Added Date</th>
                            <th class="text-end" style="width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-thumb">
                                </td>
                                <td>
                                    <a href="{{ route('products.show', $product) }}" class="fw-bold text-dark text-decoration-none d-block">
                                        {{ $product->name }}
                                    </a>
                                    <small class="text-muted d-block text-truncate" style="max-width: 280px;">
                                        {{ $product->description ?? 'No description provided' }}
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2.5 py-1.5 rounded-2">
                                        {{ $product->category }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">${{ number_format($product->price, 2) }}</span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-secondary">{{ number_format($product->quantity) }}</span>
                                </td>
                                <td>
                                    <span class="badge {{ $product->stock_badge_class }} px-2.5 py-1.5 rounded-pill">
                                        {{ $product->stock_status_text }}
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $product->created_at->format('M d, Y') }}</small>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-outline-secondary" title="View Details">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-primary" title="Edit Product">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" title="Delete Product" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade text-start" id="deleteModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-4 border-0 shadow">
                                                <div class="modal-header border-bottom-0 pb-0">
                                                    <h5 class="modal-title fw-bold text-danger d-flex align-items-center gap-2">
                                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                                        Confirm Delete
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body py-3">
                                                    Are you sure you want to delete <strong>"{{ $product->name }}"</strong>? This action cannot be undone.
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Container -->
            @if($products->hasPages())
                <div class="px-4 py-3 bg-white border-top d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3">
                    <div class="text-muted" style="font-size: 0.875rem;">
                        Showing <span class="fw-bold text-dark">{{ $products->firstItem() }}</span> to <span class="fw-bold text-dark">{{ $products->lastItem() }}</span> of <span class="fw-bold text-dark">{{ $products->total() }}</span> entries
                    </div>
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>
            @endif
        @endif
    </div>

</div>
@endsection
